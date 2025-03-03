<?php

    namespace App\View\Components;

    use App\Models\Slider;
    use Illuminate\View\Component;

    class SliderComponent extends Component
    {
        public $sliders;

        public function __construct()
        {
            $this->sliders = Slider::with('translations')->get();
        }

        public function render()
        {
            return view('components.slider-component');
        }
    }
