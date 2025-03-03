<?php

namespace App\Http\Controllers;

use App\Models\Haber;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HaberlerController extends Controller
{
    public function index(Request $request, $locale = null)
    {
        if ($locale) {
            app()->setLocale($locale);
        }

        $haberler = Haber::active()->with('translations')->get();

        return view('mainlayout.news', compact('haberler'));
    }

    public function show($id, $locale = null): View
    {
        if ($locale) {
            app()->setLocale($locale);
        }

        $haber = Haber::active()->with('translations')->findOrFail($id);
        $digerHaberler = Haber::active()->with('translations')->where('id', '!=', $id)->get();

        return view('mainlayout.new-details', compact('haber', 'digerHaberler'));
    }
}
