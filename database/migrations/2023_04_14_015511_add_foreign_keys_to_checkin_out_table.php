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
        Schema::table('checkin_out', function (Blueprint $table) {
            $table->foreign(['id_funcionario'], 'id_funcionario_c')->references(['id'])->on('funcionario')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_patio'], 'id_patio_c')->references(['id_patio'])->on('vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_veiculo'], 'id_veiculo_c')->references(['id'])->on('veiculo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['num_vaga'], 'num_vaga')->references(['num_vaga'])->on('vaga')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkin_out', function (Blueprint $table) {
            $table->dropForeign('id_funcionario_c');
            $table->dropForeign('id_patio_c');
            $table->dropForeign('id_veiculo_c');
            $table->dropForeign('num_vaga');
        });
    }
};
