<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoopEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coop_evaluation', function (Blueprint $table) {
            $table->increments('id_eval');
            $table->float('puctual_eval');
            $table->float('satisf_eval');
            $table->string('observation', 140)->nullable();
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
