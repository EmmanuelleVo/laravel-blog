<x-layout>
    <x-slot name="mainContent">
        <h1>Post from : <em>{{ $user->name }}</em></h1>
        @forelse($user->posts as $post)
            <article>
                <h2><a href="../posts/{{ $post->slug }}">{{ $post->title }}</a></h2>
                <p>Written by {{$user->name}}, <time datetime="{{$post->published_at}}">{{$post->published_at->diffForHumans()}}</time></p>
                <p><a href="../categories/{{ $post->category->slug }}">{{$post->category->name}}</a></p>
                <div>{{$post->excerpt}}</div>
                @empty
                    <p>Il n'y a pas de post pour cet auteur</p>
            </article>
        @endforelse
        <a href="../users/">Go to authors</a>
    </x-slot>

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>
</x-layout>
