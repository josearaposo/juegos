<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Imagen extends Model
{
    use HasFactory;

    protected $fillable = [
        'url', // Agrega 'url' a la lista de atributos fillable
        // Otros atributos que puedas tener aquí...
    ];

    public function imagenable(): MorphTo
    {
        return $this->morphTo();
    }

}
