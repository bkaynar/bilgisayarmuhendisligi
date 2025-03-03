<?php

namespace App\Http\Controllers;

use App\Models\Hakkimizda;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HakkimizdaController extends Controller
{
    /**
     * Hakkımızda sayfasını göster (frontend)
     */
    public function index(Request $request, $locale = null): View
    {
        if ($locale) {
            app()->setLocale($locale);
        }

        $hakkimizda = Hakkimizda::active()->with('translations')->first();

        return view('mainlayout.about', compact('hakkimizda'));
    }
}
