<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller implements HasMiddleware
{
   public function __construct() {
      $this->middleware('auth');
  }
  public static function middleware(): array
  {
      return [
          new Middleware('auth', except: ['show', 'index']),
      ];
  }

   // perfil del usuario
   public function index(User $user)
   {
      // se va a atraer los post del usuario que se esta visitando
      $posts=Post::where('user_id', $user->id)->paginate(2);

    return  view('dashboard', [
      'user'=>$user,
      'posts'=>$posts
    ]);
   }

   public function create()
   {
      // carpeta.archivo
      return view('posts.create');
   }

   // store almacena en la base de datos
   public function store(Request $request){
      $request->validate([
         'titulo' => 'required|max:255',
         'descripcion' => 'required',
         'imagen' => 'required'
     ]);

   //   se llama al metodo post del modelo y al metodo create se manda lo que va a insertar a la base de datos
   //   Post::create([
   //       'titulo' =>$request->titulo,
   //       'descripcion' =>$request->descripcion,
   //       'imagen' =>$request->imagen,
   //       'user_id' => auth()->user()->id //el usuario que esta autenticado
   //   ]);

   // otra forma de guardar en la base de datos:
   // $post=new Post;
   // $post->titulo=$request->titulo;
   // $post->descripcion=$request->descripcion;
   // $post->imagen=$request->imagen;
   // $post->user_id=auth()->user()->id;
   // $post->save();
// para crear algo en la base ded dtaos con la relacion, se coloca el nombre del kmodelo y el nombre de la funcion que tiene la relacion en el modelo, en este caso es post
   $request->user()->posts()->create([
      'titulo' =>$request->titulo,
      'descripcion' =>$request->descripcion,
      'imagen' =>$request->imagen,
      'user_id' => auth()->user()->id //el usuario que esta autenticado
   ]);
   
     return redirect()->route('post.index', auth()->user()->username);
   }

   // lo recibe por el route del dashboard
   public function show(User $user, Post $post){
      
      return view('posts.show', [
         'post' =>$post,
         'user'=>$user
      ]);
   }

   public function destroy(Post $post){
      $this->authorize('delete', $post);
   //   Eliminar la imagen
   $imagen_path=public_path('uploads/' . $post->imagen);
    if(File::exists($imagen_path)){
      unlink($imagen_path);
   
    }
    $post->delete();
      return redirect()->route('post.index', auth()->user()->username);
   }
}
