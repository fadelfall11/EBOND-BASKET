<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ActualiteAdminController extends Controller
{
    public function index(): View
    {
        $actualites = Actualite::latest()->paginate(20);

        return view('admin.actualites.index', compact('actualites'));
    }

    public function create(): View
    {
        return view('admin.actualites.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
            'date_publication' => ['required', 'date'],
            'auteur' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('actualites', 'public');
        }

        Actualite::create($validated);

        return redirect()->route('admin.actualites.index');
    }

    public function edit(Actualite $actualite): View
    {
        return view('admin.actualites.edit', compact('actualite'));
    }

    public function update(Request $request, Actualite $actualite): RedirectResponse
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
            'date_publication' => ['required', 'date'],
            'auteur' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            if ($actualite->image) {
                Storage::disk('public')->delete($actualite->image);
            }

            $validated['image'] = $request->file('image')->store('actualites', 'public');
        }

        $actualite->update($validated);

        return redirect()->route('admin.actualites.index');
    }

    public function destroy(Actualite $actualite): RedirectResponse
    {
        if ($actualite->image) {
            Storage::disk('public')->delete($actualite->image);
        }

        $actualite->delete();

        return redirect()->route('admin.actualites.index');
    }
}
