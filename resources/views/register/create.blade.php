<x-layout>
    <x-slot name="mainContent">
        <section class="px-6 py-8">
            <main class="max-w-lg mx-auto mt-10 bg-gray-100 p-6 rounded-xl border border-gray-200">
                <h1 class="text-center font-bold text-xl">Register</h1>
                <form action="/register" method="POST" class="mt-10">
                    @csrf
                    <div class="mb-6">
                        <label for="username"
                               class="block mb-2 uppercase font-bold text-xs text-gray-700">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                               class="border border-gray-400 p-2 w-full">
                    <x-error-message field="username"/>
                    </div>


                    <div class="mb-6">
                        <label for="name"
                               class="block mb-2 uppercase font-bold text-xs text-gray-700">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="border border-gray-400 p-2 w-full">

                        <x-error-message field="name"/>
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                               class="border border-gray-400 p-2 w-full">

                        <x-error-message field="email"/>
                    </div>

                    <div class="mb-6">
                        <label for="password"
                               class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
                        <input type="text" id="password" name="password" value="{{ old('password') }}"
                               class="border border-gray-400 p-2 w-full">

                        <x-error-message field="password"/>
                    </div>

                    <div class="mb-6">
                        {{--<input type="submit" value="Register"
                               class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">--}}
                        <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Submit</button>
                    </div>
                </form>
            </main>
        </section>
    </x-slot>

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>
</x-layout>
