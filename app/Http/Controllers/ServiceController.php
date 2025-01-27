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
            'service' => Service::where('slug', $slug)->first(),
        ]);
    }
}
