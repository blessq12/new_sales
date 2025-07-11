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
            'categories' => \App\Models\ServiceCategory::orderBy('order', 'asc')->get(),
            'reviews' => \App\Models\Review::where('is_approved', true)->limit(6)->orderBy('created_at', 'desc')->get(),
        ]);
    }
    public function about()
    {
        $doc_dir = public_path('assets/images/docs');
        $files = scandir($doc_dir);
        $files = array_filter($files, function ($file) {
            return $file !== '.' && $file !== '..' && $file !== '.DS_Store';
        });

        return view('main.about', [
            'files' => $files,
        ]);
    }
    public function groheService()
    {
        $doc_dir = public_path('assets/images/docs');
        $files = scandir($doc_dir);
        $files = array_filter($files, function ($file) {
            return $file !== '.' && $file !== '..' && $file !== '.DS_Store';
        });

        return view('main.grohe', [
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
    public function gallery()
    {
        return view('main.gallery', [
            'gallery' => \App\Models\Gallery::where('is_active', true)->first(),
        ]);
    }
    public function cooperation()
    {
        return view('main.cooperation');
    }
    public function agreement()
    {
        return view('main.agreement');
    }
}
