<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Checkinout extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "checkin_outs";
    protected $fillable = [
        'id',
        'num_vaga',
        'id_patio',
        'id_veiculo',
        'status',
        'id_usuario',
        'dh_registro',
        ];

    public function vaga() {
        return $this->hasOne(Vaga::class, 'num_vaga', 'num_vaga');
    }
    public function veiculo() {
        return $this->hasOne(Veiculo::class, 'id', 'id_veiculo');
    }
}
