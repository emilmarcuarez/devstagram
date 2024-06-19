<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

Route::get('/', function() {
    
    return view('principal');
 });

// Route::get('/', [RegisterController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']); //store es para poste, no se pone el name otra vez porque por default agarra el anterior
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// el middleware indica que para todos estos metodos el usuario debe estar autenticado
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post',[PostController::class, 'store'])->name('post.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

// borrar un post
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
// comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

// like a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');