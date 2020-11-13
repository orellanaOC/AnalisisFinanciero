<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuentaSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Cuentas para Ratios
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Activos',
            'descripcion'=>'Es la cuenta que almacena los activos totales en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Pasivos',
            'descripcion'=>'Es la cuenta que almacena los pasivos totales en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Activos corrientes',
            'descripcion'=>'Es la cuenta que almacena los activos totales a corto plazo en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Pasivos corrientes',
            'descripcion'=>'Es la cuenta que almacena los pasivos totales a corto plazo en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Inventario',
            'descripcion'=>'Es la cuenta que almacena los inventarios totales en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Valores a corto plazo',
            'descripcion'=>'Representa la cuenta que puede ser convertida a efectivo en poco tiempo en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Efectivo',
            'descripcion'=>'Es la cuenta que almacena el efectivo total en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Costos de ventas',
            'descripcion'=>'Es la cuenta que almacena los costos de ventas en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Cuentas por cobrar',
            'descripcion'=>'Es la cuenta que almacena las cuentas por cobrar en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Compras',
            'descripcion'=>'Es la cuenta que almacena las compras en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Cuentas por pagar',
            'descripcion'=>'Es la cuenta que almacena las cuentas por pagar en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Patrimonio',
            'descripcion'=>'Es la cuenta que almacena el patrimonio total en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Gastos Financieros',
            'descripcion'=>'Es la cuenta que almacena los gastos financieros en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Ingresos',
            'descripcion'=>'Es la cuenta que almacena los ingresos en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Activos fijos',
            'descripcion'=>'Es la cuenta que almacena los activos fijos en tu empresa',
            'uso'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        //Cuentas para estado de resultado
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Gastos de operación',
            'descripcion'=>'Es la cuenta que almacena los gastos de operación en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Ventas',
            'descripcion'=>'Es la cuenta que almacena las ventas en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        /*
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Ingresos no operativos',
            'descripcion'=>'Es la cuenta que almacena los ingresos no operativos en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);*/
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Gastos no operativos',
            'descripcion'=>'Es la cuenta que almacena los gastos no operativos en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Devolución sobre ventas',
            'descripcion'=>'Es la cuenta que almacena la devolución sobre ventas en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Descuento sobre ventas',
            'descripcion'=>'Es la cuenta que almacena el descuento sobre ventas en tu empresa',
            'uso'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
