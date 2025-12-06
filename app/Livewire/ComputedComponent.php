<?php

namespace App\Livewire;

use App\Models\Post;
use Attribute;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ComputedComponent extends Component
{
    public $postId;

    #[Computed()]
    public function post()
    {
        return Post::find($this->postId);
    }

    public function render()
    {
        return view('livewire.computed');
    }
}
