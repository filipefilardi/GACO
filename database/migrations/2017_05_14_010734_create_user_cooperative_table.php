<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCooperativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cooperative', function (Blueprint $table) {
            $table->string('nm_user');
            $table->bigInteger('ph_numb');
            $table->bigInteger('cnpj_user');
            $table->integer('id_radius_user');
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
