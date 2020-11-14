<?php

use Illuminate\Database\Seeder;

class AnalisisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('analisis')->insert([
            'individual'    => '',
            'mayor'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, presenta un exceso de recursos para el pago de sus obligaciones a corto plazo, lo que se traduce en la posesión de recursos ociosos.',
            'entre'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, tiene suficientes recursos financieros para permanecer solvente en el corto plazo.',
            'menor'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, no tiene suficientes recursos financieros para cumplir con sus obligaciones a corto plazo.',
            'parametro_id'  => 1,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '',
            'mayor'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, presenta un exceso de recursos para el pago de sus obligaciones a corto plazo, lo que se traduce en la posesión de recursos ociosos o inactivos, que deberían reinvertirse.',
            'entre'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, está experimentando un sólido crecimiento, convirtiendo rápidamente las cuentas por cobrar en efectivo y siendo capaz de pagar fácilmente sus obligaciones financieras',
            'menor'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, no tienen suficientes activos líquidos para pagar sus pasivos circulantes. En general, esta condición sugiere que la empresa tiene exceso de apalancamiento, dificultades para mantener o aumentar las ventas, paga las facturas demasiado rápido o realiza los cobros muy lentamente.',
            'parametro_id'  => 2,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '',
            'mayor'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, los fondos disponibles a corto plazo de los activos corrientes son más que suficientes para pagar los pasivos corrientes a medida que se venzan los pagos.',
            'entre'         => '',
            'menor'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, es posible que no tenga suficientes fondos disponibles para pagar sus obligaciones corrientes y que pueda estar en peligro de quiebra.',
            'parametro_id'  => 3,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '',
            'mayor'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, se dispone de $<resultado> por cada dólar que se tenga en obligaciones a corto plazo.',
            'entre'         => '',
            'menor'         => 'El resultado de <resultado> indica que <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, no dispone de suficiente efectivo para el pago de las obligaciones a corto plazo.',
            'parametro_id'  => 4,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'El inventario de <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, rotó <resultado> veces.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 5,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'El inventario de <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, cambió cada <resultado> días.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 6,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '',
            'mayor'         => 'Las cuentas por cobrar de <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, rotaron <resultado> veces. Dado que la rotación de las cuentas por cobrar es mayor a la de las cuentas por pagar, indica que la empresa posee una mala política de cobros.',
            'entre'         => '',
            'menor'         => 'Las cuentas por cobrar de <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, rotaron <resultado> veces. Dado que la rotación de las cuentas por cobrar es inferior a la de las cuentas por pagar, indica que la empresa posee una buena política de cobros.',
            'parametro_id'  => 7,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '',
            'mayor'         => '<nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, realizó sus cobros con plazos de <resultado> días. Dado que el período medio de cobranza es mayor al período medio de pago, indica que la empresa posee una mala política de cobros.',
            'entre'         => '',
            'menor'         => '<nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, realizó sus cobros con plazos de <resultado> días. Dado que el período medio de cobranza es inferior al período medio de pago, indica que la empresa posee una buena política de cobros.',
            'parametro_id'  => 8,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'Las cuentas por pagar de <nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, rotaron <resultado> veces.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 9,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '<nombre de la empresa>, perteneciente al sector <nombre del sector>, en el período de <año del período>, realizó sus pagos en plazos de <resultado> días.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 10,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'En el período de <año del período>, <nombre de la empresa> generó en venta el valor de <resultado> en relación con todos los activos de la empresa.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 11,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'En el período de <año del período>, <nombre de la empresa> generó en venta el valor de <resultado> en relación con todos los recursos puestos en operación.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 12,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'En el período de <año del período>, <nombre de la empresa>  tiene una ganancia bruta de $<resultado> por cada dolar en Ingresos.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 13,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'En el período de <año del período>, <nombre de la empresa>  tiene una utilidad operativa de $<resultado> por cada dolar en Ingresos.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 14,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '',
            'mayor'         => '<nombre de la empresa> presenta un grado de endeudamiento del <resultado>,  en el período de <año del período>, lo que puede indicar que la empresa se encuentra soportando un excesivo volumen de deuda.',
            'entre'         => '<nombre de la empresa> presenta un grado de endeudamiento del <resultado>,  en el período de <año del período>, que indica que se posee un volumen de deuda moderado.',
            'menor'         => '<nombre de la empresa> presenta un grado de endeudamiento del <resultado>, en el período de <año del período>,  lo que puede indicar que la empresa está incurriendo en un exceso de capitales ociosos y una consiguiente pérdida de rentabilidad de sus recursos.',
            'parametro_id'  => 15,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '<nombre de la empresa> financió sus actividades , en el período de <año del período>, mediante el uso del <resultado>% de recursos propios.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 16,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '<nombre de la empresa> en el período de <año del período> presentó una razón de endeudamiento patrimonial de <resultado> lo que índica que por cada dólar de patrimonio, la empresa posee una deuda de $<resultado>.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 17,
        ]);
        DB::table('analisis')->insert([
            'individual'    => '',
            'mayor'         => 'Los gastos financieros de <nombre de la empresa> durante el período de <año del período>, se ven cubiertos por sus utilidades a una razón de <resultado> a 1. Lo que indica que se tiene una buena capacidad de los pagos de intereses e impuestos.',
            'entre'         => '',
            'menor'         => 'Los gastos financieros de <nombre de la empresa> durante el período de <año del período>, se ven cubiertos por sus utilidades a una razón de <resultado> a 1. Lo que indica una deficiencia en la capacidad de pagar intereses e impuestos.',
            'parametro_id'  => 18,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'La capacidad de generar beneficio de <nombre de la empresa> en el año <año del período> fue de <resultado>',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 19,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'La rentabilidad por acción de la empresa <nombre de la empresa> perteneciente al sector <nombre del sector>, en el año <año del período> fue de <resultado>',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 20,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'La la capacidad que tienen los activos para generar beneficios de <nombre de la empresa> en el año <año del período> fue de <resultado>',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 21,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'La rentabilidad que obtiene <nombre de la empresa> por sus ventas en el período de <año del período> fue de <resultado>',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 22,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'La utilidad de <nombre de la empresa> que se obtuvo por cada dólar invertido en el período de <año del período> fue de $<resultado>',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 23,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'El análisis vertical realizado para <nombre de la empresa> , en el periodo de <año del período>, evidencia que el <activo no corriente/activo corriente> supone el <tanto%> del total de activo, superior al <activo no corriente/activo corriente>. La cuenta de Banco o Caja  supone el <tanto%> por lo que parece <no> tener problemas de liquidez. Los clientes representan un <tanto%> del activo corriente. Respecto al pasivo se puede destacar que la cuenta de <nombre_cuenta> tiene el mayor peso y que el <cuentra principal de pasico> representa el <tanto %> del pasivo.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 24,
        ]);
        DB::table('analisis')->insert([
            'individual'    => 'El análisis horizontal realizado para <nombre de la empresa> , en los periodos de <año del período1 > y <año periodo 2>, evidencia que los ingresos han <aumentado/disminuido> en $<valor absouto> con respecto al año anterior. El resultado financiero <mejoró/empeoró> al <aumentar/disminuir> el ingreso y <aumentar/reducir> el gasto. El resultado general <aumentó/disminuyó> en un <tanto%>.',
            'mayor'         => '',
            'entre'         => '',
            'menor'         => '',
            'parametro_id'  => 25,
        ]);
    }
}
