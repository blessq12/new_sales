<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

    public function __construct()
    {
        \View::share('company', \App\Models\Company::first());
    }

    public function index()
    {
        return view('main.index', [
            'services' => \App\Models\Service::limit(10)->get(),
        ]);
    }
    public function about()
    {
        return view('main.about');
    }
    public function certificates()
    {
        $doc_dir = public_path('assets/images/docs');
        $files = scandir($doc_dir);
        $files = array_filter($files, function ($file) {
            return $file !== '.' && $file !== '..';
        });

        return view('main.certificates', [
            'files' => $files,
        ]);
    }
    public function contacts()
    {
        return view('main.contacts');
    }
    public function privacy()
    {
        return view('main.privacy');
    }
}
