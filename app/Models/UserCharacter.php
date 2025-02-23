<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCharacter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'character_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'character_id' => 'integer'
    ];

    protected $table = 'users_characters';
}
