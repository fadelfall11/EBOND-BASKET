<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmploiDuTemps extends Model
{
    protected $table = 'emploi_du_temps';
    
    protected $fillable = [
        'categorie_id',
        'jour',
        'heure_debut',
        'heure_fin',
        'lieu',
        'description'
    ];

    protected $casts = [
        'heure_debut' => 'string',
        'heure_fin' => 'string',
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
    
}
