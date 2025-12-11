<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Langue extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'nom',
        'description',
    ];

    // Relation avec les users
    public function users()
    {
        return $this->hasMany(User::class, 'langue', 'id');
    }
}
