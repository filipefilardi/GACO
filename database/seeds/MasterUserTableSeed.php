<?php

use Illuminate\Database\Seeder;

class MasterUserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'email' => "gaco@admin.com",
            'password' => bcrypt('secret'),
            'id_cat' => 4,
            'lst_chg_by' => 1,
            'id_del' => 0,
        ]);

        DB::table('users')->insert([
            'email' => "coopernova@admin.com",
            'password' => bcrypt('secret'),
            'id_cat' => 4,
            'lst_chg_by' => 1,
            'id_del' => 0,
        ]);

        DB::table('users')->insert([
            'email' => "recifavela@admin.com",
            'password' => bcrypt('secret'),
            'id_cat' => 4,
            'lst_chg_by' => 1,
            'id_del' => 0,
        ]);

        // DB::table('users')->insert([
        //     'email' => "coop@coop.com",
        //     'password' => bcrypt('secret'),
        //     'id_cat' => 3,
        //     'lst_chg_by' => 1,
        //     'id_del' => 0,
        // ]);

        // DB::table('user_cooperative')->insert([
        //     'nm_user' => "coop",
        //     'ph_numb' => 123456789,
        //     'cnpj_user' => 123456789,
        //     'id_radius_user' => 1,
        //     'lst_chg_by' => 1,
        //     'id_user' => 4,
        //     'id_del' => 0,
        // ]);

        // DB::table('users')->insert([
        //     'email' => "user@user.com",
        //     'password' => bcrypt('secret'),
        //     'id_cat' => 2,
        //     'lst_chg_by' => 1,
        //     'id_del' => 0,
        // ]);

        // DB::table('user_person')->insert([
        //     'nm_user' => "user",
        //     'dt_birth' => '20170305',
        //     'ph_mob' => 123456789,
        //     'ph_res' => 123456789,
        //     'cpf_user' => 123456789,
        //     'lst_chg_by' => 1,
        //     'id_user' => 5,
        //     'id_del' => 0,
        // ]);
    }
}
