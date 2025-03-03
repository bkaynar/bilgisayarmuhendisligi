<?php

namespace App\Http\Controllers\Admin;

use App\Models\AkademikPersonel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AkademikPersonelController extends Controller
{
    /**
     * Akademik personel listesini göster
     */
    public function index(): View
    {
        $akademikPersoneller = AkademikPersonel::active()->with('translations')->get();

        return view('akademikpersonel.index', compact('akademikPersoneller'));
    }

    /**
     * Yeni akademik personel ekleme formunu göster
     */
    public function create(): View
    {
        $availableLocales = config('app.available_locales', ['tr', 'en']);

        return view('akademikpersonel.create', compact('availableLocales'));
    }

    /**
     * Yeni akademik personel kaydını oluştur
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'personel_isim_soyisim' => 'required|string|max:255',
            'personel_img' => 'nullable|image|max:2048',
            'personel_telefon' => 'nullable|string|max:255',
            'personel_email' => 'nullable|email|max:255',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.personel_unvan' => 'nullable|string|max:255',
            'translations.*.personel_gorev' => 'nullable|string|max:255',
            'translations.*.personel_fakulte' => 'nullable|string|max:255',
            'translations.*.personel_bolum' => 'nullable|string|max:255',
            'translations.*.personel_hakkinda' => 'nullable|string',
        ]);

        // Resim yükleme işlemi
        $imagePath = null;
        if ($request->hasFile('personel_img')) {
            $imagePath = $request->file('personel_img')->store('personel', 'public');
        }

        // Akademik personel kaydını oluştur
        $personel = AkademikPersonel::create([
            'personel_isim_soyisim' => $validatedData['personel_isim_soyisim'],
            'personel_img' => $imagePath,
            'personel_telefon' => $validatedData['personel_telefon'] ?? null,
            'personel_email' => $validatedData['personel_email'] ?? null,
        ]);

        // Çevirileri kaydet
        foreach ($validatedData['translations'] as $translationData) {
            $locale = $translationData['locale'];

            $personel->saveTranslation($locale, [
                'personel_unvan' => $translationData['personel_unvan'] ?? null,
                'personel_gorev' => $translationData['personel_gorev'] ?? null,
                'personel_fakulte' => $translationData['personel_fakulte'] ?? null,
                'personel_bolum' => $translationData['personel_bolum'] ?? null,
                'personel_hakkinda' => $translationData['personel_hakkinda'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Personel başarıyla eklendi.',
            'data' => $personel,
        ], 201);
    }

    /**
     * Akademik personel düzenleme formunu göster
     */
    public function edit($id): View
    {
        $personel = AkademikPersonel::with('translations')->findOrFail($id);
        $availableLocales = config('app.available_locales', ['tr', 'en']);

        return view('akademikpersonel.edit', compact('personel', 'availableLocales'));
    }

    /**
     * Akademik personel bilgilerini güncelle
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $personel = AkademikPersonel::findOrFail($id);

        $validatedData = $request->validate([
            'personel_isim_soyisim' => 'required|string|max:255',
            'personel_img' => 'nullable|image|max:2048',
            'personel_telefon' => 'nullable|string|max:255',
            'personel_email' => 'nullable|email|max:255',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.personel_unvan' => 'nullable|string|max:255',
            'translations.*.personel_gorev' => 'nullable|string|max:255',
            'translations.*.personel_fakulte' => 'nullable|string|max:255',
            'translations.*.personel_bolum' => 'nullable|string|max:255',
            'translations.*.personel_hakkinda' => 'nullable|string',
        ]);

        // Resim güncelleme işlemi
        if ($request->hasFile('personel_img')) {
            // Eski resmi silme işlemleri burada yapılabilir
            $imagePath = $request->file('personel_img')->store('personel', 'public');
            $personel->personel_img = $imagePath;
        }

        // Temel bilgileri güncelle
        $personel->update([
            'personel_isim_soyisim' => $validatedData['personel_isim_soyisim'],
            'personel_telefon' => $validatedData['personel_telefon'] ?? null,
            'personel_email' => $validatedData['personel_email'] ?? null,
        ]);

        // Çevirileri güncelle
        foreach ($validatedData['translations'] as $translationData) {
            $locale = $translationData['locale'];

            $personel->saveTranslation($locale, [
                'personel_unvan' => $translationData['personel_unvan'] ?? null,
                'personel_gorev' => $translationData['personel_gorev'] ?? null,
                'personel_fakulte' => $translationData['personel_fakulte'] ?? null,
                'personel_bolum' => $translationData['personel_bolum'] ?? null,
                'personel_hakkinda' => $translationData['personel_hakkinda'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Personel başarıyla güncellendi.',
            'data' => $personel,
        ], 201);
    }

    /**
     * Akademik personeli sil
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $personel = AkademikPersonel::findOrFail($id);
        $personel->update(['silindi' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Personel başarıyla silindi',
            'data' => $personel,
        ], 200);
    }
}
