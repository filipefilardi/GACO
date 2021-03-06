<?php

use Illuminate\Database\Seeder;

class PermissionTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /////////////////////////////////////////// USER CAT 1
        DB::table('permission')->insert([
        	'id_cat' => "1",
            'nm_perm' => "create_request",
            'desc_perm' => "this permission allows to create requests",
        ]);
        DB::table('permission')->insert([
        	'id_cat' => "1",
            'nm_perm' => "view_my_requests",
            'desc_perm' => "this permission allows to view my own requests",
        ]);
        DB::table('permission')->insert([
        	'id_cat' => "1",
            'nm_perm' => "confirm_request",
            'desc_perm' => "this permission allows to confirm a given request",
        ]);
        DB::table('permission')->insert([
            'id_cat' => "1",
            'nm_perm' => "cancel_requests",
            'desc_perm' => "this permission allows to cancel a given request",
        ]);
        DB::table('permission')->insert([
            'id_cat' => "1",
            'nm_perm' => "postpone_requests",
            'desc_perm' => "this permission allows to postpone a given request",
        ]);


        /////////////////////////////////////////// USER CAT 2
        DB::table('permission')->insert([
        	'id_cat' => "2",
            'nm_perm' => "create_request",
            'desc_perm' => "this permission allows to create requests",
        ]);
        DB::table('permission')->insert([
        	'id_cat' => "2",
            'nm_perm' => "view_my_requests",
            'desc_perm' => "this permission allows to view my own requests",
        ]);
        DB::table('permission')->insert([
        	'id_cat' => "2",
            'nm_perm' => "confirm_request",
            'desc_perm' => "this permission allows to confirm a given request",
        ]);
        DB::table('permission')->insert([
            'id_cat' => "2",
            'nm_perm' => "cancel_requests",
            'desc_perm' => "this permission allows to cancel a given request",
        ]);
        DB::table('permission')->insert([
            'id_cat' => "2",
            'nm_perm' => "postpone_requests",
            'desc_perm' => "this permission allows to postpone a given request",
        ]);


        /////////////////////////////////////////// USER CAT 3 - COOP
        DB::table('permission')->insert([
        	'id_cat' => "3",
            'nm_perm' => "view_all_requests",
            'desc_perm' => "this permission allows to view all requests",
        ]);
        DB::table('permission')->insert([
        	'id_cat' => "3",
            'nm_perm' => "confirm_requests",
            'desc_perm' => "this permission allows to confirm a given request",
        ]);
        DB::table('permission')->insert([
        	'id_cat' => "3",
            'nm_perm' => "accept_requests",
            'desc_perm' => "this permission allows to accept a given request",
        ]);
        DB::table('permission')->insert([
            'id_cat' => "3",
            'nm_perm' => "cancel_requests",
            'desc_perm' => "this permission allows to cancel a given request",
        ]);
        DB::table('permission')->insert([
            'id_cat' => "3",
            'nm_perm' => "postpone_requests",
            'desc_perm' => "this permission allows to postpone a given request",
        ]);

        ////////////////////////////////////////// USER CAT 4 - MASTER
        DB::table('permission')->insert([
        	'id_cat' => "4",
            'nm_perm' => "view_all_requests",
            'desc_perm' => "this permission allows to view all requests",
        ]);
        DB::table('permission')->insert([
        	'id_cat' => "4",
            'nm_perm' => "create_user",
            'desc_perm' => "this permission allows to create users",
        ]);
        DB::table('permission')->insert([
        	'id_cat' => "4",
            'nm_perm' => "create_request",
            'desc_perm' => "this permission allows to create requests",
        ]);
    }
}
