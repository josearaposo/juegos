<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesarrolladoraRequest;
use App\Models\Desarrolladora;
use App\Models\Distribuidora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
class DesarrolladoraController extends Controller
{
    public function index(Request $request)
    {
        /* $desarrolladoras = DB::table('desarrolladoras')->orderBy('nombre'); */
        return view('desarrolladoras.index', [
            'desarrolladoras' => Desarrolladora::all(),
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
        return view('desarrolladoras.create', [
            'distribuidoras' => Distribuidora::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesarrolladoraRequest $request)
    {
        $validate = $request->validated();
        Desarrolladora::create($validate);
        return redirect()->route('desarrolladoras.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Desarrolladora $desarrolladora)
    {
        return view('desarrolladoras.show', [
            'desarrolladora' => $desarrolladora,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Desarrolladora $desarrolladora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesarrolladoraRequest $request, Desarrolladora $desarrolladora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desarrolladora $desarrolladora)
    {
        //
    }

        public function cambiar_imagen(Desarrolladora $desarrolladora)
    {
        return view('desarrolladoras.cambiar_imagen', [
            'desarrolladora' => $desarrolladora,
        ]);
    }

    public function guardar_imagen(Desarrolladora $desarrolladora, Request $request)
    {
        $mime = Desarrolladora::MIME_IMAGEN;

        $request->validate([
            'imagen' => "required|mimes:$mime|max:500",
        ]);

        $imagen = $request->file('imagen');
        Storage::makeDirectory('public/uploads');
        // $imagen->storeAs('uploads', $nombre, 'public');
        $imagen_original = $imagen;
        $manager = new ImageManager(new Driver());
        $desarrolladora->guardarImagen($imagen, $desarrolladora->imagen, 400, $manager, $desarrolladora);
       $imagen = $imagen_original;
        $desarrolladora->guardarImagen($imagen, $desarrolladora->miniatura, 200, $manager, $desarrolladora);
        return redirect()->route('desarrolladoras.index');
    }
}

