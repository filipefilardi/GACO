<?php

use Illuminate\Database\Seeder;

class CategoryTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'nm_cat' => 'cliente_cpf',
            'table_cat' => 'user_person',
            'lst_chg_by' => 1,
            'id_del' => 1,
        ]);
        DB::table('category')->insert([
            'nm_cat' => 'cliente_cnpf',
            'table_cat' => 'user_enterprise',
            'lst_chg_by' => 1,
            'id_del' => 1,
        ]);
        DB::table('category')->insert([
            'nm_cat' => 'cliente_cooperativa',
            'table_cat' => 'user_cooperative',
            'lst_chg_by' => 1,
            'id_del' => 1,
        ]);
        DB::table('category')->insert([
            'nm_cat' => 'master',
            'table_cat' => 'user_master',
            'lst_chg_by' => 1,
            'id_del' => 1,
        ]);
    }
}
