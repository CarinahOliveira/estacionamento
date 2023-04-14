<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_veiculo')->index('id_veiculo_idx');
            $table->dateTime('dh_recibo');
            $table->decimal('tempo_permanencia', 10, 0);
            $table->decimal('valor', 10, 0);
            $table->integer('id_preco_hora')->index('id_preco_hora_idx');
            $table->integer('id_funcionario')->index('id_funcionario_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibo');
    }
};
