<x-layout>
    <x-slot name="mainContent">
        <h1>Post from : <em>{{ $category->name }}</em> category</h1>
        @forelse($category->posts as $post)
            <article>
                <h2><a href="../posts/{{ $post->slug }}">{{ $post->title }}</a></h2>
                <p>Written by <a href="../users/{{$post->author->slug}}">{{$post->author->name}}</a>, <time datetime="{{$post->published_at}}">{{$post->published_at->diffForHumans()}}</time></p>
                <div>{{$post->excerpt}}</div>
                @empty
                    <p>Il n'y a pas de post pour cette catégorie</p>
            </article>
        @endforelse
        <a href="../categories/">Go to categories</a>
    </x-slot>

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>
</x-layout>
