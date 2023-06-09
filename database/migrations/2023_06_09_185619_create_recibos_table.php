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
        Schema::create('recibos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_veiculo')->index('id_veiculo_idx');
            $table->dateTime('dh_recibo');
            $table->string('tempo_permanencia', 10);
            $table->string('valor', 10);
            $table->integer('id_usuario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibos');
    }
};
