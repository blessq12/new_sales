<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Company;
use Mpdf\Mpdf;

class ServiceController extends Controller
{

    public function __construct()
    {
        \Illuminate\Support\Facades\View::share('company', Company::first());
    }

    public function services()
    {
        return view('services.index', [
            'services' => Service::all(),
        ]);
    }

    public function show(ServiceCategory $category, Service $slug)
    {
        $slug->increment('views');
        return view('services.show', [
            'service' => $slug,
            'category' => $category,
            'categories' => ServiceCategory::all(),
        ]);
    }

    public function list()
    {
        return Service::select('id', 'name')->get();
    }

    public function storeReview(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'rating' => 'required|integer|min:1|max:5',
            'text' => 'required|string|max:1000',
            'privacy' => 'required|accepted'
        ]);

        // TODO: Сохранение отзыва
        return response()->json(['message' => 'Спасибо за ваш отзыв!']);
    }

    public function category($slug)
    {
        return view('services.category', [
            'category' => ServiceCategory::where('slug', $slug)->firstOrFail(),
            'categories' => ServiceCategory::all(),
        ]);
    }

    public function price()
    {
        return view('services.price', [
            'categories' => ServiceCategory::all(),
        ]);
    }

    public function downloadPrice()
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('services.price.pdf', [
            'categories' => ServiceCategory::all(),
            'company' => Company::first(),
        ])->render());

        $pdfContent = $mpdf->Output('price.pdf', 'S');
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Прайс-лист ООО Салес на ' . date('d.m.Y') . '.pdf"')
            ->header('Content-Length', strlen($pdfContent));
    }
}
