<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {








    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        #DB::unprepared('DROP FUNCTION delete_req_after_arc() CASCADE');
    }
}
