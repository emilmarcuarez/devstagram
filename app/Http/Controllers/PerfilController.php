<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct(){
        
    }
    public function index(){
        return view('perfil.index');
    }
    public function store(Request $request){

            // modificar el request
            $request->request->add(['username' => Str::slug($request->username),'email' => $request->email]);

        $request->validate([
            'username' => ['required', 'unique:users,username,'.auth()->user()->id,'min:3','max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id,'max:60']
        ]);
        // subir imagen. si se ha subido una imagen, la coloca.
        if($request->imagen){
            $imagen=$request->file('imagen');

            $nombreImagen= Str::uuid() . "." . $imagen->extension();
        
            $imagenServidor= Image::make($imagen);
        
            $imagenServidor->fit(1000,1000);
        
            // public_path permite apuntar a la carpeta public
            $imagenPath=public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        
        }

        // guardar cambio

        $usuario=User::find(auth()->user()->id);

        $usuario->username=$request->username;
        $usuario->email=$request->email;
        $usuario->imagen=$nombreImagen ?? auth()->user()->imagen ??'';

        $usuario->save();

        // redireccionar al usuario

        return redirect()->route('post.index', $usuario->username);
    }
}
