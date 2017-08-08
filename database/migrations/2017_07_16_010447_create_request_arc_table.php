<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestArcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_arc', function (Blueprint $table) {
            $table->date('dt_arc');
            $table->integer('id_req');
            $table->string('mod_req');
            $table->string('status_tv')->nullable();
            $table->string('status_req');
            $table->string('conf_token');
            $table->string('id_active', 1);
            $table->date('dt_collect');
            $table->integer('id_user_req');
            $table->integer('id_garbage');
            $table->timestamps();
            $table->integer('lst_chg_by')->nullable();
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
        Schema::dropIfExists('request_arc');
    }
}
