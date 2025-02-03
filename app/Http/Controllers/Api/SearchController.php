<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $services = Service::where('name', 'like', '%' . $query . '%')->get();
        $services = $services->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
                'slug' => $service->slug,
                'description' => Str::limit(strip_tags($service->description), 35),
                'image' => '/uploads/' . $service->image,
            ];
        });
        return response()->json(['services' => $services]);
    }
}
