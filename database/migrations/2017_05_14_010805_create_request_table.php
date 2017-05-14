<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->increments('id_req');
            $table->string('desc_req');
            $table->string('mod_req');
            $table->string('status_garbage');
            $table->string('status_req');
            $table->string('id_active', 1);
            $table->date('dt_colect');
            $table->timestamps();
            $table->integer('lst_chg_by');
            $table->integer('id_del');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}