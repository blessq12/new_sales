<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JsonLd extends Component
{
    public $company;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->company = \App\Models\Company::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.json-ld');
    }
}
