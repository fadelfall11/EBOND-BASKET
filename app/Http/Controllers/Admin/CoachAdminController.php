<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CoachAdminController extends Controller
{
    public function index(): View
    {
        $coaches = Coach::orderBy('prenom')->orderBy('nom')->paginate(20);

        return view('admin.coaches.index', compact('coaches'));
    }

    public function create(): View
    {
        return view('admin.coaches.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'specialite' => ['nullable', 'string', 'max:255'],
            'experience' => ['nullable', 'integer', 'min:0'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('coaches', 'public');
        }

        Coach::create($validated);

        return redirect()->route('admin.coaches.index');
    }

    public function edit(Coach $coach): View
    {
        return view('admin.coaches.edit', compact('coach'));
    }

    public function update(Request $request, Coach $coach): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'specialite' => ['nullable', 'string', 'max:255'],
            'experience' => ['nullable', 'integer', 'min:0'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('photo')) {
            if ($coach->photo) {
                Storage::disk('public')->delete($coach->photo);
            }
            $validated['photo'] = $request->file('photo')->store('coaches', 'public');
        }

        $coach->update($validated);

        return redirect()->route('admin.coaches.index');
    }

    public function destroy(Coach $coach): RedirectResponse
    {
        if ($coach->photo) {
            Storage::disk('public')->delete($coach->photo);
        }

        $coach->delete();

        return redirect()->route('admin.coaches.index');
    }
}
