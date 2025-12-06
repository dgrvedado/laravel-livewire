<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostEditForm extends Form
{

    public $showModalEdit = false;
    public $postId;

    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $content;

    #[Rule('required|exists:categories,id')]
    public $category_id = '';

    #[Rule('required|array')]
    public $tags = [];

    public function edit(Post $post)
    {
        $this->showModalEdit = true;

        $this->postId = $post->id;

        $this->category_id = $post->category_id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->tags = $post->tags->pluck('id')->toArray();
    }


    public function update()
    {
        $this->validate();

        $post = auth()->user()->posts()->findOrFail($this->postId);
        //$post = Post::find($this->postEditId);

        $post->update(
            $this->only('category_id', 'title', 'content')
        );

        $post->tags()->sync($this->tags);

        $this->reset();
    }
}
