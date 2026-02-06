<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Categorie extends Model
{
    protected $fillable = [
        'nom',
        'genre',
        'age_min',
        'age_max',
        'coach_id',
        'description',
        'photo',
        'photo_position'
    ];

    protected $appends = ['photo_url', 'photo_style'];

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class);
    }

    public function joueurs(): HasMany
    {
        return $this->hasMany(Joueur::class);
    }

    public function emploiDuTemps(): HasMany
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    public function scopeByGenre($query, $genre)
    {
        return $query->where('genre', $genre);
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return Storage::disk('public')->url('categories/' . $this->photo);
        }
        return null;
    }

    public function getPhotoStyleAttribute()
    {
        $position = $this->photo_position ?? 'center';
        return "object-fit: cover; object-position: {$position};";
    }

    public function deletePhoto()
    {
        if ($this->photo && Storage::disk('public')->exists('categories/' . $this->photo)) {
            Storage::disk('public')->delete('categories/' . $this->photo);
        }
    }
}
