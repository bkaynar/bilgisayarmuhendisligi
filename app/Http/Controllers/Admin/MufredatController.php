<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mufredat;
use Illuminate\Http\Request;

class MufredatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mufredatlar = Mufredat::with('translations')->get();
        return view('mufredat.index', compact('mufredatlar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mufredat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dosya_yolu' => 'required|file|mimes:pdf|max:8192',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.adi' => 'required|string|max:500',
        ]);

        $filePath = $request->file('dosya_yolu')->store('mufredat_files', 'public');

        $mufredat = Mufredat::create([
            'dosya_yolu' => $filePath,
            'silindi' => $request->input('silindi', 0),
        ]);

        foreach ($request->translations as $translation) {
            $mufredat->translations()->create($translation);
        }

        return response()->json(['success' => 'Mufredat created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mufredat $mufredat)
    {
        return view('mufredat.show', compact('mufredat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mufredat $mufredat)
    {
        return view('mufredat.edit', compact('mufredat'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Mufredat $mufredat)
    {
        $request->validate([
            'dosya_yolu' => 'sometimes|file|mimes:pdf|max:2048',
            'translations.*.locale' => 'required|string|size:2',
            'translations.*.adi' => 'required|string|max:500',
        ]);

        if ($request->hasFile('dosya_yolu')) {
            $filePath = $request->file('dosya_yolu')->store('mufredat_files', 'public');
            $mufredat->update(['dosya_yolu' => $filePath]);
        } else {
            $mufredat->update($request->only('dosya_yolu', 'silindi'));
        }

        foreach ($request->translations as $translation) {
            $mufredat->translations()->updateOrCreate(
                ['locale' => $translation['locale']],
                $translation
            );
        }

        return response()->json(['success' => 'Mufredat updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mufredat $mufredat)
    {
        $mufredat->delete();
        return response()->json(['success' => 'Mufredat deleted successfully.']);
    }
}
