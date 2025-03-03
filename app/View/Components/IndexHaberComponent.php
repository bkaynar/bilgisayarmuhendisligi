<?php

    namespace App\View\Components;

    use App\Models\Haber;
    use Closure;
    use Illuminate\Contracts\View\View;
    use Illuminate\View\Component;

    class IndexHaberComponent extends Component
    {
        public $haberler;

        /**
         * Create a new component instance.
         */
        public function __construct()
        {
            $this->haberler = Haber::active()->with('translations')->get();
        }

        /**
         * Get the view / contents that represent the component.
         */
        public function render(): View|Closure|string
        {
            return view('components.index-haber-component', ['haberler' => $this->haberler]);
        }
    }
