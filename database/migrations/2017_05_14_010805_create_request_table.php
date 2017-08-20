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
            $table->string('state')->nullable();
            $table->string('observation', 140)->nullable();
            $table->string('desc_req')->nullable();
            $table->string('status_req');
            $table->integer('quantity');
            $table->string('conf_token');
            $table->string('id_active', 1);
            $table->date('dt_req');
            $table->date('dt_collect')->nullable();
            $table->timestamps();
            $table->integer('lst_chg_by')->nullable();
            $table->integer('id_del')->default(0);
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
