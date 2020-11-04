<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sector')->insert([
            'nombre'=>'Industrial',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sector')->insert([
            'nombre'=>'Minero',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sector')->insert([
            'nombre'=>'Ganaderia y Acuicultura',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sector')->insert([
            'nombre'=>'Servicios',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
