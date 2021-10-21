<x-layout>
    <x-slot name="mainContent">
        {{ session('flash-message.account-created') }}
        @include('_posts-header');
        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            @if($posts->count())
                <x-posts-grid :posts="$posts" />

                {{ $posts->links() }}
            @else
                <p>There is no post.</p>
            @endif
        </main>


        {{--
        <h1>Hello World</h1>
        @foreach ($posts as $post)
            <article>
                <h2>
                    <a href="posts/{{$post->slug}}">
                        {!! $post->title; !!}
                    </a>
                </h2>
                <p>Written by <a href="users/{{$post->author->slug}}">{{$post->author->name}}</a>, <time datetime="{{$post->published_at}}">{{$post->published_at->diffForHumans()}}</time></p>
                <p><a href="categories/{{$post->category->name}}">{{$post->category->name}}</a></p>
                <div>{{$post->excerpt}}</div>
            </article>
        @endforeach
        --}}

    </x-slot>

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>

</x-layout>




