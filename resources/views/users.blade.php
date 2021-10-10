<x-layout>
    <x-slot name="mainContent">
        <h2>Authors</h2>
        @if($users->count())
        <ul>
            @foreach($users as $user)
                <li><a href="/users/{{ $user->slug }}">{{ $user->name }}</a> - {{$user->posts()->count()}}</li>
            @endforeach
        </ul>
        @else
            <p>Il n'y a pas d'auteurs</p>
        @endif
    </x-slot>

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>
</x-layout>
