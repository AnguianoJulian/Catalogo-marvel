<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }
        return response()->json($movie);
    }

    public function store(Request $request)
    {
        $data = $request->only(['title','synopsis','year','cover']);
        $movie = Movie::create($data);
        return response()->json($movie, 201);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }
        $movie->update($request->only(['title','synopsis','year','cover']));
        return response()->json($movie);
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }
        $movie->delete();
        return response()->json(['message' => 'Película eliminada correctamente']);
    }
}
