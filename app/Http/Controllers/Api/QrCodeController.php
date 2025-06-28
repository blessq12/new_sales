<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function getLink(\App\Models\QrCode $qrCode)
    {
        $link = \App\Facades\QrCodeFacade::getQrCodeUrl($qrCode->id);
        return redirect($link);
    }
}
