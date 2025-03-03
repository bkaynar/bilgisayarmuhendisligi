<?php

namespace App\View\Components;

use App\Models\Mufredat;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MufredatComponent extends Component
{
   public $mufredatlar;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->mufredatlar = Mufredat::active()->with('translations')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mufredat-component', ['mufredatlar' => $this->mufredatlar]);
    }
}
