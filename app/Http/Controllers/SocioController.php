<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use Illuminate\Http\Request;

class SocioController extends Controller
{
    public function index()
    {
        return response()->json(Socio::all());
    }

    public function show($id)
    {
        $socio = Socio::with('pagos.concepto')->find($id);
        if (!$socio) {
            return response()->json(['message' => 'Socio no encontrado'], 404);
        }
        return response()->json($socio);
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
        $id = Socio::create([
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'dni' => $request->input('dni'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'estado' => $request->input('estado'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Socio creado correctamente',
            'id' => $id
        ], 200);
    }

    public function update(Request $request, $id)
    {
        Socio::where('id', $id)
            ->update([
                'nombres' => $request->input('nombres'),
                'apellidos' => $request->input('apellidos'),
                'dni' => $request->input('dni'),
                'telefono' => $request->input('telefono'),
                'direccion' => $request->input('direccion'),
                'estado' => $request->input('estado'),
            ]);
        //return response()->json(['ok' => true]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Socio actualizada correctamente',
            'id' => $id
        ], 200);
    }

    public function destroy($id)
    {
        $socio = Socio::find($id);

        if (!$socio) {
            return response()->json([
                'status' => 'error',
                'message' => 'Socio no encontrada o no se pudo eliminar'
            ], 404);
        }

        $socio->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Socio eliminado correctamente'   
        ], 200);
    }
}
