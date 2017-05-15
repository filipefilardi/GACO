<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggersFunctions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // creates function - verifies that request has been changed status to COMP
        DB::unprepared('CREATE OR REPLACE FUNCTION prepare_confirmation_table() RETURNS trigger AS
            $BODY$
                BEGIN
                    IF NEW.status_req <> OLD.status_req THEN
                        IF NEW.status_req = `COMP` THEN
                            INSERT INTO request_confirmation (id_req,id_user_req_sign, id_user_assign_sign, id_del)
                            VALUES(OLD.id_req,`N`,`N`,0);
                        END IF;
                    END IF;

                    RETURN NEW;
                END
            $BODY$
            LANGUAGE plpgsql VOLATILE
            COST 100;'
        );

        // binding Trigger - verifies that request has been changed status to COMP
        DB::unprepared('CREATE TRIGGER update_status_req
            AFTER UPDATE
            ON request
            FOR EACH ROW
            EXECUTE PROCEDURE prepare_confirmation_table();'
        );

        // creates function - verifies both users confirmed request and inactivates
        DB::unprepared('CREATE OR REPLACE FUNCTION inactive_comp_request() RETURNS trigger AS
            $BODY$
                BEGIN
                    IF NEW.id_user_req_sign <> OLD.id_user_req_sign or NEW.id_user_assign_sign <> OLD.id_user_assign_sign THEN
                        IF NEW.id_user_req_sign  = `Y` and NEW.id_user_assign_sign = `Y` THEN
                            UPDATE request
                            SET id_active = `N`
                            WHERE id_req = OLD.id_req;
                        END IF;
                    END IF;

                    RETURN NEW;
                END
            $BODY$
            LANGUAGE plpgsql VOLATILE
            COST 100;'
        );

        // binding Trigger - verifies both users confirmed request and inactivates
        DB::unprepared('CREATE TRIGGER req_confirmation_update
            AFTER UPDATE
            ON request_confirmation
            FOR EACH ROW
            EXECUTE PROCEDURE inactive_comp_request();'
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION prepare_confirmation_table() CASCADE');
        DB::unprepared('DROP FUNCTION inactive_comp_request() CASCADE');
    }
}
