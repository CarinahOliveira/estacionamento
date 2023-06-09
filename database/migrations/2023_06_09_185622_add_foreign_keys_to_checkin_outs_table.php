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
        Schema::table('checkin_outs', function (Blueprint $table) {
            $table->foreign(['id_veiculo'], 'fk_checkin_outs_1')->references(['id'])->on('veiculos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_veiculo'], 'fk_id_veiculo')->references(['id'])->on('veiculos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['num_vaga'], 'fk_num_vaga')->references(['num_vaga'])->on('vagas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkin_outs', function (Blueprint $table) {
            $table->dropForeign('fk_checkin_outs_1');
            $table->dropForeign('fk_id_veiculo');
            $table->dropForeign('fk_num_vaga');
        });
    }
};
