<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hakkimizda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HakkimizdaController extends Controller
{
    /**
     * Hakkımızda sayfası düzenleme formunu göster
     */
    public function edit(): View
    {
        // Mevcut kaydı getir veya yeni oluştur
        $hakkimizda = Hakkimizda::active()->with('translations')->first();

        if (!$hakkimizda) {
            $hakkimizda = Hakkimizda::create(['silindi' => 0]);
        }

        // Desteklenen diller
        $availableLocales = config('app.available_locales', ['tr', 'en']);

        return view('hakkimizda.edit', compact('hakkimizda', 'availableLocales'));
    }

    /**
     * Hakkımızda sayfası içeriğini güncelle
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        // Mevcut kaydı getir veya yeni oluştur
        $hakkimizda = Hakkimizda::findOrFail($id);

        // Form validation
        $validatedData = $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.baslik' => 'required|string|max:255',
            'translations.*.icerik' => 'required|string',
            'translations.*.meta_aciklama' => 'nullable|string|max:255',
        ]);

        // Her dil için çevirileri güncelle
        foreach ($validatedData['translations'] as $translationData) {
            $locale = $translationData['locale'];

            // Çeviriyi güncelle veya oluştur
            $hakkimizda->saveTranslation($locale, [
                'baslik' => $translationData['baslik'],
                'icerik' => $translationData['icerik'],
                'meta_aciklama' => $translationData['meta_aciklama'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Hakkımızda sayfası başarıyla güncellendi.',
        ]);
    }
}
