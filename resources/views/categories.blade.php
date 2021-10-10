<x-layout>
    <x-slot name="mainContent">
        <h2>Available categories</h2>
        @if($categories->count())
        <ul>
            @foreach($categories as $category)
                <li><a href="/categories/{{ $category->slug }}">{{ $category->name }}</a> - {{$category->posts()->count()}}</li>
            @endforeach
        </ul>
        @else
            <p>Il n'y a pas de catégorie</p>
        @endif
    </x-slot>

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>
</x-layout>
