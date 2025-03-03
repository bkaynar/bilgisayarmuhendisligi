<?php

namespace App\Http\Controllers;

use App\Models\AkademikPersonel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AkademikPersonelController extends Controller
{
    /**
     * Akademik personel sayfasını göster (frontend)
     */
    public function index(Request $request, $locale = null): View
    {
        if ($locale) {
            app()->setLocale($locale);
        }

        $akademikPersoneller = AkademikPersonel::active()->with('translations')->get();

        return view('mainlayout.academic-staff', compact('akademikPersoneller'));
    }

    /**
     * Akademik personel detay sayfasını göster (frontend)
     */
    public function show($id, $locale = null): View
    {
        if ($locale) {
            app()->setLocale($locale);
        }

        $personel = AkademikPersonel::active()->with('translations')->findOrFail($id);
        $otherTeachers = AkademikPersonel::active()->with('translations')->where('id', '!=', $id)->get();


        return view('mainlayout.academic-staff-details', compact('personel', 'otherTeachers'));
    }
}
