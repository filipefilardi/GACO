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

        Schema::table('request_master', function($table) {
            $table->integer('id_user_req')->unsigned();
            $table->foreign('id_user_req')->references('id_user')->on('users')->onDelete('cascade');;
            $table->integer('id_add')->unsigned();
            $table->foreign('id_add')->references('id_add')->on('address')->onDelete('cascade');;
        });

        Schema::table('request_postpone', function($table) {
            $table->integer('id_user_post')->unsigned();
            $table->foreign('id_user_post')->references('id_user')->on('users')->onDelete('cascade');;
            $table->integer('id_req_master')->unsigned();
            $table->foreign('id_req_master')->references('id_req_master')->on('request_master')->onDelete('cascade');; 
            #$table->integer('id_assign')->unsigned();
            #$table->foreign('id_assign')->references('id_assign')->on('request_assignment')->onDelete('cascade');; 
        });

        Schema::table('request', function($table) {
            $table->integer('id_user_req')->unsigned();
            $table->foreign('id_user_req')->references('id_user')->on('users')->onDelete('cascade');; // to be REMOVED when new flow goes in
            $table->integer('id_garbage')->unsigned();
            $table->foreign('id_garbage')->references('id_garbage')->on('garbage')->onDelete('cascade');;
            $table->integer('id_add')->unsigned();
            $table->foreign('id_add')->references('id_add')->on('address')->onDelete('cascade');; // to be REMOVED when new flow goes in
            $table->integer('id_req_master')->unsigned();
            $table->foreign('id_req_master')->references('id_req_master')->on('request_master')->onDelete('cascade');; // to be ADDED when new flow goes in
        });

        Schema::table('coop_evaluation', function($table) {
            $table->integer('id_req_master')->unsigned();
            $table->foreign('id_req_master')->references('id_req_master')->on('request_master')->onDelete('cascade');;
        });

        Schema::table('request_assignment', function($table) {
            $table->integer('id_req_master')->unsigned();
            $table->foreign('id_req_master')->references('id_req_master')->on('request_master')->onDelete('cascade');;
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
        });

        Schema::table('user_enterprise', function($table) {
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');;
        });


        Schema::table('user_cooperative', function($table) {
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');;
        });

        Schema::table('garbage_collector', function($table) {
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');;
            $table->integer('id_garbage')->unsigned();
            $table->foreign('id_garbage')->references('id_garbage')->on('garbage')->onDelete('cascade');;
        });

        Schema::table('address', function($table) {
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('coop_evaluation');
        Schema::dropIfExists('request_assignment');
        Schema::dropIfExists('request_postpone');
        Schema::dropIfExists('request');
        Schema::dropIfExists('request_master');
        Schema::dropIfExists('garbage_collector');
        Schema::dropIfExists('garbage');
        Schema::dropIfExists('address');
        Schema::dropIfExists('users');
        Schema::dropIfExists('category');
    }
}
