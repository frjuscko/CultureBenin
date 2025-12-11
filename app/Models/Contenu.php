<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'texte',
        'datepub',
        'statut',
        'dateval',
        'region',
        'langue',
        'type',
        'auteur',
        'moderateur',
        'parent',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'datepub' => 'datetime',
        'dateval' => 'datetime',
    ];

    // Relation avec l'auteur
    public function getAuteur()
    {
        return $this->belongsTo(User::class, 'auteur');
    }

    // Relation avec le modérateur
    public function getModerateur()
    {
        return $this->belongsTo(User::class, 'moderateur');
    }

    // Relation avec la région
    public function getRegion()
    {
        return $this->belongsTo(Region::class, 'region');
    }

    // Relation avec la langue
    public function getLangue()
    {
        return $this->belongsTo(Langue::class, 'langue');
    }

    // Relation avec le type de contenu
    public function getType()
    {
        return $this->belongsTo(TypeContenu::class, 'type');
    }

    // Relation avec le contenu parent (pour les traductions)
    public function getParent()
    {
        return $this->belongsTo(Contenu::class, 'parent');
    }

    // Relation avec les contenus enfants (traductions)
    public function traductions()
    {
        return $this->hasMany(Contenu::class, 'parent');
    }

    // Relation avec les médias
    public function medias()
    {
        return $this->hasMany(Media::class, 'contenu');
    }

    // Relation avec les commentaires
    public function commentaires(){
        return $this->hasMany(Commentaire::class, 'contenu');
    }

    // Scope pour les contenus validés
    public function scopeValides($query)
    {
        return $query->where('statut', 'validé');
    }

    // Scope pour les contenus en attente
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en attente');
    }

    // Méthode pour vérifier si le contenu est validé
    public function estValide()
    {
        return $this->statut === 'validé';
    }

    // Méthode pour obtenir le contenu original (pour les traductions)
    public function getOriginalAttribute()
    {
        return $this->parent ? $this->parent : $this;
    }
}