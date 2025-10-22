<?php

namespace App\Http\Controllers;

use App\Models\EstadoPago;
use Illuminate\Http\Request;

class EstadoPagoController extends Controller
{
    public function index()
    {
        return response()->json(EstadoPago::all());
    }

    public function store(Request $request)
    {
        $estadoPago = EstadoPago::create($request->all());
        return response()->json($estadoPago, 201);
    }

    public function update(Request $request, $id)
    {
        $estadoPago = EstadoPago::find($id);
        if (!$estadoPago) return response()->json(['message' => 'No encontrado'], 404);

        $estadoPago->update($request->all());
        return response()->json($estadoPago);
    }

    public function destroy($id)
    {
        $estadoPago = EstadoPago::find($id);

        if (!$estadoPago) {
            return response()->json([
                'status' => 'error',
                'message' => 'Estado de pago no encontrada o no se pudo eliminar'
            ], 404);
        }

        $estadoPago->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Estado de pago eliminado correctamente'   
        ], 200);
    }
}
