<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /** @use HasFactory<\Database\Factories\CharacterFactory> */
    use HasFactory;
	
	protected $fillable = [
        'user_id',
        'name',
        'class',
        'level',
        // Aggiungi altri campi necessari
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
