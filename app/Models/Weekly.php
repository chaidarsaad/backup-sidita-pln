<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekly extends Model
{
    use HasFactory;

    protected $table = 'weeklys';

    protected $fillable = [
        'name',
        'progress',
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
