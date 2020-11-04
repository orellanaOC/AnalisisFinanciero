<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('empresa')->insert([
            'nombre'=>'O.Gar todo lo encuentras aqui',
            'nit'=>'032-310477-434',
            'nrc'=>now(),
            'sector_id'=>1,
            'user_id'=>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
