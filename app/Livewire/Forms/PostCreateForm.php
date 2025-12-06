<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostCreateForm extends Form
{
    #[Rule('required|min:5')]
    public $title;

    #[Rule('required')]
    public $content;

    #[Rule('required|exists:categories,id')]
    public $category_id = '';

    #[Rule('required|array')]
    public $tags = [];

    public $imageKey;

    #[Rule('required|image|max:2048')]
    public $image;

    public function save()
    {
        $this->validate();

        $post = auth()->user()->post()->create(
            $this->only('category_id', 'title', 'content')
        );

        $post->tags()->sync($this->tags);

        if ($this->image) {
            $post->image_path = $this->image->store('posts');
            $post->save();
        }

        $this->reset();
        $this->imageKey = rand();
    }
}
