{{--<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    <title>{{ $mainTitle }}</title>
    <link rel="stylesheet" href="/app.css">
</head>

<body>
    {{ $mainContent }}
    <a href="/">Go back</a>
</body>
</html>--}}

    <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ $mainTitle }}</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        html {
            scroll-behavior: smooth
        }
    </style>
</head>

<body style="font-family: Open Sans, sans-serif;">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
            </a>
        </div>

        <div class="flex items-center mt-8 md:mt-0">
            @guest
                <a href="/register" class="text-xs font-bold uppercase">Register</a>
                <a href="/login" class="ml-6 text-xs font-bold uppercase">Log In</a>
            @else
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="text-xs font-bold uppercase">Welcome {{ auth()->user()->username }}</button>
                    </x-slot>
                    <x-slot name="entries">
                        @admin
                            <x-dropdown-item href="/admin/posts">Dashboard</x-dropdown-item>
                            <x-dropdown-item href="/admin/posts/create" :active="request()->is('/admin/posts/create')">
                                New Post
                            </x-dropdown-item>
                        @endadmin
                        <x-dropdown-item href="#" x-data="{}"
                                         @click.prevent="document.querySelector('#logout-form').submit()">Log Out
                        </x-dropdown-item>
                    </x-slot>
                </x-dropdown>

                <form id="logout-form" action="/logout" method="POST" class="hidden">
                    @csrf
                    {{--<button type="submit" class="ml-6 text-xs font-semibold text-blue-500 uppercase">Log Out</button>--}}
                </form>
            @endguest
            <a href="#newsletter"
               class="px-5 py-3 ml-3 text-xs font-semibold text-white uppercase bg-blue-500 rounded-full">
                Subscribe for Updates
            </a>
        </div>
    </nav>

    {{ $mainContent }}

    <footer id="newsletter"
            class="px-10 py-16 mt-16 text-center bg-gray-100 rounded-xl border border-black border-opacity-5">
        <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="mt-3 text-sm">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
            <div class="inline-block relative mx-auto rounded-full lg:bg-gray-200">

                <form method="POST" action="/newsletter" class="text-sm lg:flex">
                    @csrf
                    <div class="flex items-center lg:py-3 lg:px-5">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                        </label>

                        <div>
                            <input id="email" name="email" type="text" placeholder="Your email address"
                                   class="py-2 pl-4 lg:bg-transparent lg:py-0 focus-within:outline-none">
                            <x-error-message field="email"/>
                        </div>
                    </div>

                    <button type="submit"
                            class="px-8 py-3 mt-4 text-xs font-semibold text-white uppercase bg-blue-500 rounded-full transition-colors duration-300 hover:bg-blue-600 lg:mt-0 lg:ml-3">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </footer>
</section>

<x-flash-message/>

</body>
</html>
