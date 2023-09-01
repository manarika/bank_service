<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{

    use HasFactory;
    protected $fillable = [
        'nom','prenom', 'email','tel', 'nbreofpersons', 'estimatedTime', 'status'
    ];

    // Define other model relationships, methods, etc.
}

