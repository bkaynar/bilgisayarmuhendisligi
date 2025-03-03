<?php

namespace App\Http\Controllers;

use App\Models\Laboratuvar;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaboratuvarController extends Controller
{
    /**
     * Laboratuvarlar sayfasını göster (frontend)
     */
    public function index(Request $request, $locale = null): View
    {
        if ($locale) {
            app()->setLocale($locale);
        }

        $laboratuvarlar = Laboratuvar::active()->with('translations')->get();

        return view('mainlayout.laboratuvarlar', compact('laboratuvarlar'));
    }

    /**
     * Belirli bir laboratuvar sayfasını göster (frontend)
     */
    public function show($id, $locale = null): View
    {
        if ($locale) {
            app()->setLocale($locale);
        }

        $laboratuvar = Laboratuvar::active()->with('translations')->findOrFail($id);

        return view('mainlayout.laboratuvar-detay', compact('laboratuvar'));
    }
}
