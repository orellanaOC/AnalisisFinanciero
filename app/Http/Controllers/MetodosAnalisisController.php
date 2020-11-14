<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Analisis;
use App\Parametro;

class MetodosAnalisisController extends Controller
{

/*------------------------------ FUNCIÓN QUE DEVUELVE TODOS LOS ANALISIS -----------------------------------*/

public function get_analisis($ratios, $empresa, $sector, $year){
    $analisis = [];
    array_push($analisis, $this->tres_casos($ratios[0], $empresa, $sector, $year));
    array_push($analisis, $this->tres_casos($ratios[1], $empresa, $sector, $year));
    array_push($analisis, $this->dos_casos($ratios[2], $empresa, $sector, $year));
    array_push($analisis, $this->dos_casos($ratios[3], $empresa, $sector, $year));
    array_push($analisis, $this->especial($ratios[4], $ratios[6], $empresa, $sector, $year));
    array_push($analisis, $this->especial($ratios[5], $ratios[7], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[6], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[7], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[8], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[9], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[10], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[11], $empresa, $sector, $year));
    array_push($analisis, $this->tres_casos($ratios[12], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[13], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[14], $empresa, $sector, $year));
    array_push($analisis, $this->dos_casos($ratios[15], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[16], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[17], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[18], $empresa, $sector, $year));
    array_push($analisis, $this->un_caso($ratios[19], $empresa, $sector, $year));

    return $analisis;
}

/*----------------------------------------------------------------------------------------------------------*/

/*------------------- FUNCIÓN QUE DEVUELVE EL ANALISIS DE LOS QUE TIENEN TRES CASOS ------------------------*/

public function tres_casos($ratio, $empresa, $sector, $year){
    $analisis = Analisis::where('parametro_id', $ratio->parametro_id)->first();
    $parametro = Parametro::findOrFail($ratio->parametro_id);
    if($ratio->double < $parametro->min){
        $analisis = $analisis->menor;
    }
    elseif ($ratio->double > $parametro->max) {
        $analisis = $analisis->mayor;
    } 
    else{
        $analisis = $analisis->entre;
    }


    $analisis = str_replace("<nombre de la empresa>", $empresa, $analisis);
    $analisis = str_replace("<nombre del sector>", $sector, $analisis);
    $analisis = str_replace("<año del período>", $year, $analisis);
    $analisis = str_replace("<resultado>", $ratio->double, $analisis);

    return $analisis;
}

/*----------------------------------------------------------------------------------------------------------*/

/*------------------- FUNCIÓN QUE DEVUELVE EL ANALISIS DE LOS QUE TIENEN DOS CASOS -------------------------*/

public function dos_casos($ratio, $empresa, $sector, $year){
    $analisis = Analisis::where('parametro_id', $ratio->parametro_id)->first();
    $parametro = Parametro::findOrFail($ratio->parametro_id);
    if($ratio->double < $parametro->valor){
        $analisis = $analisis->menor;
    }
    else{
        $analisis = $analisis->mayor;
    }

    $analisis = str_replace("<nombre de la empresa>", $empresa, $analisis);
    $analisis = str_replace("<nombre del sector>", $sector, $analisis);
    $analisis = str_replace("<año del período>", $year, $analisis);
    $analisis = str_replace("<resultado>", $ratio->double, $analisis);

    return $analisis;
}

/*----------------------------------------------------------------------------------------------------------*/

/*------------------- FUNCIÓN QUE DEVUELVE EL ANALISIS DE LOS QUE TIENEN UN CASO -------------------------*/

public function un_caso($ratio, $empresa, $sector, $year){
    $analisis = (Analisis::where('parametro_id', $ratio->parametro_id)->first())->individual;
    $parametro = Parametro::findOrFail($ratio->parametro_id);

    $analisis = str_replace("<nombre de la empresa>", $empresa, $analisis);
    $analisis = str_replace("<nombre del sector>", $sector, $analisis);
    $analisis = str_replace("<año del período>", $year, $analisis);
    $analisis = str_replace("<resultado>", $ratio->double, $analisis);

    return $analisis;
}

/*----------------------------------------------------------------------------------------------------------*/

/*---------------------- FUNCIÓN QUE DEVUELVE EL ANALISIS DE LOS CASOS ESPECIALES --------------------------*/

public function especial($ratio1, $ratio2,  $empresa, $sector, $year){
    $analisis = Analisis::where('parametro_id', $ratio1->parametro_id)->first();
    $parametro = Parametro::findOrFail($ratio1->parametro_id);
    if($ratio1->double < $ratio2->double){
        $analisis = $analisis->menor;
    }
    else{
        $analisis = $analisis->mayor;
    }

    $analisis = str_replace("<nombre de la empresa>", $empresa, $analisis);
    $analisis = str_replace("<nombre del sector>", $sector, $analisis);
    $analisis = str_replace("<año del período>", $year, $analisis);
    $analisis = str_replace("<resultado>", $ratio1->double, $analisis);

    return $analisis;
}

/*----------------------------------------------------------------------------------------------------------*/

}
