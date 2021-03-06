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
        $acceptedStatus = 'ACPT';
        $canceledStatus = 'CNCL';
        $pendingStatus  = 'PEND';
        $deletedFlag  = 1;

        // creates function - verifies that request has been changed status to COMP
        DB::unprepared("CREATE OR REPLACE FUNCTION prepare_confirmation_table() RETURNS trigger AS
            $$
                BEGIN
                    IF NEW.status_req <> OLD.status_req THEN
                        IF NEW.status_req = '$acceptedStatus' THEN
                            INSERT INTO request_confirmation (id_req_master,id_sign, id_del)
                            VALUES(OLD.id_req_master,'$noFlag',0);
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
            ON request_master
            FOR EACH ROW
            EXECUTE PROCEDURE prepare_confirmation_table();"
        );

        // creates function - verifies both users confirmed request and inactivates
        DB::unprepared("CREATE OR REPLACE FUNCTION inactive_comp_request() RETURNS trigger AS
            $$
                BEGIN
                    IF NEW.id_sign <> OLD.id_sign THEN
                        IF NEW.id_sign  = '$yesFlag' THEN
                            UPDATE request_master
                            SET id_active = '$noFlag', status_req = '$completeStatus'
                            WHERE id_req_master = OLD.id_req_master;

                            UPDATE request
                            SET id_active = '$noFlag', status_req = '$completeStatus'
                            WHERE id_req_master = OLD.id_req_master;
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

        // creates function - updates req status to accepted ACPT
        DB::unprepared("CREATE OR REPLACE FUNCTION req_status_acpt_change() RETURNS trigger AS
            $$
                BEGIN
                    UPDATE request_master
                    SET status_req = '$acceptedStatus'
                    WHERE id_req_master = NEW.id_req_master;

                    UPDATE request
                    SET status_req = '$acceptedStatus'
                    WHERE id_req_master = NEW.id_req_master;
                    RETURN NEW;

                    UPDATE request_postpone
                    SET id_del = '$deletedFlag', id_active = '$noFlag'
                    WHERE id_req_master = NEW.id_req_master;
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

        // creates function - updates req status to accepted ACPT
        DB::unprepared("CREATE OR REPLACE FUNCTION req_master_status_change() RETURNS trigger AS
            $$
                BEGIN
                    IF NEW.status_req <> OLD.status_req THEN
                        IF NEW.status_req  = '$canceledStatus' THEN
                            UPDATE request
                            SET status_req = '$canceledStatus'
                            WHERE id_req_master = OLD.id_req_master;

                            UPDATE request_assignment
                            SET id_del = '$deletedFlag'
                            WHERE id_req_master = OLD.id_req_master;

                            UPDATE request_confirmation
                            SET id_del = '$deletedFlag'
                            WHERE id_req_master = OLD.id_req_master;

                            UPDATE request_postpone
                            SET id_del = '$deletedFlag'
                            WHERE id_req_master = OLD.id_req_master;
                        END IF;
                        IF NEW.status_req  = '$pendingStatus' THEN
                            UPDATE request
                            SET status_req = '$pendingStatus'
                            WHERE id_req_master = OLD.id_req_master;

                            UPDATE request_assignment
                            SET id_del = '$deletedFlag'
                            WHERE id_req_master = OLD.id_req_master;

                            UPDATE request_confirmation
                            SET id_del = '$deletedFlag'
                            WHERE id_req_master = OLD.id_req_master;
                        END IF;
                    END IF;
                    RETURN NEW;
                END
            $$
            LANGUAGE plpgsql VOLATILE
            COST 100;"
        );

        // binding Trigger - verifies new entry is added to request_assigment - meaning req is accepted
        DB::unprepared("CREATE TRIGGER req_master_status_change
            AFTER UPDATE
            ON request_master
            FOR EACH ROW
            EXECUTE PROCEDURE req_master_status_change();"
        );

        // creates function - updates req status to accepted ACPT
        DB::unprepared("CREATE OR REPLACE FUNCTION postpone_inactivate_prev() RETURNS trigger AS
            $$
                BEGIN
                    UPDATE request_postpone
                    SET id_active = '$noFlag'
                    WHERE id_req_master = NEW.id_req_master;
                    RETURN NEW;
                END
            $$
            LANGUAGE plpgsql VOLATILE
            COST 100;"
        );

        // binding Trigger - verifies new entry is added to request_assigment - meaning req is accepted
        DB::unprepared("CREATE TRIGGER postpone_req_insert
            BEFORE INSERT
            ON request_postpone
            FOR EACH ROW
            EXECUTE PROCEDURE postpone_inactivate_prev();"
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
        DB::unprepared('DROP FUNCTION req_master_status_change() CASCADE');
    }
}
