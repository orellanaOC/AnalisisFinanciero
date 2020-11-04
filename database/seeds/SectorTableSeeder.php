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
        //

        DB::table('sector')->insert([
            'nombre'=>'Primario',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sector')->insert([
            'nombre'=>'Secundario',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('sector')->insert([
            'nombre'=>'Terciario',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
