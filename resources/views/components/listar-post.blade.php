<div>
    @if($posts->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    {{-- le mando el post al que se le esta dando click y en el web ya esta establecido --}}
                    {{-- se envia user y post porque el link tiene ambos datos --}}
                    <a href="{{ route('posts.show', ['post'=> $post, 'user'=> $post->user])}}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="imagen del post {{ $post->titulo}}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{-- muestra lo de la paginacion --}}
            {{ $posts->links('pagination::tailwind') }}
        </div>

    @else
        <p class="text-center">No hay post aun</p>
    @endif
</div>