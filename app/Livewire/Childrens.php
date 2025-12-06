<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Childrens extends Component
{
    #[Modelable]
    public $name;

    public function render()
    {
        return view('livewire.childrens');
    }
}
