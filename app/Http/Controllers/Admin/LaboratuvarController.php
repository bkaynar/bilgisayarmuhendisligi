<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laboratuvar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class LaboratuvarController extends Controller
{
    /**
     * Laboratuvarları listele
     */
    public function index(): View
    {
        $laboratuvarlar = Laboratuvar::active()->with('translations')->get();
        return view('laboratuvar.index', compact('laboratuvarlar'));
    }

    /**
     * Yeni laboratuvar oluşturma formunu göster
     */
    public function create(): View
    {
        $availableLocales = config('app.available_locales', ['tr', 'en']);
        return view('laboratuvar.create', compact('availableLocales'));
    }

    /**
     * Yeni laboratuvar kaydet
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'lab_resim' => 'required|image|max:2048',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.lab_ad' => 'required|string|max:500',
            'translations.*.lab_aciklama' => 'required|string',
        ]);

        // Resmi kaydet
        $imagePath = $request->file('lab_resim')->store('laboratuvar', 'public');

        // Laboratuvarı oluştur
        $laboratuvar = Laboratuvar::create([
            'lab_resim' => $imagePath,
            'silindi' => 0,
        ]);

        // Çevirileri kaydet
        foreach ($validatedData['translations'] as $translationData) {
            $laboratuvar->saveTranslation($translationData['locale'], [
                'lab_ad' => $translationData['lab_ad'],
                'lab_aciklama' => $translationData['lab_aciklama'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Laboratuvar başarıyla oluşturuldu.']);

    }

    /**
     * Laboratuvar düzenleme formunu göster
     */
    public function edit($id): View
    {
        $laboratuvar = Laboratuvar::with('translations')->findOrFail($id);
        $availableLocales = config('app.available_locales', ['tr', 'en']);

        return view('laboratuvar.edit', compact('laboratuvar', 'availableLocales'));
    }

    /**
     * Laboratuvar güncelle
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $laboratuvar = Laboratuvar::findOrFail($id);

        $validatedData = $request->validate([
            'lab_resim' => 'nullable|image|max:2048',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.lab_ad' => 'required|string|max:500',
            'translations.*.lab_aciklama' => 'required|string',
        ]);

        // Resim güncellenmiş mi kontrol et
        if ($request->hasFile('lab_resim')) {
            // Eski resmi sil
            if ($laboratuvar->lab_resim && Storage::disk('public')->exists($laboratuvar->lab_resim)) {
                Storage::disk('public')->delete($laboratuvar->lab_resim);
            }

            // Yeni resmi kaydet
            $imagePath = $request->file('lab_resim')->store('laboratuvar', 'public');
            $laboratuvar->update(['lab_resim' => $imagePath]);
        }

        // Çevirileri güncelle
        foreach ($validatedData['translations'] as $translationData) {
            $locale = $translationData['locale'];

            $laboratuvar->saveTranslation($locale, [
                'lab_ad' => $translationData['lab_ad'],
                'lab_aciklama' => $translationData['lab_aciklama'],
            ]);
        }

        return redirect()->route('laboratuvar.index')
            ->with('success', 'Laboratuvar başarıyla güncellendi.');
    }

    /**
     * Laboratuvarı sil (soft delete)
     */
    public function destroy($id): RedirectResponse
    {
        $laboratuvar = Laboratuvar::findOrFail($id);
        $laboratuvar->update(['silindi' => 1]);

        return redirect()->route('laboratuvar.index')
            ->with('success', 'Laboratuvar başarıyla silindi.');
    }
}
