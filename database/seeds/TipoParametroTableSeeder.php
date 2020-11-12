<?php

use Illuminate\Database\Seeder;

class TipoParametroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_parametro')->insert([
            'nombre'=>'Razones de liquidez',
        ]);
        DB::table('tipo_parametro')->insert([
            'nombre'=>'Razones de actividad',
        ]);
        DB::table('tipo_parametro')->insert([
            'nombre'=>'Razones de endeudamiento (Apalancamiento)',
        ]);
        DB::table('tipo_parametro')->insert([
            'nombre'=>'Razones Financieras (Rentabilidad)',
        ]);
        DB::table('tipo_parametro')->insert([
            'nombre'=>'Individual',
        ]);
    }
}
