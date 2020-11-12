<?php

use Illuminate\Database\Seeder;

class ParametroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*---------------------------------------------------------------------------------*/

        DB::table('parametro')->insert([
            'parametro'=>'Razon de circulante o Liquidez corriente',
            'tipo_id'=> 1,
            'min'=> 1,
            'max'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón rápida o prueba ácida',
            'tipo_id'=> 1,
            'min'=> 1,
            'max'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón de activo neto de trabajo o activos totales',
            'tipo_id'=> 1,
            'valor'=> 0,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón de efectivo',
            'tipo_id'=> 1,
            'valor'=> 1,
        ]);

        /*---------------------------------------------------------------------------------*/

        DB::table('parametro')->insert([
            'parametro'=>'Razón de rotación de inventario',
            'tipo_id'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón de días de inventario',
            'tipo_id'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón de rotación de cuentas por pagar',
            'tipo_id'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón de período medio de pago',
            'tipo_id'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón de rotación de cuentas por cobrar',
            'tipo_id'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón de período medio de cobranza',
            'tipo_id'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Índice de rotación de activos totales',
            'tipo_id'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Índice de rotación de activos fijos',
            'tipo_id'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Índice de margen bruto',
            'tipo_id'=> 2,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Índice de margen operativo',
            'tipo_id'=> 2,
        ]);

        /*---------------------------------------------------------------------------------*/

        DB::table('parametro')->insert([
            'parametro'=>'Grado de endeudamiento',
            'tipo_id'=> 3,
            'min'=> 40,
            'max'=> 60,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Grado de propiedad',
            'tipo_id'=> 3,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón de endeudamiento patrimonial',
            'tipo_id'=> 3,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Razón de cobertura de gastos financieros',
            'tipo_id'=> 3,
            'valor'=> 1,
        ]);

        /*---------------------------------------------------------------------------------*/

        DB::table('parametro')->insert([
            'parametro'=>'ROE',
            'tipo_id'=> 4,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Rentabilidad por acción',
            'tipo_id'=> 4,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'ROA',
            'tipo_id'=> 4,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Rentabilidad sobre ventas',
            'tipo_id'=> 4,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Rentabilidad sobre inversión',
            'tipo_id'=> 4,
        ]);

        /*---------------------------------------------------------------------------------*/

        DB::table('parametro')->insert([
            'parametro'=>'Analisis Vertical',
            'tipo_id'=> 5,
        ]);
        DB::table('parametro')->insert([
            'parametro'=>'Analisis Horizontal',
            'tipo_id'=> 5,
        ]);
    }
}
