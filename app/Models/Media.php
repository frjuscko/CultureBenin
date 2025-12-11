<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $fillable = [
        'type',
        'description',
        'fichier',
        'datepub',
        'contenu',
        'created_at',
    ];

    protected $casts = [
        'datepub' => 'datetime',
    ];

    // Relation avec le contenu
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'contenu');
    }

    // Accessor pour l'URL complète du fichier
    public function getUrlAttribute()
    {
        // Vérifie d'abord si le fichier existe
        if (! $this->fichier) {
            return null;
        }

        // Retourne l'URL complète
        return asset('storage/contenus/'.$this->fichier);
    }


    // Accessor pour le chemin physique
    public function getCheminAttribute()
    {
        return storage_path('app/public/contenus/'.$this->fichier);
    }

    // Méthode pour vérifier le type de média
    public function estImage()
    {
        return in_array($this->type, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }

    public function estVideo()
    {
        return in_array($this->type, ['mp4', 'avi', 'mov', 'wmv']);
    }
}
