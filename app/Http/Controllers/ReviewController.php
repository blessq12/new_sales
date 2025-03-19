<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return view('reviews.index', [
            'reviews' => \App\Models\Review::where('is_approved', true)->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
