<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Desarrolladora extends Model
{
    use HasFactory;
    const MIME_IMAGEN = 'jpg';

    public function distribuidora()
    {
        return $this->belongsTo(Distribuidora::class);
    }

    public function videojuegos()
    {
        return $this->hasMany(Videojuego::class);
    }

    public function imagen(): MorphOne
    {
        return $this->morphOne(Imagen::class, 'imagenable');
    }

    private function imagen_url_relativa()
    {
        return '/uploads/desa' . $this->imagen;
    }

    private function miniatura_url_relativa()
    {
        return '/uploads/desa' . $this->miniatura;
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

    public function guardarImagen(UploadedFile $imagen, string $nombre, int $escala, ?ImageManager $manager = null, Desarrolladora $desarrolladora)
    {
        if ($manager === null) {
            $manager = new ImageManager(new Driver());
        }

        $imagen = $manager->read($imagen);
        $imagen->scaleDown($escala);
        $ruta = Storage::path('public/uploads/desa' . $nombre);
        $img = new Imagen(['url' => $ruta]);
        $desarrolladora->imagen()->save($img);
        $imagen->save($ruta);
    }
}
