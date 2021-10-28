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
                          required
                          placeholder="Quick, think of something to say!"
                          class="w-full text-sm focus:outline-none focus:ring">{{ old('body') }}</textarea>

                <x-error-message field="body"/>
            </div>

            <div class="flex justify-end pt-6 mt-6 border-t border-gray-200">
                <x-submit-button>Post</x-submit-button>
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
