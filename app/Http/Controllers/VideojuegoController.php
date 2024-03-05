<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideojuegoRequest;
use App\Http\Requests\UpdateVideojuegoRequest;
use App\Models\Desarrolladora;
use App\Models\Distribuidora;
use App\Models\Videojuego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class VideojuegoController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Videojuego::class, 'videojuego');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->query('order', 'desarrolladora');
        $order_dir = $request->query('order_dir', 'asc');


        $videojuegos = Videojuego::with(['desarrolladora'])
            ->selectRaw('videojuegos.* , desarrolladoras.nombre as desarrolladora, distribuidoras.nombre as distribuidora')
            ->leftJoin('desarrolladoras', 'videojuegos.desarrolladora_id', '=', 'desarrolladoras.id')
            ->leftJoin('distribuidoras', 'desarrolladoras.distribuidora_id', '=', 'distribuidoras.id')
            ->leftJoin('posesiones', 'posesiones.videojuego_id', '=', 'videojuegos.id')
            ->where('posesiones.user_id', '=', $request->user()->id)
            ->orderBy($order, $order_dir)
            ->orderBy('desarrolladora')
            ->paginate(3);
        return view('videojuegos.index', [
            'videojuegos' => $videojuegos,
            'order' => $order,
            'order_dir' => $order_dir,
        ]);
    }


    public function poseo()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videojuegos.create', [
            'desarrolladoras' => Desarrolladora::all(),
            'distribuidoras' => Distribuidora::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideojuegoRequest $request)
    {
        $validate = $request->validated();
        Videojuego::create($validate);
        return redirect()->route('videojuegos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {

        return view('videojuegos.show', [
            'videojuego' => $videojuego,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        return view('videojuegos.edit', [
            'videojuego' => $videojuego,
            'desarrolladoras' => Desarrolladora::all(),
            'distribuidoras' => Distribuidora::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideojuegoRequest $request, Videojuego $videojuego)
    {
        $validated = $this->validar($request);
        $videojuego->update($validated);
        return redirect()->route('videojuegos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        //
    }

        public function cambiar_imagen(Videojuego $videojuego)
    {
        return view('videojuegos.cambiar_imagen', [
            'videojuego' => $videojuego,
        ]);
    }

    public function guardar_imagen(Videojuego $videojuego, Request $request)
    {
        $mime = Videojuego::MIME_IMAGEN;

        $request->validate([
            'imagen' => "required|mimes:$mime|max:500",
        ]);

        $imagen = $request->file('imagen');
        Storage::makeDirectory('public/uploads');
        // $imagen->storeAs('uploads', $nombre, 'public');
        $imagen_original = $imagen;
        $manager = new ImageManager(new Driver());
        $videojuego->guardarImagen($imagen, $videojuego->imagen, 400, $manager, $videojuego);
        $imagen = $imagen_original;
        $videojuego->guardarImagen($imagen, $videojuego->miniatura, 200, $manager, $videojuego);
        return redirect()->route('videojuegos.index');
    }
}
