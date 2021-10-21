 <x-dropdown>
        {{-- Trigger --}}
        <x-slot name="trigger">
            <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex ">
                {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

                <x-svg.down-arrow class="absolute pointer-events-none" style="right: 12px;"/>
            </button>
        </x-slot>

        {{-- Links / Items --}}
        <x-slot name="entries">
            <x-dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}" :active="request()->routeIs('home') && !request('category')">
                All posts
            </x-dropdown-item>
            @foreach($categories as $category)
                <x-dropdown-item href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
                                 :active="isset($currentCategory) && $currentCategory->is($category)">
                    {{ ucwords($category->name) }}
                </x-dropdown-item>
            @endforeach
        </x-slot>

    </x-dropdown>
