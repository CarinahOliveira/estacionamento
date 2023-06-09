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
        Schema::create('checkin_outs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('num_vaga')->index('fk_new_table_1_idx');
            $table->string('id_patio', 8);
            $table->integer('id_veiculo')->index('fk_new_table_1_idx2');
            $table->integer('status')->nullable();
            $table->integer('id_usuario');
            $table->string('dh_registro', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkin_outs');
    }
};
