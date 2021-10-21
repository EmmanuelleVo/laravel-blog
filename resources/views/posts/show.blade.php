<x-layout>
    <x-slot name="mainContent">
        <main class="mx-auto mt-10 space-y-6 max-w-6xl lg:mt-20">
            <article class="gap-x-10 mx-auto max-w-4xl lg:grid lg:grid-cols-12">
                <div class="col-span-4 mb-10 lg:text-center lg:pt-14">
                    <img src="/images/illustration-1.png" alt="" class="rounded-xl">

                    <p class="block mt-4 text-xs text-gray-400">
                        Published
                        <time datetime="{{$post->published_at}}">{{$post->published_at->diffForHumans()}}</time>
                    </p>

                    <div class="flex items-center mt-4 text-sm lg:justify-center">
                        <img src="/images/lary-avatar.svg" alt="Lary avatar">
                        <div class="ml-3 text-left">
                            <h5 class="font-bold"><a
                                    href="../?author={{ $post->author->username }}">{{ $post->author->name }}</a></h5>
                            <h6>Mascot at Laracasts</h6>
                        </div>
                    </div>
                </div>

                <div class="col-span-8">
                    <div class="hidden justify-between mb-6 lg:flex">
                        <a href="../.."
                           class="inline-flex relative items-center text-lg transition-colors duration-300 hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>
                            Back to Posts
                        </a>

                        <div class="space-x-2">
                            <x-category-button :category="$post->category"/>
                        </div>
                    </div>

                    <h1 class="mb-10 text-3xl font-bold lg:text-4xl">
                        {{ $post->title }}
                    </h1>

                    <div class="space-y-4 leading-loose lg:text-lg">
                        {!! $post->body !!}
                    </div>
                </div>

                <section class="col-span-8 col-start-5 mt-10 space-y-6">
                    <h3 class="text-xl font-bold">Comments</h3>
                    @auth()
                        <x-panel>
                            <form action="/posts/{{$post->slug}}/comments" method="POST">
                                @csrf

                                <header class="flex items-center">
                                    <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40"
                                         height="40" class="rounded-full">
                                    <h3 class="ml-4">Want to participate?</h3>
                                </header>

                                <div class="mt-6">
                                    <label for="body"
                                           class="block mb-2 text-xs font-bold text-gray-700 uppercase">Write your
                                        comment</label>
                                    <textarea id="body" name="body"
                                              cols="30"
                                              rows="5"
                                              placeholder="Quick, think of something to say!"
                                              class="w-full text-sm focus:outline-none focus:ring"></textarea>
                                    <x-error-message field="body"/>
                                </div>

                                <div class="flex justify-end pt-6 mt-6 border-t border-gray-200">
                                    <button type="submit"
                                            class="px-10 py-2 text-xs font-semibold text-white uppercase bg-blue-500 rounded-2xl hover:bg-blue-600">
                                        Publish
                                    </button>
                                </div>
                            </form>
                        </x-panel>
                    @else
                        <p class="font-semibold text-center">
                            <a href="../register"
                               class="transition-colors duration-300 hover:text-blue-500 hover:underline">Register</a>
                            or
                            <a href="../login"
                               class="transition-colors duration-300 hover:text-blue-500 hover:underline">log in</a> to
                            leave a comment.
                        </p>
                    @endauth

                    @foreach($post->comments as $comment)
                        <x-post-comment :comment="$comment"/>
                    @endforeach


                </section>
            </article>
        </main>
    </x-slot>


    {{--<x-slot name="mainContent">
        <h1>Hello World</h1>
        <article>
            <h2>{{ $post->title }}</h2>
                <p>Written by <a href="../users/{{$post->author->slug}}">{{$post->author->name}}</a>, <time datetime="{{$post->published_at}}">{{$post->published_at->diffForHumans()}}</time></p>
            <p><a href="../categories/{{ $post->category->slug }}">{{$post->category->name}}</a></p>
            {!! $post->body !!}
        </article>
    </x-slot>--}}

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>
</x-layout>




