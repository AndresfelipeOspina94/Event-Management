<?php

namespace App\Http\Controllers\api;

use App\Models\Ponente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PonenteController extends Controller
{
    public function index()
    {
        $ponentes = Ponente::all();
        return response()->json($ponentes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'perfil_profesional' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $ponente = new Ponente($request->all());
            $ponente->save();
            return response()->json(['success' => 'Ponente creado correctamente'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo guardar el ponente'], 500);
        }
    }

    public function show($id)
    {
        $ponente = Ponente::findOrFail($id);
        return response()->json($ponente);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'perfil_profesional' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $ponente = Ponente::findOrFail($id);
            $ponente->update($request->all());
            return response()->json(['success' => 'Ponente actualizado correctamente']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo actualizar el ponente'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Ponente::findOrFail($id)->delete();
            return response()->json(['success' => 'Ponente eliminado correctamente']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No se puede eliminar el ponente porque está asociado a otros registros'], 500);
        }
    }
}
