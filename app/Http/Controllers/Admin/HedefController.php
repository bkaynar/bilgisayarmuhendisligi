<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hedeflerimiz;
use App\Models\HedeflerimizTranslation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HedefController extends Controller
{
    /**
     * Hedefleri listele
     */
    public function index(): View
    {
        $hedeflerimiz = Hedeflerimiz::with('translations')->get();
        return view('hedef.index', compact('hedeflerimiz'));
    }

    /**
     * Yeni hedef oluşturma formunu göster
     */
    public function create(): View
    {
        $availableLocales = config('app.available_locales', ['tr', 'en']);
        return view('hedef.create', compact('availableLocales'));
    }

    /**
     * Yeni hedef kaydet
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.hedef_baslik' => 'required|string|max:255',
            'translations.*.hedef_icerik' => 'required|string',
        ]);

        // Hedefi oluştur
        $hedef = Hedeflerimiz::create();

        // Çevirileri kaydet
        foreach ($validatedData['translations'] as $translationData) {
            $hedef->translations()->create($translationData);
        }

        return response()->json(['success' => true, 'message' => 'Hedef başarıyla oluşturuldu.']);
    }

    /**
     * Hedef düzenleme formunu göster
     */
    public function edit($id): View
    {
        $hedef = Hedeflerimiz::with('translations')->findOrFail($id);
        $availableLocales = config('app.available_locales', ['tr', 'en']);

        return view('hedef.edit', compact('hedef', 'availableLocales'));
    }

    /**
     * Hedef güncelle
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $hedef = Hedeflerimiz::findOrFail($id);

        $validatedData = $request->validate([
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.hedef_baslik' => 'required|string|max:255',
            'translations.*.hedef_icerik' => 'required|string',
        ]);

        // Çevirileri güncelle
        $hedef->translations()->delete();
        foreach ($validatedData['translations'] as $translationData) {
            $hedef->translations()->create($translationData);
        }

        return response()->json(['success' => true, 'message' => 'Hedef başarıyla güncellendi.']);

    }

    /**
     * Hedefi sil (soft delete)
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $hedef = Hedeflerimiz::findOrFail($id);
        $hedef->delete();

        return response()->json(['success' => true, 'message' => 'Hedef başarıyla silindi.']);
    }
}
