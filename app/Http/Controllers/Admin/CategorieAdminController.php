<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Coach;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;

class CategorieAdminController extends Controller
{
    public function index(): View
    {
        $categories = Categorie::with('coach')->latest()->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $coaches = Coach::orderBy('prenom')->orderBy('nom')->get();

        return view('admin.categories.create', compact('coaches'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'in:garcon,fille'],
            'age_min' => ['required', 'integer', 'min:0'],
            'age_max' => ['required', 'integer', 'gte:age_min'],
            'coach_id' => ['required', 'exists:coaches,id'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'photo_crop_data' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('categories', 'public');

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

        Categorie::create($validated);

        return redirect()->route('admin.categories.index');
    }

    public function edit(Categorie $category): View
    {
        $coaches = Coach::orderBy('prenom')->orderBy('nom')->get();

        return view('admin.categories.edit', [
            'categorie' => $category,
            'coaches' => $coaches,
        ]);
    }

    public function update(Request $request, Categorie $category): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'in:garcon,fille'],
            'age_min' => ['required', 'integer', 'min:0'],
            'age_max' => ['required', 'integer', 'gte:age_min'],
            'coach_id' => ['required', 'exists:coaches,id'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'photo_crop_data' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('photo')) {
            if ($category->photo) {
                Storage::disk('public')->delete($category->photo);
            }
            $file = $request->file('photo');
            $path = $file->store('categories', 'public');

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

        $category->update($validated);

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Categorie $category): RedirectResponse
    {
        if ($category->photo) {
            Storage::disk('public')->delete($category->photo);
        }

        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
