<?php

namespace App\Http\Controllers;

use App\Models\TipoMoneda;
use Illuminate\Http\Request;

class TipoMonedaController extends Controller
{
    public function index()
    {
        return response()->json(TipoMoneda::all());
    }

    public function show($id)
    {
        $tipo_moneda = TipoMoneda::find($id);
        if (!$tipo_moneda) {
            return response()->json(['message' => 'Tipo de moneda no encontrada'], 404);
        }
        return response()->json($tipo_moneda);
    }

    public function editarEstado(Request $request, $id)
    {
        $tipo_moneda = TipoMoneda::find($id);

        if (!$tipo_moneda) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tipo de moneda no encontrada o no se pudo editar'
            ], 404);
        }
        $tipo_moneda->update([
            'estado' => $request->input('estado'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de moneda actualizado correctamente',
            'id' => $id
        ], 200);
    }
    public function store(Request $request)
    {
        $id = TipoMoneda::create([
            'tipo_moneda' => $request->input('tipo_moneda'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de moneda creada correctamente',
            'id' => $id
        ], 200);
    }

    public function update(Request $request, $id)
    {
        TipoMoneda::where('id', $id)
            ->update([
                'tipo_moneda' => $request->input('tipo_moneda'),
            ]);
        //return response()->json(['ok' => true]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de moneda actualizada correctamente',
            'id' => $id
        ], 200);
    }

    public function destroy($id)
    {
       $tipo_moneda = TipoMoneda::find($id);

        if (!$tipo_moneda) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tipo de moneda no encontrada o no se pudo eliminar'
            ], 404);
        }

        $tipo_moneda->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de moneda eliminada correctamente'   
        ], 200);
    }
}
