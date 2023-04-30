<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'num_vaga',
        'id_patio',
        'status',
    ];

    public function checkinoutVaga() {
        return $this->hasOne(Checkinout::class, 'num_vaga', 'num_vaga');
    }
}
