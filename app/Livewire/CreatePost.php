<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class CreatePost extends Component
{
    //Tipos de Datos
    /**
     * Datos primitivos:
     * Array, String, Integer, Boolean, Float, DateTime, Null
     * Datos complejos: (Deshidarata en JSON e Hidrata en Objetos PHP)
     * Collections, Models, Arrays asociativos
     */

    public $title; //= 'Hola Mundo!!!';
    public  $name, $email;

    public function mount(User $user)
    {
        //$this->user = $user; //Con esto accedo a propiedades del objeto
        $this->fill(
            $user->only(['name', 'email'])
        );

    }

    public function save()
    {

        //Validaciones
        /*$this->validate(
            [
                'name' => 'required|min:6',
                'email' => 'required|email',
            ]
        );*/

        //Guardar en BD
        //User::create([...]);

        //Mensajes de session
        //session()->flash('message', 'Usuario creado correctamente');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
