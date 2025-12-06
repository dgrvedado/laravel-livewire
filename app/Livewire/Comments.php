<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Comments extends Component
{

    public $comments = [];

    #[On('post-event')]
    public function addComment($message)
    {
        array_unshift($this->comments, $message);
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
