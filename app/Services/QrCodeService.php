<?php

namespace App\Services;

use App\Models\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class QrCodeService
{
    public function generateQrCode(string $url): string
    {
        $fileName = 'qr-' . md5($url . time()) . '.png';
        $filePath = 'qr-codes/' . $fileName;
        $fullPath = 'uploads/' . $filePath;

        $builder = new Builder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: $url,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 1024,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $result = $builder->build();
        Storage::disk('uploads')->put($filePath, $result->getString());

        return $fullPath;
    }

    public function updateQrCodeUrl(QrCode $qrCode, string $newUrl): string
    {
        $qrCode->update(['qr_link' => $newUrl]);
        return $qrCode->image;
    }

    public function getRedirectUrl(QrCode $qrCode): string
    {
        return $qrCode->qr_link;
    }
}
