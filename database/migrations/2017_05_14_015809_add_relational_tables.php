<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationalTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->integer('id_cat')->unsigned();
            $table->foreign('id_cat')->references('id_cat')->on('category')->onDelete('cascade');;
        });

        Schema::table('permission', function($table) {
            $table->integer('id_cat')->unsigned();
            $table->foreign('id_cat')->references('id_cat')->on('category')->onDelete('cascade');;
        });

        Schema::table('request', function($table) {
            $table->integer('id_user_req')->unsigned();
            $table->foreign('id_user_req')->references('id_user')->on('users')->onDelete('cascade');;
            $table->integer('id_garbage')->unsigned();
            $table->foreign('id_garbage')->references('id_garbage')->on('garbage')->onDelete('cascade');;
        });

        Schema::table('request_assignment', function($table) {
            $table->integer('id_req')->unsigned();
            $table->foreign('id_req')->references('id_req')->on('request')->onDelete('cascade');;
            $table->integer('id_user_assign')->unsigned();
            $table->foreign('id_user_assign')->references('id_user')->on('users')->onDelete('cascade');;
        });

        Schema::table('user_master', function($table) {
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');;
        });

        Schema::table('user_person', function($table) {
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');;
            $table->integer('id_add')->unsigned();
            $table->foreign('id_add')->references('id_add')->on('address')->onDelete('cascade');;
        });

        Schema::table('user_enterprise', function($table) {
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');;
            $table->integer('id_add')->unsigned();
            $table->foreign('id_add')->references('id_add')->on('address')->onDelete('cascade');;
        });


        Schema::table('user_cooperative', function($table) {
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');;
            $table->integer('id_add')->unsigned();
            $table->foreign('id_add')->references('id_add')->on('address')->onDelete('cascade');;
        });

        Schema::table('garbage_collector', function($table) {
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');;
            $table->integer('id_garbage')->unsigned();
            $table->foreign('id_garbage')->references('id_garbage')->on('garbage')->onDelete('cascade');;
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
        //
        
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('permission');
        Schema::dropIfExists('user_master');
        Schema::dropIfExists('user_person');
        Schema::dropIfExists('user_enterprise');
        Schema::dropIfExists('user_cooperative');
        Schema::dropIfExists('request_assignment');
        Schema::dropIfExists('request');
        Schema::dropIfExists('garbage_collector');
        Schema::dropIfExists('garbage');
        Schema::dropIfExists('users');
        Schema::dropIfExists('address');
        Schema::dropIfExists('category');
        Schema::dropIfExists('request_confirmation');
    }
}
