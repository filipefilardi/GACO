<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id_add');
            $table->float('id_lat');
            $table->float('id_lon');
            $table->string('id_comp');
            $table->string('nm_st');
            $table->string('id_st_numb'); // maybe int
            $table->string('nm_country');
            $table->string('nm_city');
            $table->string('id_cep');
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
