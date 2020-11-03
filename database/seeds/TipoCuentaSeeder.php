<?php

use Illuminate\Database\Seeder;

class TipoCuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_cuenta')->insert([
            'nombre'=>'Acreedora',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tipo_cuenta')->insert([
            'nombre'=>'Deudora',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
    }
}
