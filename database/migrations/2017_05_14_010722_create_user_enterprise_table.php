<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEnterpriseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_enterprise', function (Blueprint $table) {
            $table->string('nm_user');
            $table->bigInteger('ph_corp');
            $table->bigInteger('cnpj_user');
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
