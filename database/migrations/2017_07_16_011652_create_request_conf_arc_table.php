<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestConfArcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_confirmation_arc', function (Blueprint $table) {
                $table->date('dt_arc');
                $table->integer('id_req');
                $table->string('id_user_req_sign',1);
                $table->string('id_user_assign_sign',1);
                $table->date('dt_user_req_sign')->default(null)->nullable;
                $table->date('dt_user_assign_sign')->default(null)->nullable;
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
        //
    }
}
