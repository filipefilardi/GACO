<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_master', function (Blueprint $table) {
            $table->increments('id_req_master');
            $table->string('status_req');
            $table->string('conf_token');
            $table->string('id_active', 1);
            $table->string('tx_weekdays');
            $table->string('tx_period_day');
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
