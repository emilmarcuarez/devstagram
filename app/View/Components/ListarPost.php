<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
   public $posts;
    // es necesario coloar el mismo nombre de variable que se esta pasando
    public function __construct($posts)
    {
        // para recibir post. se envia en automatico a la vista
        $this->posts=$posts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listar-post');
    }
}
