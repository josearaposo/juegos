<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($comentable, $tipo, Videojuego $videojuego)
    {
        return view('comentarios.create', [
            'comentable' => $comentable,
            'tipo' => $tipo,
            'videojuego' => $videojuego,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $comentable, $tipo, Videojuego $videojuego)
    {
        class_alias('App\Models\Videojuego', 'Videojuego');
        class_alias('App\Models\Comentario', 'Comentario');

        $comentable = $tipo::find($comentable);
        $comentable->comentarios()->create([
            'contenido' => $request->contenido,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('videojuegos.show', [
            'videojuego' => $videojuego,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "hola";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
