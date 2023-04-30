<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patio extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "patios";
    protected $fillable = [
        'id',
        'capacidade',
    ];
}
