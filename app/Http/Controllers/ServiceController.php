<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function services()
    {
        return view('services.index', [
            'services' => Service::all(),
        ]);
    }

    public function show($slug)
    {
        return view('services.show', [
            'service' => Service::where('slug', $slug)->firstOrFail(),
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
}
