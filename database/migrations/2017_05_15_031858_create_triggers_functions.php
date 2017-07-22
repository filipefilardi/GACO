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
        $yesFlag = 'Y';
        $noFlag = 'N';
        $completeStatus = 'COMP';
        $acceptedStatus = 'ACTP';

        // creates function - verifies that request has been changed status to COMP
        DB::unprepared("CREATE OR REPLACE FUNCTION prepare_confirmation_table() RETURNS trigger AS
            $$
                BEGIN
                    IF NEW.status_req <> OLD.status_req THEN
                        IF NEW.status_req = '$completeStatus' THEN
                            INSERT INTO request_confirmation (id_req,id_user_req_sign, id_user_assign_sign, id_del)
                            VALUES(OLD.id_req,'$noFlag','$noFlag',0);
                        END IF;
                    END IF;

                    RETURN NEW;
                END
            $$
            LANGUAGE plpgsql VOLATILE
            COST 100;"
        );

        // binding Trigger - verifies that request has been changed status to COMP
        DB::unprepared("CREATE TRIGGER update_status_req
            AFTER UPDATE
            ON request
            FOR EACH ROW
            EXECUTE PROCEDURE prepare_confirmation_table();"
        );

        // creates function - verifies both users confirmed request and inactivates
        DB::unprepared("CREATE OR REPLACE FUNCTION inactive_comp_request() RETURNS trigger AS
            $$
                BEGIN
                    IF NEW.id_user_req_sign <> OLD.id_user_req_sign or NEW.id_user_assign_sign <> OLD.id_user_assign_sign THEN
                        IF NEW.id_user_req_sign  = '$yesFlag' and NEW.id_user_assign_sign = '$yesFlag' THEN
                            UPDATE request
                            SET id_active = '$noFlag'
                            WHERE id_req = OLD.id_req;
                        END IF;
                    END IF;

                    RETURN NEW;
                END
            $$
            LANGUAGE plpgsql VOLATILE
            COST 100;"
        );

        // binding Trigger - verifies both users confirmed request and inactivates
        DB::unprepared("CREATE TRIGGER req_confirmation_update
            AFTER UPDATE
            ON request_confirmation
            FOR EACH ROW
            EXECUTE PROCEDURE inactive_comp_request();"
        );

        // creates function - verifies inactivated row and moves to archive
        DB::unprepared("CREATE OR REPLACE FUNCTION move_req_arc() RETURNS trigger AS
            $$
                BEGIN
                    IF NEW.id_active = '$noFlag' THEN
                        INSERT INTO request_arc (dt_arc,id_req,desc_req,mod_req,status_garbage,status_req,id_active,dt_collect,id_user_req,id_garbage,lst_chg_by,id_del)
                        SELECT CURRENT_TIMESTAMP,id_req,desc_req,mod_req,status_garbage,status_req,id_active,dt_collect,id_user_req,id_garbage,lst_chg_by,id_del
                        FROM request
                        WHERE id_req = OLD.id_req;
                    END IF;

                    RETURN NEW;
                END
            $$
            LANGUAGE plpgsql VOLATILE
            COST 100;"
        );

        // binding Trigger - verifies both users confirmed request and inactivates
        DB::unprepared("CREATE TRIGGER req_finish_archive
            AFTER UPDATE
            ON request
            FOR EACH ROW
            EXECUTE PROCEDURE move_req_arc();"
        );

        // creates function - updates req status to accepted ACPT
        DB::unprepared("CREATE OR REPLACE FUNCTION req_status_acpt_change() RETURNS trigger AS
            $$
                BEGIN
                    UPDATE request
                    SET status_req = '$acceptedStatus'
                    WHERE id_req = NEW.id_req;
                    RETURN NEW;
                END
            $$
            LANGUAGE plpgsql VOLATILE
            COST 100;"
        );

        // binding Trigger - verifies new entry is added to request_assigment - meaning req is accepted
        DB::unprepared("CREATE TRIGGER req_assignment_insert
            AFTER INSERT
            ON request_assignment
            FOR EACH ROW
            EXECUTE PROCEDURE req_status_acpt_change();"
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
        DB::unprepared('DROP FUNCTION req_status_acpt_change() CASCADE');
        DB::unprepared('DROP FUNCTION move_req_arc() CASCADE');
    }
}
