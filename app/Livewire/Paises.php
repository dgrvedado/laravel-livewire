<?php

namespace App\Livewire;

use Livewire\Component;

class Paises extends Component
{

    public $open = true;

    public $paises = [
        'Argentina',
        'Brasil',
        'Chile',
        'Colombia',
        'Uruguay',
        'Paraguay',
        'Peru',
        'Venezuela',
        'Ecuador',
        'Bolivia',
    ];

    public $pais;
    public $active;
    public $count = 0;

    public function save()
    {
        array_push($this->paises, $this->pais);
        //Se puede vaciar el campo despues de guardar de dos formas
        //Con el parametro que se pasa a la funcion vacio
        //$this->pais = '';
        //O usando la propiedad reset
        //Se peuden resetar varias propiedades a la vez pasando un array
        //ej: ['prop1', 'prop2',...]
        $this->reset('pais');

    }

    public function delete($index)
    {
        unset($this->paises[$index]);
        //Reindexa el array para que no queden huecos en los indices
        $this->paises = array_values($this->paises);
    }

    public function chageActive($pais)
    {
        $this->active = $pais;
    }

    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.paises');
    }
}
