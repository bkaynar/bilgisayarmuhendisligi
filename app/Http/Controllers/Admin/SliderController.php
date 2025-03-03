<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SliderController extends Controller
{
    /**
     * Slider listesini göster
     */
    public function index(): View
    {
        $sliders = Slider::with('translations')->get();

        return view('slider.index', compact('sliders'));
    }

    /**
     * Yeni slider ekleme formunu göster
     */
    public function create(): View
    {
        $availableLocales = config('app.available_locales', ['tr', 'en']);

        return view('slider.create', compact('availableLocales'));
    }

    /**
     * Yeni slider kaydını oluştur
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'slider_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'slider_link' => 'nullable|url|max:2000',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.slider_ustmetin' => 'required|string',
            'translations.*.slider_altmetin' => 'required|string',
        ]);

        // Handle image upload
        if ($request->hasFile('slider_url')) {
            $imageName = time() . '.' . $request->slider_url->extension();
            $request->slider_url->move(public_path('images'), $imageName);
            $validatedData['slider_url'] = 'images/' . $imageName;
        }

        // Create slider record
        $slider = Slider::create([
            'slider_url' => $validatedData['slider_url'],
            'slider_link' => $validatedData['slider_link'] ?? null,
        ]);

        // Save translations
        foreach ($validatedData['translations'] as $translationData) {
            $locale = $translationData['locale'];

            $slider->saveTranslation($locale, [
                'slider_ustmetin' => $translationData['slider_ustmetin'],
                'slider_altmetin' => $translationData['slider_altmetin'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Slider successfully added.']);
    }

    /**
     * Slider düzenleme formunu göster
     */
    public function edit($id): View
    {
        $slider = Slider::with('translations')->findOrFail($id);
        $availableLocales = config('app.available_locales', ['tr', 'en']);

        return view('slider.edit', compact('slider', 'availableLocales'));
    }

    /**
     * Slider bilgilerini güncelle
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $slider = Slider::findOrFail($id);

        $validatedData = $request->validate([
            'slider_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'slider_link' => 'nullable|url|max:2000',
            'translations' => 'required|array',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.slider_ustmetin' => 'required|string',
            'translations.*.slider_altmetin' => 'required|string',
        ]);

        // Handle image upload
        if ($request->hasFile('slider_url')) {
            $imageName = time() . '.' . $request->slider_url->extension();
            $request->slider_url->move(public_path('images'), $imageName);
            $validatedData['slider_url'] = 'images/' . $imageName;
        } else {
            $validatedData['slider_url'] = $slider->slider_url;
        }

        // Update slider record
        $slider->update([
            'slider_url' => $validatedData['slider_url'],
            'slider_link' => $validatedData['slider_link'] ?? null,
        ]);

        // Update translations
        foreach ($validatedData['translations'] as $translationData) {
            $locale = $translationData['locale'];

            $slider->saveTranslation($locale, [
                'slider_ustmetin' => $translationData['slider_ustmetin'],
                'slider_altmetin' => $translationData['slider_altmetin'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Slider successfully updated.']);
    }

    /**
     * Slider'ı sil
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();

        return response()->json(['success' => true, 'message' => 'Slider successfully deleted.']);
    }
}
