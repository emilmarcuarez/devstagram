<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;
    // carga al abrir la pestaña
    public function mount($post){
        $this->isLiked=$post->checkLike(auth()->user());
        $this->likes= $post->likes->count();
    }

    // funcion llamada desde el otro archivo de livewire
    public function like(){
        // si el usuario le dio like
        if( $this->post->checkLike(auth()->user())){
            $this->post->Likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked= false;
            $this->likes--;
        }else{
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked= true;
            $this->likes++;
        }
     }
    public function render()
    {
        return view('livewire.like-post');
    }
}
