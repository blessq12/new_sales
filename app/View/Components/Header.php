<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }

    public function categories()
    {
        return \App\Models\ServiceCategory::orderBy('order', 'asc')->get();
    }

    public function company()
    {
        return \App\Models\Company::first();
    }
}
