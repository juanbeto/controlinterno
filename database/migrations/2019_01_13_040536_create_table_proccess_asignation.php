<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProccessAsignation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_proccess_asignation', function (Blueprint $table) {
            $table->increments('id_asignation');
            $table->foreign('ID_PROC')->references('ID_PROCCESS')->on('risks_process');
            $table->foreign('ID_FAc')->references('ID_FACTOR')->on('risks_factor');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risk_proccess_asignation');
    }
}
