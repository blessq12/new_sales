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
        return view('main.index');
    }
    public function about()
    {
        return view('main.about');
    }
    public function certificates()
    {
        return view('main.certificates');
    }
    public function contacts()
    {
        return view('main.contacts');
    }
}
