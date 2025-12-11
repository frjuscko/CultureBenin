<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'statut',
        'texte',
        'note',
        'contenu',
        'utilisateur',
        'created_at',
        'updated_at'
    ];

    // Relation avec les users
    public function user()
    {
        return $this->belongsTo(User::class, 'utilisateur');
    }

    public function getContenu()
    {
        return $this->belongsTo(Contenu::class, 'contenu');
    }
}
