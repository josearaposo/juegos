<?php

namespace App\Livewire;

use App\Models\Desarrolladora;
use Livewire\Component;

class Busqueda extends Component
{

    public $busqueda = '';
    public function render()
    {
        return view('livewire.busqueda', [
            'desarrolladoras' => Desarrolladora::where('nombre', 'like', "%{$this->busqueda}%")->get(),
        ]);
    }
}
