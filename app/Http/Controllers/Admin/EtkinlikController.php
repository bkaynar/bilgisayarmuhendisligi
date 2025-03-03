<?php

namespace App\Http\Controllers\Admin;

use App\Models\Etkinlik;
use App\Models\EtkinlikTranslation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EtkinlikController extends Controller
{
    /**
     * List all etkinlikler
     */
    public function index(): View
    {
        $etkinlikler = Etkinlik::with('translations')->get();
        return view('etkinlik.index', compact('etkinlikler'));
    }

    /**
     * Show form to create a new etkinlik
     */
    public function create(): View
    {
        $availableLocales = config('app.available_locales', ['tr', 'en']);
        return view('etkinlik.create', compact('availableLocales'));
    }

    /**
     * Store a new etkinlik
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // Gelen verileri doğrula
        $validatedData = $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.etkinlik_baslik' => 'required|string|max:500',
            'translations.*.etkinlik_icerik' => 'required|string|max:500',
            'translations.*.etkinlik_text' => 'nullable|string',
            'etkinlik_tarih' => 'required|date',
            'etkinlik_resim' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // İlk çeviri verisini al (Varsayılan dilde başlık ve içerik almak için)
        $defaultTranslation = $validatedData['translations'][0];

        // Resim dosyasını yükle
        if ($request->hasFile('etkinlik_resim')) {
            $file = $request->file('etkinlik_resim');
            $filePath = $file->store('etkinlik_resimleri', 'public');
        } else {
            return response()->json(['success' => false, 'message' => 'Etkinlik resmi yüklenemedi.'], 400);
        }

        // Yeni etkinlik oluştur
        $etkinlik = Etkinlik::create([
            'etkinlik_baslik' => $defaultTranslation['etkinlik_baslik'], // Varsayılan dili kullanarak kaydet
            'etkinlik_icerik' => $defaultTranslation['etkinlik_icerik'],
            'etkinlik_text' => $defaultTranslation['etkinlik_text'] ?? null, // Opsiyonel alan
            'etkinlik_tarih' => $validatedData['etkinlik_tarih'],
            'etkinlik_resim' => $filePath,
        ]);

        // Çeviri verilerini kaydet
        foreach ($validatedData['translations'] as $translationData) {
            $etkinlik->translations()->create([
                'etkinlik_id' => $etkinlik->id, // Yeni oluşturulan etkinliğin ID'si
                'locale' => $translationData['locale'],
                'etkinlik_baslik' => $translationData['etkinlik_baslik'],
                'etkinlik_icerik' => $translationData['etkinlik_icerik'],
                'etkinlik_text' => $translationData['etkinlik_text'] ?? null,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Etkinlik başarıyla oluşturuldu.']);
    }


    /**
     * Show form to edit an existing etkinlik
     */
    public function edit($id): View
    {
        $etkinlik = Etkinlik::with('translations')->findOrFail($id);
        $availableLocales = config('app.available_locales', ['tr', 'en']);

        return view('etkinlik.edit', compact('etkinlik', 'availableLocales'));
    }

    /**
     * Update an existing etkinlik
     */

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        // Güncellenecek etkinliği bul
        $etkinlik = Etkinlik::findOrFail($id);

        // Gelen verileri doğrula
        $validatedData = $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.etkinlik_baslik' => 'required|string|max:500',
            'translations.*.etkinlik_icerik' => 'required|string|max:500',
            'translations.*.etkinlik_text' => 'nullable|string',
            'etkinlik_tarih' => 'required|date',
            'etkinlik_resim' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Varsayılan dili belirle (ilk çeviri)
        $defaultTranslation = $validatedData['translations'][0];

        // Resim güncellenmişse önce eskisini sil, sonra yenisini yükle
        if ($request->hasFile('etkinlik_resim')) {
            // Eski resmi sil (eğer varsa)
            if ($etkinlik->etkinlik_resim && \Storage::disk('public')->exists($etkinlik->etkinlik_resim)) {
                \Storage::disk('public')->delete($etkinlik->etkinlik_resim);
            }

            // Yeni resmi kaydet
            $file = $request->file('etkinlik_resim');
            $filePath = $file->store('etkinlik_resimleri', 'public');
            $etkinlik->etkinlik_resim = $filePath;
        }

        // Etkinlik ana bilgilerini güncelle
        $etkinlik->update([
            'etkinlik_baslik' => $defaultTranslation['etkinlik_baslik'], // Varsayılan dilde başlık kaydediliyor
            'etkinlik_icerik' => $defaultTranslation['etkinlik_icerik'],
            'etkinlik_text' => $defaultTranslation['etkinlik_text'] ?? null,
            'etkinlik_tarih' => $validatedData['etkinlik_tarih'],
            'etkinlik_resim' => $etkinlik->etkinlik_resim,
        ]);

        // Çevirileri güncelle veya oluştur
        foreach ($validatedData['translations'] as $translationData) {
            $etkinlik->translations()->updateOrCreate(
                ['locale' => $translationData['locale']], // Güncellenecek kayıt (şayet varsa)
                [
                    'etkinlik_id' => $etkinlik->id,
                    'etkinlik_baslik' => $translationData['etkinlik_baslik'],
                    'etkinlik_icerik' => $translationData['etkinlik_icerik'],
                    'etkinlik_text' => $translationData['etkinlik_text'] ?? null,
                ]
            );
        }

        return response()->json(['success' => true, 'message' => 'Etkinlik başarıyla güncellendi.']);
    }


    /**
     * Delete an etkinlik (soft delete)
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $etkinlik = Etkinlik::findOrFail($id);
        $etkinlik->delete();

        return response()->json(['success' => true, 'message' => 'Etkinlik başarıyla silindi.']);
    }
}
