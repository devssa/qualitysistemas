<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCadastroDeDependentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastro_dependentes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pessoa_id')->nullable();
            $table->string('nome');
            $table->string('data_nascimento');
            $table->timestamps();

            $table->foreign('pessoa_id')
                  ->references('id')
                  ->on('cadastro_pessoas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadastro_dependentes');
    }
}
