<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function __construct(){
        
    }
    public function index(){
        return view('perfil.index');
    }
    public function store(Request $request){

            // modificar el request
            $request->request->add(['username' => Str::slug($request->username)]);

        $request->validate([
            'username' => ['required', 'unique:users','min:3','max:20', 'not_in:twitter,editar-perfil']
        ]);
    }
}
