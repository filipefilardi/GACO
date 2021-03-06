<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_person', function (Blueprint $table) {
            $table->string('nm_user');
            $table->date('dt_birth');
            $table->bigInteger('ph_mob');
            $table->bigInteger('ph_res');
            $table->bigInteger('cpf_user');
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
