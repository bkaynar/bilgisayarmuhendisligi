<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Haber;
use App\Models\HaberTranslation;
use Illuminate\Http\Request;

class HaberController extends Controller
{
    public function index()
    {
        $haberler = Haber::with('translations')->get();
        return view('haber.index', compact('haberler'));
    }

    public function create()
    {
        return view('haber.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.haber_baslik' => 'required|string|max:500',
            'translations.*.haber_icerik' => 'required|string',
            'yayin_tarihi' => 'required|date',
            'haber_resim' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('haber_resim')) {
            try {
                $file = $request->file('haber_resim');
                $filePath = $file->store('haber_resimleri', 'public');
            } catch (\Exception $e) {
                return response()->json(['errors' => ['haber_resim' => ['The haber resim failed to upload.']]], 422);
            }
        } else {
            return response()->json(['errors' => ['haber_resim' => ['The haber resim is required.']]], 422);
        }

        $haber = Haber::create([
            'yayin_tarihi' => $validatedData['yayin_tarihi'],
            'haber_resim' => $filePath,
        ]);

        foreach ($validatedData['translations'] as $translationData) {
            $haber->translations()->create($translationData);
        }

        return response()->json(['success' => 'Haber başarıyla oluşturuldu.']);
    }

    public function edit($id)
    {
        $haber = Haber::with('translations')->findOrFail($id);
        return view('haber.edit', compact('haber'));
    }

    public function update(Request $request, $id)
    {
        $haber = Haber::findOrFail($id);

        $validatedData = $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.haber_baslik' => 'required|string|max:500',
            'translations.*.haber_icerik' => 'required|string',
            'yayin_tarihi' => 'required|date',
            'haber_resim' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('haber_resim')) {
            $file = $request->file('haber_resim');
            $filePath = $file->store('haber_resimleri', 'public');
            $haber->haber_resim = $filePath;
        }

        $haber->update([
            'yayin_tarihi' => $validatedData['yayin_tarihi'],
            'haber_resim' => $haber->haber_resim,
        ]);

        $haber->translations()->delete();
        foreach ($validatedData['translations'] as $translationData) {
            $haber->translations()->create($translationData);
        }

        return response()->json(['success' => 'Haber başarıyla güncellendi.']);
    }

    public function destroy($id)
    {
        $haber = Haber::findOrFail($id);
        $haber->delete();

        return redirect()->route('haber.index')->with('success', 'Haber başarıyla silindi.');
    }
}
