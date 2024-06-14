<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Consejo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsejoController extends Controller
{
    public function index()
    {
        $consejos = Consejo::with('profesor')->get();
        return response()->json($consejos);
    }

    public function show($id)
    {
        $consejo = Consejo::with('profesor')->findOrFail($id);
        return response()->json($consejo);
    }

    public function search(Request $request)
    {
        $query = $request->query('titulo');
        $consejos = Consejo::where('titulo', 'LIKE', "%{$query}%")->get();
        return response()->json($consejos);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'consejo' => 'required|string',
            'semestre' => 'required',
            'id_usuario'=> 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Crear el nuevo consejo
        $consejo = new Consejo();
        $consejo->titulo = $request->titulo;
        $consejo->consejo = $request->consejo;
        $consejo->semestre= $request->semestre;
        $consejo->id_usuario= $request->id_usuario;
        $consejo->save();

        return response()->json(['message' => 'Consejo creado exitosamente', 'consejo' => $consejo], 201);
    }
}
