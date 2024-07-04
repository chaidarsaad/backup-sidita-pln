<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bapp extends Model
{
    use HasFactory;

    protected $table = 'bapps';

    protected $fillable = [
        'name',
        'date_created',
        'is_approve',
        'date_approved',
        'file'
    ];

    // cast
    protected $casts = [
        'date_created' => 'datetime',
        'date_approved' => 'datetime',
        'is_approve' => 'boolean',
    ];
}
