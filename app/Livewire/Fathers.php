<?php

namespace App\Livewire;

use Livewire\Component;

class Fathers extends Component
{
    public $name = 'Walter II';

    public function redirigir()
    {
        return $this->redirect('/prueba', navigate: true);
    }

    public function render()
    {
        return view('livewire.fathers');
    }
}
