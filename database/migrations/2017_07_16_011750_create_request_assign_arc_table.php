<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestAssignArcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_assignment', function (Blueprint $table) {
                $table->date('dt_arc');
                $table->integer('id_req');
                $table->integer('id_user_assign');
                $table->date('dt_predicted');
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
