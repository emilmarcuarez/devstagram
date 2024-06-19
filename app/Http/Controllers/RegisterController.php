<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public  function index()
    {
        // busca en la carpeta auth el archivo register
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request->get('username'));


        // modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        // validacion 
       $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);
         //  insertar un usuario
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);

        // Autenticar a un usuario. returna un bool si se autentico  o no. llena el objeto de auth si se autentica el usuario (si se registra) con los datos del mismo.
        auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'username' => $request->username
        ]);

        // otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // redireccionar
        return redirect()->route('post.index', auth()->user() );
    }
}
