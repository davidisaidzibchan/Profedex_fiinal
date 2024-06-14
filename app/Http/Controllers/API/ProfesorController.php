<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::all();
        return response()->json($profesores);
    }

    public function show($id)
    {
        $profesor = Profesor::findOrFail($id);
        return response()->json($profesor);
    }

    public function search(Request $request)
    {
        $query = $request->query('nombre');
        $profesores = Profesor::where('nombre', 'LIKE', "%{$query}%")->get();
        return response()->json($profesores);
    }
}
