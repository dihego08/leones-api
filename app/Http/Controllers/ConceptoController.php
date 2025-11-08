<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use Illuminate\Http\Request;
use App\Models\ConceptoMes;

class ConceptoController extends Controller
{
    public function index()
    {
        return response()->json(
            Concepto::with(['periodicidad', 'tipo_moneda', 'meses'])->get()
        );
    }

    public function store(Request $request)
    {
        $concepto = Concepto::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'monto' => $request->input('monto'),
            'id_periodicidad' => $request->input('id_periodicidad'),
            'estado' => $request->input('estado'),
            'id_tipo_moneda' => $request->input('id_tipo_moneda'),
        ]);

        $meses = $request->input('meses', []);
        if (!empty($meses)) {
            foreach ($meses as $mes) {
                ConceptoMes::create([
                    'id_concepto' => $concepto->id,
                    'mes' => $mes
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Concepto creado correctamente',
            'id' => $concepto->id
        ], 200);
    }

    public function editarEstado(Request $request, $id)
    {
        $concepto = Concepto::find($id);

        if (!$concepto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Concepto no encontrada o no se pudo editar'
            ], 404);
        }
        $concepto->update([
            'estado' => $request->input('estado'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Concepto actualizado correctamente',
            'id' => $id
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $concepto = Concepto::find($id);
        if (!$concepto) {
            return response()->json(['message' => 'Concepto no encontrado'], 404);
        }

        $concepto->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'monto' => $request->input('monto'),
            'id_periodicidad' => $request->input('id_periodicidad'),
            'estado' => $request->input('estado'),
            'id_tipo_moneda' => $request->input('id_tipo_moneda'),
        ]);

        // Borramos los meses anteriores
        ConceptoMes::where('id_concepto', $id)->delete();

        // Insertamos los nuevos
        $meses = $request->input('meses', []);
        if (!empty($meses)) {
            foreach ($meses as $mes) {
                ConceptoMes::create([
                    'id_concepto' => $id,
                    'mes' => $mes
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Concepto actualizado correctamente',
            'id' => $id
        ], 200);
    }

    public function destroy($id)
    {
        $concepto = Concepto::find($id);
        if (!$concepto) return response()->json(['message' => 'No encontrado'], 404);

        // Borrar meses asociados
        ConceptoMes::where('id_concepto', $id)->delete();

        $concepto->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Concepto eliminado correctamente',
            'id' => $id
        ], 200);
    }
}
