<?php

namespace App\View\Components;

use App\Models\Hakkimizda;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HakkimizdaComponent extends Component
{
    public $hakkimizda;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->hakkimizda = Hakkimizda::with('translations')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hakkimizda-component', ['hakkimizda' => $this->hakkimizda]);
    }
}
