<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CoachController extends Controller
{
    public function show(Coach $coach)
    {
        $gallery = collect();

        $fullName = Str::lower(Str::ascii($coach->prenom . ' ' . $coach->nom));

        if ($fullName === 'alioune ndiaye') {
            $dir = public_path('images/alioune ndiaye');

            if (File::exists($dir)) {
                $gallery = collect(File::files($dir))
                    ->filter(function ($file) {
                        $ext = Str::lower($file->getExtension());
                        return in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                    })
                    ->sortBy(fn($file) => $file->getFilename())
                    ->values()
                    ->map(function ($file) {
                        return 'images/alioune ndiaye/' . $file->getFilename();
                    });
            }
        }

        $captions = [
            "Une relation de confiance qui se voit : écoute, respect et esprit d'équipe.",
            "Cohésion et solidarité : Alioune Ndiaye construit un groupe uni, match après match.",
            "Transmission et motivation : un coach proche de ses joueurs, pour faire grandir les talents.",
        ];

        return view('coaches.show', [
            'coach' => $coach,
            'gallery' => $gallery,
            'captions' => $captions,
        ]);
    }
}
