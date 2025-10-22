<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        return response()->json(Pago::with(['socio', 'concepto', 'estadoPago'])->get());
    }

    public function store(Request $request)
    {
        $id = Pago::create([
            'id_socio' => $request->input('id_socio'),
            'id_concepto' => $request->input('id_concepto'),
            'id_estado_pago' => $request->input('id_estado_pago'),
            'monto' => $request->input('monto'),
            'fecha_pago' => $request->input('fecha_pago'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Pago creado correctamente',
            'id' => $id
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $pago = Pago::find($id);
        if (!$pago) return response()->json(['message' => 'No encontrado'], 404);

        $pago->update($request->all());
        return response()->json($pago);
    }

    public function destroy($id)
    {
        $pago = Pago::find($id);

        if (!$pago) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pago no encontrada o no se pudo eliminar'
            ], 404);
        }

        $pago->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pago eliminado correctamente'   
        ], 200);
    }
}
