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

        //DB::unprepared("CREATE OR REPLACE FUNCTION insert_request_batch(OUT status boolean) AS
        //     $$
        //         BEGIN
        //             
        //         END
        //     $$
        //     LANGUAGE plpgsql VOLATILE
        //     COST 100;"
        // );






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
