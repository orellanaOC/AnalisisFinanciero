<?php

use Illuminate\Database\Seeder;

class TablaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tabla')->insert([
        	'nombre' => 'Usuarios'
        ]);

        DB::table('tabla')->insert([
        	'nombre' => 'Permiso - Usuario'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Permiso - Rol'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Rol'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Rol - Usuario'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Sector'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Empresa'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Período'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Balance General'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Estado de Resultados'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Tipo de Cuenta'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Cuenta'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Cuenta - Periodo'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Tipo de Parámetro'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Parámetro'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Análisis'
        ]);
        
        DB::table('tabla')->insert([
        	'nombre' => 'Razón'
        ]);
    }
}
