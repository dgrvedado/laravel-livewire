<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\View\View;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Formulario extends Component
{
    use WithFileUploads, WithPagination;

    public $categories, $tags;

    public PostCreateForm $postCreate;

    public PostEditForm $postEdit;

    #[Url(as: 's')]
    public $search = '';



    public function mount(): void
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    /**
     * updating: es el momento en el cual se intenta modificar una propiedad, pero sin que se haya modificado
     * sirve para evaluar si el valor que se intenta enviar es valido o no, se puede comparar y eventualmente
     * dar una excepcion.
     * updated: es en el monento en el cual se ha modificado la propiedad
     */
    /*public function updating($property, $value)
    {
        dd($property);
    }*/

    /**
     * hydrate: es la forma en que puedo enviarlo al frontend como mandar los datos en modo JSON
     * dehydrate: es la forma en que puedo recibir los datos del frontend en modo Array.
     */
    /*public function hydrate()
    {

    }*/

    public function save():  void
    {
        $this->postCreate->save();
        $this->resetPage(pageName: 'pagePosts');
        $this->dispatch('post-event', 'Post creado correctamente ');
    }

    public function edit(Post $post):  void
    {
        $this->resetValidation();
        $this->postEdit->edit($post);

    }

    public function update():  void
    {
        $this->postEdit->update();
        $this->dispatch('post-event', 'Post actualizado correctamente ');
    }

    public function delete(Post $post):  void
    {
        $post->tags()->detach();
        $post->delete();
        $this->dispatch('post-event', 'Post eliminado correctamente ');
        if($post->image_path){
            unlink(public_path($post->image_path));
        }
    }

    /*public function placeholder(): View
    {
        return view('livewire.placeholders.skeleton');
    }*/

    public function render(): View
    {
        $posts = Post::with('tags')
                ->when($this->search, function($query){
                    $query->where('title', 'like', '%' . $this->search . '%');
                })
                ->where('title', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'desc')
                ->paginate(5, pageName: 'pagePosts');
        return view('livewire.formulario', compact('posts'));
    }
}
