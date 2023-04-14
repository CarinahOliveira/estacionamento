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
        Schema::table('recibo', function (Blueprint $table) {
            $table->foreign(['id_funcionario'], 'id_funcionario')->references(['id'])->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_preco_hora'], 'id_preco_hora')->references(['id'])->on('preco_hora')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_veiculo'], 'id_veiculo')->references(['id'])->on('veiculo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recibo', function (Blueprint $table) {
            $table->dropForeign('id_funcionario');
            $table->dropForeign('id_preco_hora');
            $table->dropForeign('id_veiculo');
        });
    }
};
