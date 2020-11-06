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
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Activos',
            'descripcion'=>'Es la cuenta que almacena los activos totales en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Pasivos',
            'descripcion'=>'Es la cuenta que almacena los pasivos totales en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Activos corrientes',
            'descripcion'=>'Es la cuenta que almacena los activos totales a corto plazo en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Pasivos corrientes',
            'descripcion'=>'Es la cuenta que almacena los pasivos totales a corto plazo en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Inventarios',
            'descripcion'=>'Es la cuenta que almacena los inventarios totales en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Valores a corto plazo',
            'descripcion'=>'Representa la cuenta que puede ser convertida a efectivo en poco tiempo en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Efectivo',
            'descripcion'=>'Es la cuenta que almacena el efectivo total en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Costos de ventas',
            'descripcion'=>'Es la cuenta que almacena los costos de ventas en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Ventas',
            'descripcion'=>'Es la cuenta que almacena las ventas en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Cuentas por cobrar comerciales',
            'descripcion'=>'Es la cuenta que almacena las cuentas por cobrar comerciales en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Compras',
            'descripcion'=>'Es la cuenta que almacena las compras en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cuenta_sistema')->insert([
            'nombre'=>'Cuentas por pagar comerciales',
            'descripcion'=>'Es la cuenta que almacena las cuentas por pagar comerciales en tu empresa',
            'created_at' => now(),
            'updated_at' => now()
        ]);        
    }
}
