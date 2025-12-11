<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeContenu extends Model
{
    use HasFactory;

    // Spécifie le nom de la table
    protected $table = 'typecontenus';
    protected $fillable = [
        'libelle',
    ];

    // Relation avec les contenus
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'type');
    }
}
