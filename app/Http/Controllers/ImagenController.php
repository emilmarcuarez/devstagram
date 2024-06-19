<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    // subir imagen de los post
   public function store(Request $request){
    $imagen=$request->file('file');

    $nombreImagen= Str::uuid() . "." . $imagen->extension();

    $imagenServidor= Image::make($imagen);

    $imagenServidor->fit(1000,1000);

    // public_path permite apuntar a la carpeta public
    $imagenPath=public_path('uploads') . '/' . $nombreImagen;
    $imagenServidor->save($imagenPath);

    // json puede servir como una conexion entre el front y backend
    return response()->json(['imagen' => $nombreImagen ]);
   }
}
