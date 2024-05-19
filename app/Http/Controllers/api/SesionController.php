<?php

namespace App\Http\Controllers\api;

use App\Models\Sesion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SesionController extends Controller
{
    public function index()
    {
        $sesiones = Sesion::all();
        return response()->json($sesiones);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evento_id' => 'required|exists:eventos,id',
            'titulo' => 'required',
            'descripcion' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $sesion = new Sesion($request->all());
            $sesion->save();
            return response()->json(['success' => 'Sesión creada correctamente'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo guardar la sesión'], 500);
        }
    }

    public function show($id)
    {
        $sesion = Sesion::findOrFail($id);
        return response()->json($sesion);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'evento_id' => 'required|exists:eventos,id',
            'titulo' => 'required',
            'descripcion' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $sesion = Sesion::findOrFail($id);
            $sesion->update($request->all());
            return response()->json(['success' => 'Sesión actualizada correctamente']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo actualizar la sesión'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Sesion::findOrFail($id)->delete();
            return response()->json(['success' => 'Sesión eliminada correctamente']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No se puede eliminar la sesión porque está asociada a otros registros'], 500);
        }
    }
}
