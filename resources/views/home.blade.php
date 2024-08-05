@extends('layouts.app')

<!-- inyecta 'lo que ponga dentro del section' al yield que tenga ese nombre en el archivo que estoy llamando en extends-->
@section('titulo')
    Pagina principal
@endsection
@section('contenido')
{{-- componnete --}}
{{-- se esta pasando la variable post al componente, al archivo de app --}}
     <x-Listar-post :posts="$posts"/>
@endsection