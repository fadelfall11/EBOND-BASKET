<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coach extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'specialite',
        'experience',
        'photo',
        'photo_position',
        'bio'
    ];

    protected $appends = ['photo_style'];

    public function categories(): HasMany
    {
        return $this->hasMany(Categorie::class);
    }

    public function getPhotoStyleAttribute()
    {
        // Si la position est 'center' (valeur par défaut) ou null, on force 'top' pour les portraits
        $position = (!$this->photo_position || $this->photo_position === 'center') ? 'top' : $this->photo_position;
        return "object-fit: cover; object-position: {$position};";
    }
}
