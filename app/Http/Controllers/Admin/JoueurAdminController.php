<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Joueur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;

class JoueurAdminController extends Controller
{
    public function index(Request $request): View
    {
        $query = Joueur::with('categorie.coach')->orderBy('categorie_id')->orderBy('numero');

        if ($request->filled('categorie_id')) {
            $query->where('categorie_id', $request->input('categorie_id'));
        }

        $joueurs = $query->paginate(30)->withQueryString();
        $categories = Categorie::orderBy('nom')->get();

        return view('admin.joueurs.index', compact('joueurs', 'categories'));
    }

    public function create(): View
    {
        $categories = Categorie::orderBy('nom')->get();

        return view('admin.joueurs.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'poste' => ['required', 'string', 'max:255'],
            'categorie_id' => ['required', 'exists:categories,id'],
            'numero' => ['required', 'integer', 'min:0'],
            'capitaine' => ['nullable', 'boolean'],
            'eloges' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'photo_crop_data' => ['nullable', 'string'],
        ]);

        $validated['capitaine'] = (bool) ($validated['capitaine'] ?? false);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('joueurs', 'public');

            // Traitement du crop si présent
            if ($request->filled('photo_crop_data')) {
                $crop = json_decode($request->input('photo_crop_data'), true);
                $image = Image::make($file->getRealPath());
                $image->crop(
                    intval($crop['width']),
                    intval($crop['height']),
                    intval($crop['x']),
                    intval($crop['y'])
                );
                $image->save(storage_path('app/public/' . $path));
            }
            $validated['photo'] = $path;
        }

        if ($validated['capitaine']) {
            Joueur::where('categorie_id', $validated['categorie_id'])->update(['capitaine' => false]);
        }

        Joueur::create($validated);

        return redirect()->route('admin.joueurs.index');
    }

    public function edit(Joueur $joueur): View
    {
        $categories = Categorie::orderBy('nom')->get();

        return view('admin.joueurs.edit', compact('joueur', 'categories'));
    }

    public function update(Request $request, Joueur $joueur): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'poste' => ['required', 'string', 'max:255'],
            'categorie_id' => ['required', 'exists:categories,id'],
            'numero' => ['required', 'integer', 'min:0'],
            'capitaine' => ['nullable', 'boolean'],
            'eloges' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'photo_crop_data' => ['nullable', 'string'],
        ]);

        $validated['capitaine'] = (bool) ($validated['capitaine'] ?? false);

        if ($request->hasFile('photo')) {
            if ($joueur->photo) {
                Storage::disk('public')->delete($joueur->photo);
            }
            $file = $request->file('photo');
            $path = $file->store('joueurs', 'public');

            // Traitement du crop si présent
            if ($request->filled('photo_crop_data')) {
                $crop = json_decode($request->input('photo_crop_data'), true);
                $image = Image::make($file->getRealPath());
                $image->crop(
                    intval($crop['width']),
                    intval($crop['height']),
                    intval($crop['x']),
                    intval($crop['y'])
                );
                $image->save(storage_path('app/public/' . $path));
            }
            $validated['photo'] = $path;
        }

        if ($validated['capitaine']) {
            Joueur::where('categorie_id', $validated['categorie_id'])
                ->where('id', '!=', $joueur->id)
                ->update(['capitaine' => false]);
        }

        $joueur->update($validated);

        return redirect()->route('admin.joueurs.index');
    }

    public function destroy(Joueur $joueur): RedirectResponse
    {
        if ($joueur->photo) {
            Storage::disk('public')->delete($joueur->photo);
        }

        $joueur->delete();

        return redirect()->route('admin.joueurs.index');
    }
}
