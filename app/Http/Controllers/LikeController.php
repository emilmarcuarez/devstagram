<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post){
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post){
        $request->user()->Likes()->where('post_id', $post->id)->delete();
        // para que regrese a la pagina previa
        return back();
    }
}
