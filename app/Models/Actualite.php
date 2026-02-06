<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    protected $fillable = [
        'titre',
        'contenu',
        'image',
        'date_publication',
        'auteur'
    ];

    protected $casts = [
        'date_publication' => 'datetime'
    ];

    public function getExtraitAttribute(): string
    {
        return substr(strip_tags($this->contenu), 0, 150) . '...';
    }
}
