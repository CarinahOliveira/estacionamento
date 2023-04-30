<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'placa_veiculo',
    ];

    public function checkinoutVeiculo() {
        return $this->hasOne(Checkinout::class, 'id_veiculo', 'id');
    }
}
