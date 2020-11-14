<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Periodo;
use App\Sector;
use App\Razon;
use DB;
use Auth;

class MetodosRatioController extends Controller
{
/*----------------------------------- FUNCIÓN QUE CALCULA EL RDC ---------------------------------------------*/

    public function calcular_rdc($periodo, $empresa, $sector){
        $activos_corrientes = $this->get_total($periodo->id, 3);
        $pasivos_corrientes = $this->get_total($periodo->id, 4);

        $rdc = 0;
        if($pasivos_corrientes != 0){
            $rdc = $activos_corrientes/$pasivos_corrientes;
        }

        return $rdc;
    }

/*------------------------------------------------------------------------------------------------------------*/

/*----------------------------------- FUNCIÓN QUE CALCULA EL PA ----------------------------------------------*/

    public function calcular_pa($periodo, $empresa, $sector){
        $activos_corrientes = $this->get_total($periodo->id, 3);
        $pasivos_corrientes = $this->get_total($periodo->id, 4);
        $inventario = $this->get_total($periodo->id, 5);

        $pa = 0;
        if($pasivos_corrientes != 0){
            $pa = ($activos_corrientes-$inventario)/$pasivos_corrientes;
        }

        return $pa;
    }

/*-------------------------------------------------------------------------------------------------------------*/

/*----------------------------------- FUNCIÓN QUE CALCULA EL RCT ----------------------------------------------*/

public function calcular_rct($periodo, $empresa, $sector){
    $activos_corrientes = $this->get_total($periodo->id, 3);
    $pasivos_corrientes = $this->get_total($periodo->id, 4);
    $activos = $this->get_total($periodo->id, 1);

    $rct = null;
    if($activos != 0){
        $rct = ($activos_corrientes-$pasivos_corrientes)/$activos;
    }

    return $rct;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*----------------------------------- FUNCIÓN QUE CALCULA EL RDE ----------------------------------------------*/

public function calcular_rde($periodo, $empresa, $sector){
    $efectivo = $this->get_total($periodo->id, 7);
    $pasivos_corrientes = $this->get_total($periodo->id, 4);
    $valores_corto_plazo = $this->get_total($periodo->id, 6);

    $rde = null;
    if($pasivos_corrientes != 0){
        $rde = ($efectivo + $valores_corto_plazo)/$pasivos_corrientes;
    }

    return $rde;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RRI -----------------------------------------*/

public function calcular_rri($periodo, $empresa, $sector){   
    $inventario_promedio = $this->get_promedio($periodo, $empresa, 5);

    $costo_ventas = $this->select_from_er("costo_ventas", $periodo);

    $razon_rotacion_inventario = null;
    if($inventario_promedio != 0){
        $razon_rotacion_inventario = number_format($costo_ventas/$inventario_promedio, 2);
    }

    $analisis = DB::select("SELECT * FROM analisis WHERE parametro_id = 5")[0]->individual;
    $analisis = str_replace("<nombre de la empresa>", $empresa->nombre, $analisis);
    $analisis = str_replace("<nombre del sector>", $sector, $analisis);
    $analisis = str_replace("<año del período>", $periodo->year, $analisis);
    $analisis = str_replace("<resultado>", $razon_rotacion_inventario, $analisis);

    return [$razon_rotacion_inventario, $analisis];
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RDI -----------------------------------------*/

public function calcular_rdi($periodo, $empresa, $sector){
    $inventario_promedio = $this->get_promedio($periodo, $empresa, 5);
    $costo_ventas = $this->select_from_er("costo_ventas", $periodo);

    $razon_dias_inventario = null;
    if($costo_ventas != 0){
        $razon_dias_inventario = number_format($inventario_promedio/($costo_ventas/365));
    }

    $analisis = DB::select("SELECT * FROM analisis WHERE parametro_id = 6")[0]->individual;
    $analisis = str_replace("<nombre de la empresa>", $empresa->nombre, $analisis);
    $analisis = str_replace("<nombre del sector>", $sector, $analisis);
    $analisis = str_replace("<año del período>", $periodo->year, $analisis);
    $analisis = str_replace("<resultado>", $razon_dias_inventario, $analisis);

    return [$razon_dias_inventario, $analisis];
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RRCC ----------------------------------------*/

public function calcular_rrcc($periodo, $empresa, $sector){
    $promedio_cuentas_cobrar = $this->get_promedio($periodo, $empresa, 9);
    $ventas_netas = $this->select_from_er("ventas_netas", $periodo);

    $rrcc = null;
    if($promedio_cuentas_cobrar != 0){
        $rrcc = $ventas_netas/$promedio_cuentas_cobrar;
    }

    return $rrcc;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RPMC ----------------------------------------*/

public function calcular_rpmc($periodo, $empresa, $sector){
    $promedio_cuentas_cobrar = $this->get_promedio($periodo, $empresa, 9);
    $ventas_netas = $this->select_from_er("ventas_netas", $periodo);

    $rpmc = null;
    if($ventas_netas != 0){
        $rpmc = ($promedio_cuentas_cobrar * 365)/$ventas_netas;
    }

    return $rpmc;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RRCP ----------------------------------------*/

public function calcular_rrcp($periodo, $empresa, $sector){
    $promedio_cuentas_pagar = $this->get_promedio($periodo, $empresa, 11);
    $compras = $this->get_promedio($periodo, $empresa, 10);

    $rrcp = null;
    if($promedio_cuentas_pagar != 0){
        $rrcp = $compras/$promedio_cuentas_pagar;
    }

    return $rrcp;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RPMP ----------------------------------------*/

public function calcular_rpmp($periodo, $empresa, $sector){
    $promedio_cuentas_pagar = $this->get_promedio($periodo, $empresa, 11);
    $compras = $this->get_promedio($periodo, $empresa, 10);

    $rpmp = null;
    if($compras != 0){
        $rpmp = ($promedio_cuentas_pagar*365)/$compras;
    }

    return $rpmp;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL IRAT ----------------------------------------*/

public function calcular_irat($periodo, $empresa, $sector){
    $promedio_activo_total = $this->get_promedio($periodo, $empresa, 1);
    $ventas_netas = $this->select_from_er("ventas_netas", $periodo);

    $irat = null;
    if($promedio_activo_total != 0){
        $irat = $ventas_netas/$promedio_activo_total;
    }

    return $irat;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL IRAF ----------------------------------------*/

public function calcular_iraf($periodo, $empresa, $sector){
    $promedio_activo_fijo = $this->get_promedio($periodo, $empresa, 15);
    $ventas_netas = $this->select_from_er("ventas_netas", $periodo);

    $iraf = null;
    if($promedio_activo_fijo != 0){
        $iraf = $ventas_netas/$promedio_activo_fijo;
    }

    return $iraf;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL IMB ----------------------------------------*/

public function calcular_imb($periodo, $empresa, $sector){
    $ventas = $this->select_from_er("ventas", $periodo);
    $utilidad_bruta = $this->select_from_er("utilidad_bruta", $periodo);

    $imb = null;
    if($ventas != 0){
        $imb = $utilidad_bruta/$ventas;
    }

    return $imb;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL IMO ----------------------------------------*/

public function calcular_imo($periodo, $empresa, $sector){
    $ventas = $this->select_from_er("ventas", $periodo);
    $utilidad_operativa = $this->select_from_er("utilidad_operativa", $periodo);

    $imo = null;
    if($ventas != 0){
        $imo = $utilidad_operativa/$ventas;
    }

    return $imo;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL GE ------------------------------------------*/

public function calcular_ge($periodo, $empresa, $sector){
    $pasivo = $this->get_total($periodo->id, 2);
    $activo = $this->get_total($periodo->id, 1);

    $ge = null;
    if($activo != 0){
        $ge = $pasivo/$activo;
    }

    return $ge;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL GP ------------------------------------------*/

public function calcular_gp($periodo, $empresa, $sector){
    $patrimonio = $this->get_total($periodo->id, 12);
    $activo = $this->get_total($periodo->id, 1);

    $gp = null;
    if($activo != 0){
        $gp = $patrimonio/$activo;
    }

    return $gp;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL REP ------------------------------------------*/

public function calcular_rep($periodo, $empresa, $sector){
    $pasivo = $this->get_total($periodo->id, 2);
    $patrimonio = $this->get_total($periodo->id, 12);

    $rep = null;
    if($patrimonio != 0){
        $rep = $pasivo/$patrimonio;
    }

    return $rep;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RCGF ------------------------------------------*/

public function calcular_rcgf($periodo, $empresa, $sector){
    $utilidad_antes_de_i = $this->select_from_er("utilidad_antes_de_i", $periodo);
    $gastos_financieros = $periodo->gastos_financieros;

    $rcgf = null;
    if($gastos_financieros != 0){
        $rcgf = $utilidad_antes_de_i/$gastos_financieros;
    }

    return $rcgf;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL ROE ------------------------------------------*/

public function calcular_roe($periodo, $empresa, $sector){
    $utilidad_neta = $this->select_from_er("utilidad_neta", $periodo);
    $patrimonio_promedio = $this->get_promedio($periodo, $empresa, 12);

    $roe = null;
    if($patrimonio_promedio != 0){
        $roe = $utilidad_neta/$patrimonio_promedio;
    }

    return $roe;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RPA -----------------------------------------*/

public function calcular_rpa($periodo, $empresa, $sector){
    $utilidad_neta = $this->select_from_er("utilidad_neta", $periodo);
    $numero_acciones = $periodo->acciones;
    
    $rpa = null;
    if($numero_acciones != 0){
        $rpa = number_format($utilidad_neta/$numero_acciones, 2);
    }

    $analisis = DB::select("SELECT * FROM analisis WHERE parametro_id = 20")[0]->individual;
    $analisis = str_replace("<nombre de la empresa>", $empresa->nombre, $analisis);
    $analisis = str_replace("<nombre del sector>", $sector, $analisis);
    $analisis = str_replace("<año del período>", $periodo->year, $analisis);
    $analisis = str_replace("<resultado>", $rpa, $analisis);

    return [$rpa, $analisis];
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL ROA ------------------------------------------*/

public function calcular_roa($periodo, $empresa, $sector){
    $utilidad_neta = $this->select_from_er("utilidad_neta", $periodo);
    $activo = $this->get_total($periodo->id, 1);

    $roa = null;
    if($activo != 0){
        $roa = $utilidad_neta/$activo;
    }

    return $roa;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RSV ------------------------------------------*/

public function calcular_rsv($periodo, $empresa, $sector){
    $utilidad_neta = $this->select_from_er("utilidad_neta", $periodo);
    $ventas = $this->select_from_er("ventas", $periodo);

    $rsv = null;
    if($ventas != 0){
        $rsv = $utilidad_neta/$ventas;
    }

    return $rsv;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------- FUNCIÓN PARA CALCULAR EL RSI ------------------------------------------*/

public function calcular_rsi($periodo, $empresa, $sector){
    $ingresos = $this->select_from_er("ventas", $periodo);
    $inversion = $periodo->inversion_inicial;

    $rsi = null;
    if($inversion != 0){
        $rsi = ($ingresos-$inversion)/$inversion;
    }

    return $rsi;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*----------------------------- FUNCIÓN PARA OBTENER EL MONTO DE UNA CUENTA -----------------------------------*/

public function get_total($periodo, $cuenta){
    $resultado = DB::select(
        "SELECT CP.total AS total FROM cuenta_sistema CS 
        JOIN vinculacion_cuenta VC ON CS.id = VC.id_cuenta_sistema 
        JOIN cuenta C ON c.id = VC.id_cuenta 
        JOIN cuenta_periodo CP ON C.id = CP.cuenta_id 
        WHERE CP.periodo_id = ? AND CS.id = ?", 
        [$periodo, $cuenta]
    );
    if(count($resultado)>0){
        return $resultado[0]->total;
    }
    return null;
}

/*-------------------------------------------------------------------------------------------------------------*/

/*----------------------------- FUNCIÓN PARA OBTENER EL INVENTARIO PROMEDIO -----------------------------------*/

public function get_promedio($periodo, $empresa, $cuenta){
    $periodos_anteriores = DB::Select(
        "SELECT * FROM periodo WHERE empresa_id = ? AND id < ? ORDER BY id DESC",
        [$empresa->id, $periodo->id]
    );
    $periodo_anterior = $periodo;
    if(count($periodos_anteriores) > 0){
        $periodo_anterior = $periodos_anteriores[0];
    }
    
    $inventario = $this->get_total($periodo->id, $cuenta);
    $inventario_anterior = $this->get_total($periodo_anterior->id, $cuenta);
    if($inventario_anterior == null){
        $inventario_anterior = $inventario;
    }

    return ($inventario + $inventario_anterior)/2;
}
/*-------------------------------------------------------------------------------------------------------------*/

/*---------------------- FUNCIÓN PARA OBTENER UN VALOR DEL ESTADO DE RESULTADOS -------------------------------*/

public function select_from_er($columna, $periodo){
    $resultado = DB::select(
        "SELECT " . $columna . " AS total FROM estado_resultado WHERE periodo_id = " . $periodo->id
    );

    if(count($resultado)>0){
        return $resultado[0]->total;
    }

    return 0;
}
/*-------------------------------------------------------------------------------------------------------------*/
}
