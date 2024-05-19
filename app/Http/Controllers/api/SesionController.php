<?php

namespace App\Http\Controllers\api;

use App\Models\Sesion;
use App\Models\Evento;
use App\Models\Ponente;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

class SesionController extends Controller
{
    public function index()
    {
        $sesiones = Sesion::with('evento', 'ponente')->get();
        return response()->json($sesiones);
    }

    public function create()
    {
        $eventos = Evento::all();
        $ponentes = Ponente::all();
        return response()->json(['eventos' => $eventos, 'ponentes' => $ponentes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'ponente_id' => 'nullable|exists:ponentes,id',
            'titulo' => 'required',
            'descripcion' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        try {
            $sesion = new Sesion($request->all());
            $sesion->save();
            return response()->json(['success' => 'Sesión creada correctamente'], 201);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo guardar la sesión'], 500);
        }
    }

    public function show($id)
    {
        $sesion = Sesion::with('evento', 'ponente')->findOrFail($id);
        return response()->json($sesion);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'ponente_id' => 'nullable|exists:ponentes,id',
            'titulo' => 'required',
            'descripcion' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        try {
            $sesion = Sesion::findOrFail($id);
            $sesion->update($request->all());
            return response()->json(['success' => 'Sesión actualizada correctamente']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo actualizar la sesión'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Sesion::findOrFail($id)->delete();
            return response()->json(['success' => 'Sesión eliminada correctamente']);
        } catch (QueryException $e) {
            return response()->json(['error' => 'No se puede eliminar la sesión porque está asociada a otros registros'], 500);
        }
    }
}
