<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function socios_deudores_mes_actual(Request $request)
    {
        $mes = $request->input('mes');

        // Validaciones básicas
        if (!$mes) {
            return response()->json(['error' => 'Parámetros faltantes'], 400);
        }

        // Ejecutar el procedimiento almacenado
        $reporte = DB::select("CALL sp_reporte_socios_deudores_mes_actual(?)", [
            $mes,
        ]);

        return response()->json($reporte);
    }
    public function asistencia_dia(Request $request)
    {
        $fecha = $request->input('fecha');

        // Validaciones básicas
        if (!$fecha) {
            return response()->json(['error' => 'Parámetros faltantes'], 400);
        }

        // Ejecutar el procedimiento almacenado
        $reporte = DB::select("CALL sp_reporte_asistencia_dia (?)", [
            $fecha
        ]);

        return response()->json($reporte);
    }
    public function asistencia_dias(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // Validaciones básicas
        if (!$fechaInicio || !$fechaFin) {
            return response()->json(['error' => 'Parámetros faltantes'], 400);
        }

        // Ejecutar el procedimiento almacenado
        $reporte = DB::select("CALL sp_reporte_asistencia_dias(?, ?)", [
            $fechaInicio,
            $fechaFin
        ]);

        return response()->json($reporte);
    }
}
