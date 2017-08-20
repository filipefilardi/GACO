<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestConfirmationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_confirmation', function (Blueprint $table) {
                $table->string('id_sign', 1)->default('N');
                $table->date('dt_sign')->nullable();
                $table->timestamps();
                $table->integer('lst_chg_by')->nullable();
                $table->integer('id_del')->default(0);
        });

        Schema::table('request_confirmation', function($table) {
            $table->integer('id_req')->unsigned();
            $table->foreign('id_req')->references('id_req')->on('request')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_confirmation');
    }
}
