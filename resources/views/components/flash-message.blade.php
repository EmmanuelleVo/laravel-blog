@if(session()->has('success'))
    <div x-data="{ show : true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="bg-blue-500 bottom-4 fixed px-4 py-2 right-4 rounded-xl text-white">
        <p>{{ session('success') }}</p>
    </div>
@endif
