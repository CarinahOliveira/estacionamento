<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;

    protected $table = "recibos";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_veiculo',
        'dh_recibo',
        'tempo_permanencia',
        'valor',
        'id_usuario'
    ];
}
