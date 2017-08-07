<?php

use Illuminate\Database\Seeder;

class GarbageTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('garbage')->insert([
            'nm_garbage' => "Carregador"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Celular"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "CPU"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Drive CD/DVD"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Eletrodomesticos"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Fonte"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "HD"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Impressora"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Monitores"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Mouse"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Notebook"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Placa Mãe"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Processador"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Teclado"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Telefone"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Televisão"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Ventoinha"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Outros"
        ]);
    }
}
