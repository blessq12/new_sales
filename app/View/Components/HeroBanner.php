<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroBanner extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $breadcrumbs = [],
        public string $title = 'Не установлен',
        public string $description = 'Не установлен',
        public string $image = '/assets/images/banner.png'
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero-banner');
    }
}
