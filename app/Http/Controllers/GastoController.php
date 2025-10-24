<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GastoController extends Controller
{
    public function index()
    {
        return response()->json(Gasto::with(['socio'])->get());
    }

    public function store(Request $request)
    {
        $id = Gasto::create([
            'id_socio' => $request->input('id_socio'),
            'concepto' => $request->input('concepto'),
            'monto' => $request->input('monto'),
            'fecha' => $request->input('fecha'),
            'fecha_creacion' => Carbon::now()
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Gasto creado correctamente',
            'id' => $id
        ], 200);
    }

    public function update(Request $request, $id)
    {
        Gasto::where('id', $id)
            ->update([
                'id_socio' => $request->input('id_socio'),
                'concepto' => $request->input('concepto'),
                'monto' => $request->input('monto'),
                'fecha' => $request->input('fecha'),
                'fecha_modificacion' => Carbon::now()
            ]);        
        return response()->json([
            'status' => 'success',
            'message' => 'Gasto actualizado correctamente',
            'id' => $id
        ], 200);
    }

    public function destroy($id)
    {
        $gasto = Gasto::find($id);

        if (!$gasto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gasto no encontrada o no se pudo eliminar'
            ], 404);
        }

        $gasto->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Gasto eliminado correctamente'   
        ], 200);
    }
}
