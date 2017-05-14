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
            'nm_garbage' => "Bateria"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Caixa de Som"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Cabos"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Camera Fotografica"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Celular"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Computador"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Disquete"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Fone de Ouvido"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Geladeira"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Home Theater"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Notebook"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Pilha"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Tablet"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Televisor"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Video Game"
        ]);

        DB::table('garbage')->insert([
            'nm_garbage' => "Video Cassete"
        ]);
    }
}
