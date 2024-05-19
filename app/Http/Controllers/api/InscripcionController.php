<?php

namespace App\Http\Controllers\api;

use App\Models\Inscripcion;
use App\Models\Asistente;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with('asistente', 'sesion')->get();
        return response()->json($inscripciones);
    }

    public function store(Request $request)
    {
        $request->validate([
            'asistente_id' => 'required|exists:asistentes,id',
            'sesion_id' => 'required|exists:sesiones,id',
            'fecha_inscripcion' => 'required|date',
        ]);

        try {
            $inscripcion = new Inscripcion($request->all());
            $inscripcion->save();
            return response()->json(['success' => 'Inscripción creada correctamente'], 201);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo guardar la inscripción'], 500);
        }
    }

    public function show($id)
    {
        $inscripcion = Inscripcion::with('asistente', 'sesion')->findOrFail($id);
        return response()->json($inscripcion);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'asistente_id' => 'required|exists:asistentes,id',
            'sesion_id' => 'required|exists:sesiones,id',
            'fecha_inscripcion' => 'required|date',
        ]);

        try {
            $inscripcion = Inscripcion::findOrFail($id);
            $inscripcion->update($request->all());
            return response()->json(['success' => 'Inscripción actualizada correctamente']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo actualizar la inscripción'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Inscripcion::findOrFail($id)->delete();
            return response()->json(['success' => 'Inscripción eliminada correctamente']);
        } catch (QueryException $e) {
            return response()->json(['error' => 'No se puede eliminar la inscripción porque está asociada a otros registros'], 500);
        }
    }
}

