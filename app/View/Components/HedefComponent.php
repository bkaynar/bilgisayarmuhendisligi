<?php

namespace App\View\Components;

use App\Models\Hedeflerimiz;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HedefComponent extends Component
{
    public $hedefler;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->hedefler = Hedeflerimiz::active()->with('translations')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hedef-component', ['hedefler' => $this->hedefler]);
    }
}
