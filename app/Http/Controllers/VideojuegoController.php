<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideojuegoRequest;
use App\Http\Requests\UpdateVideojuegoRequest;
use App\Models\Desarrolladora;
use App\Models\Distribuidora;
use App\Models\Videojuego;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideojuegoRequest $request, Videojuego $videojuego)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        //
    }
}
