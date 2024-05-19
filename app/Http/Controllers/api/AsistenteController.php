<?php

namespace App\Http\Controllers\api;

use App\Models\Asistente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AsistenteController extends Controller
{
    public function index()
    {
        $asistentes = Asistente::all();
        return response()->json($asistentes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'tipo' => 'required|in:estudiante,profesor,profesional',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $asistente = new Asistente($request->all());
            $asistente->save();
            return response()->json(['success' => 'Asistente creado correctamente'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo guardar el asistente'], 500);
        }
    }

    public function show($id)
    {
        $asistente = Asistente::findOrFail($id);
        return response()->json($asistente);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'tipo' => 'required|in:estudiante,profesor,profesional',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $asistente = Asistente::findOrFail($id);
            $asistente->update($request->all());
            return response()->json(['success' => 'Asistente actualizado correctamente']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo actualizar el asistente'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Asistente::findOrFail($id)->delete();
            return response()->json(['success' => 'Asistente eliminado correctamente']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No se puede eliminar el asistente porque está asociado a otros registros'], 500);
        }
    }
}
