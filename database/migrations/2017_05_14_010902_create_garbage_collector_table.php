<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarbageCollectorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garbage_collector', function (Blueprint $table) {
                $table->timestamps();
                $table->integer('lst_chg_by')->nullable();
                $table->integer('id_del')->default(0);
        });
        // RELATIONAL TABLE - Links coop user and garbage table to 
        // reflect items that are on the coop workstream
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
