<?php

namespace App\Http\Controllers\api;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('sesiones')->get();
        return response()->json($eventos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ubicacion' => 'required',
        ]);

        try {
            $evento = new Evento($request->all());
            $evento->save();
            return response()->json(['success' => 'Evento creado correctamente'], 201);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo guardar el evento'], 500);
        }
    }

    public function show($id)
    {
        $evento = Evento::with('sesiones')->findOrFail($id);
        return response()->json($evento);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ubicacion' => 'required',
        ]);

        try {
            $evento = Evento::findOrFail($id);
            $evento->update($request->all());
            return response()->json(['success' => 'Evento actualizado correctamente']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo actualizar el evento'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Evento::findOrFail($id)->delete();
            return response()->json(['success' => 'Evento eliminado correctamente']);
        } catch (QueryException $e) {
            return response()->json(['error' => 'No se puede eliminar el evento porque está asociado a otros registros'], 500);
        }
    }
}

