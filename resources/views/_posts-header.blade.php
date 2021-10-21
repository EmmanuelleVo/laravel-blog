<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Laravel From Scratch</span> News
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
        <!--  Category -->
        <div class="relative lg:inline-flex bg-gray-100 rounded-xl">

            <x-category-dropdown />

            {{--<form action="/categories/{{ $category->slug }}">
                <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold" name="select">
                    <option value="category" disabled selected>Category
                        <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22"
                             height="22" viewBox="0 0 22 22">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path fill="#222"
                                      d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                            </g>
                        </svg>
                    </option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex ">
                    Search for category
                </button>
            </form>--}}
        </div>


        <!-- Author Filters -->
       {{-- <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">

            <div x-data="{ show: false }" @click.away="show=false">

                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex ">
                            {{ isset($currentAuthor) ? $currentAuthor->name : 'Authors' }}

                            <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22"
                                 height="22" viewBox="0 0 22 22">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path fill="#222"
                                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                                </g>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="entries">
                        <x-dropdown-item href="/">
                            All posts
                        </x-dropdown-item>
                        @foreach($users as $user)
                            <x-dropdown-item href="/users/{{ $user->slug }}"
                                             :active="isset($currentAuthor) && $currentAuthor->is($user)">
                                {{ ucwords($user->name) }}
                            </x-dropdown-item>

                            --}}{{--<a href="/users/{{ $user->slug }}"
                               class="block text-left px-3 text-sm leading-7
                           {{ isset($currentAuthor) && $currentAuthor->is($user) ? 'bg-blue-500 text-white' : 'hover:bg-blue-500 focus:bg-blue-500
                           hover:text-white focus:text-white' }}">
                                {{ $user->name }}
                            </a>--}}{{--
                        @endforeach
                    </x-slot>
                </x-dropdown>

            </div>

            --}}{{--<select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
                <option value="category" disabled selected>Authors
                </option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>--}}{{--
        </div>--}}

        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="/">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                <input type="text" name="search" placeholder="Find something" value="{{ request('search') }}"
                       class="bg-transparent placeholder-black font-semibold text-sm">
            </form>
        </div>
    </div>
</header>
