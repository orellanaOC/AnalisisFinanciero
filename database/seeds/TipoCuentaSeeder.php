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
        //Sectores Seeder
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
        DB::table('empresa')->insert([
            'nombre'=>'Empresa de prueba',
            'nit'=>'Nit de prueba',
            'nrc'=>'Nrcde de prueba',
            'sector_id'=>1,
            'user_id'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
