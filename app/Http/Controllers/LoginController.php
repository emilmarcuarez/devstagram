<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    // iniciar sesion
    public function store(Request $request)
    {

        $request->validate([
        'email' => 'required|email',
        'password' => 'required'
       ]);
       
       if(!auth()->attempt($request->only('email', 'password'),$request->remember)){
        // si no se autentica 
        return back()->with('mensaje', 'Credenciales incorrectas'); //back no te redirecciona sino que vuelve a donde estas ingresando las credenciales
       }

    //    redirecciona a esta pagina index y le pasas el username del usuario
    return redirect()->route('post.index', auth()->user()->username );
    }
}
