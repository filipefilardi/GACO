<?php

use Illuminate\Database\Seeder;

class MasterUserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => "nagoya@frito.com",
            'password' => bcrypt('secret'),
            'id_cat' => 4,
            'lst_chg_by' => 1,
            'id_del' => 1,
        ]);

        DB::table('users')->insert([
            'email' => "master@yoda.com",
            'password' => bcrypt('secret'),
            'id_cat' => 4,
            'lst_chg_by' => 1,
            'id_del' => 99,
        ]);

        DB::table('users')->insert([
            'email' => "rem@ram.com",
            'password' => bcrypt('secret'),
            'id_cat' => 4,
            'lst_chg_by' => 1,
            'id_del' => 1,
        ]);
    }
}
