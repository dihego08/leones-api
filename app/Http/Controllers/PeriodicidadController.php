<?php

namespace App\Http\Controllers;

use App\Models\Periodicidad;
use Illuminate\Http\Request;

class PeriodicidadController extends Controller
{
    public function index()
    {
        return response()->json(Periodicidad::all());
    }

    public function show($id)
    {
        $periodicidad = Periodicidad::find($id);
        if (!$periodicidad) {
            return response()->json(['message' => 'Periodicidad no encontrada'], 404);
        }
        return response()->json($periodicidad);
    }

    public function editarEstado(Request $request, $id)
    {
        $socio = Socio::find($id);

        if (!$socio) {
            return response()->json([
                'status' => 'error',
                'message' => 'Socio no encontrada o no se pudo editar'
            ], 404);
        }
        $socio->update([
            'estado' => $request->input('estado'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Socio actualizado correctamente',
            'id' => $id
        ], 200);
    }
    public function store(Request $request)
    {
        $id = Periodicidad::create([
            'periodicidad' => $request->input('periodicidad'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Periodicidad creada correctamente',
            'id' => $id
        ], 200);
    }

    public function update(Request $request, $id)
    {
        Periodicidad::where('id', $id)
            ->update([
                'periodicidad' => $request->input('periodicidad'),
            ]);
        //return response()->json(['ok' => true]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Periodicidad actualizada correctamente',
            'id' => $id
        ], 200);
    }

    public function destroy($id)
    {
       $periodicidad = Periodicidad::find($id);

        if (!$periodicidad) {
            return response()->json([
                'status' => 'error',
                'message' => 'Periodicidad no encontrada o no se pudo eliminar'
            ], 404);
        }

        $periodicidad->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Periodicidad eliminada correctamente'   
        ], 200);
    }
}
