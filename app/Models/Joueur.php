<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Joueur extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'poste',
        'categorie_id',
        'numero',
        'capitaine',
        'photo',
        'photo_position',
        'eloges'
    ];

    protected $appends = ['full_name', 'photo_style'];

    protected $casts = [
        'capitaine' => 'boolean'
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getPhotoStyleAttribute()
    {
        // Si la position est 'center' (valeur par défaut) ou null, on force 'top' pour les portraits
        $position = (!$this->photo_position || $this->photo_position === 'center') ? 'top' : $this->photo_position;
        return "object-fit: cover; object-position: {$position};";
    }
}
