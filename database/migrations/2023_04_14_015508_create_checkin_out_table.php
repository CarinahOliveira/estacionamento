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
        Schema::create('checkin_out', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('num_vaga')->index('num_vaga_idx');
            $table->integer('id_patio')->index('id_patio_idx');
            $table->integer('id_veiculo')->index('id_veiculo_idx');
            $table->boolean('status');
            $table->integer('id_funcionario')->index('id_funcionario_idx');
            $table->dateTime('dh_registro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkin_out');
    }
};
