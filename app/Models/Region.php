<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'localisation',
        'superficie',
        'population'
    ];

    // Relation avec les users
    public function users()
    {
        return $this->hasMany(User::class, 'region');
    }

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'region');
    }
}
