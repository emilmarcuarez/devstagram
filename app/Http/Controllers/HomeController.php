<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // invoke se ejecuta apenas se lama a la clase, es inncesario llamar al metodo
    public function __invoke(){
        // obtener a quienes seguimos
       $ids= auth()->user()->followings->pluck('id')->toArray();
        $posts=Post::whereIn('user_id', $ids)->latest()->paginate(10);
       return view('home',[
        'posts'=>$posts
       ]);
    }
}
