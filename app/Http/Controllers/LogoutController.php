<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
   public function store(){
//    cierra sesion
    auth()->logout();
    return redirect()->route('login');
   }
}
