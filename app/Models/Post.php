<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // fillable tiene la informacion que va a guardar laravel en la base de datos, que debe ser la misma que tenga el create en el controlador
    protected $fillable=[
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    
 // un post pertenece a un usuario
    public function user(){
        // un post pertenece a un usuario
        // return $this->belongsTo(User::class);
        // Para traer unos datos en especifico:
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
    
    // un post va a tener multiples comentarios
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
}
