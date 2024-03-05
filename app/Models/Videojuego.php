<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Videojuego extends Model
{
    use HasFactory;
    const MIME_IMAGEN = 'jpg';

    protected $fillable = [
        'titulo',
        'anyo' ,
        'desarrolladora_id',
    ];

    public function desarrolladora()
    {
        return $this->belongsTo(Desarrolladora::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'posesiones');
    }

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }

    public function imagen(): MorphOne
    {
        return $this->morphOne(Imagen::class, 'imagenable');
    }

    public function getImagenAttribute()
    {
        return $this->id . '.' . self::MIME_IMAGEN;
    }

    public function getMiniaturaAttribute()
    {
        return $this->id . '_mini.' . self::MIME_IMAGEN;
    }

    public function getImagenUrlAttribute()
    {
        return Storage::url(mb_substr($this->imagen_url_relativa(), 1));
    }

    public function getMiniaturaUrlAttribute()
    {
        return Storage::url(mb_substr($this->miniatura_url_relativa(), 1));
    }

    public function existeImagen()
    {
        return Storage::disk('public')->exists($this->imagen_url_relativa());
    }

    public function existeMiniatura()
    {
        return Storage::disk('public')->exists($this->miniatura_url_relativa());
    }

    public function guardarImagen(UploadedFile $imagen, string $nombre, int $escala, ?ImageManager $manager = null, Videojuego $videojuego)
    {
        if ($manager === null) {
            $manager = new ImageManager(new Driver());
        }

        $imagen = $manager->read($imagen);
        $imagen->scaleDown($escala);
        $ruta = Storage::path('public/uploads/' . $nombre);
        $img = new Imagen(['url' => $ruta]);
        $videojuego->imagen()->save($img);
        $imagen->save($ruta);
    }

    public function mostrar_comentarios(Comentario $comentario = null, $contador = 1)
    {
        if ($comentario == null)
        {
            $comentarios = $this->comentarios;
        }
        else
        {
            $comentarios = $comentario->comentarios;
        }
        //dd($comentarios);
        if (count($comentarios) > 0)
        {
            foreach ($comentarios as $comentario)
            {
                if ($comentario->comentable_type == Videojuego::class) {
                    $contador=1;
                }
                echo '<section class="bg-white dark:bg-gray-900 my-10" style="margin-left:'.$contador.'em;">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">

                    <div class="w-full text-orange-600">
                        <a href="#">
                            ' . $comentario->id.' ' . $comentario->user_id . '
                        </a>
                        <span class="text-gray-700">'.$comentario->created_at->format("d/m H:i").'</span>
                    </div>
                    </div>
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full">
                            '. $comentario->contenido.'
                        </div>
                    </div>
                    <button type="button"
                        class="px-4 py-2 text-sm font-medium text-orange-600 bg-white border border-gray-200 rounded-t-lg md:rounded-tr-none md:rounded-l-lg hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-2 focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-primary-500 dark:focus:text-white">
                 <a href="'.  route("hacer_comentario", ["comentable" => $comentario, 'tipo' => 'Comentario', 'videojuego' => $this]) .'">
                    Hacer comentarios
                </a>
                </button>

                </section>';

                if (count($comentario->comentarios) > 0){
                    $this->mostrar_comentarios($comentario, $contador+=3);
                    $contador-=3;
                }

            }
        }
        else
        {
            $contador-=3;
        }
    }

}

