<x-layout>


    <x-slot name="mainContent">
        <section class="px-6 py-8">
            <x-panel class="max-w-sm mx-auto">
                <h1 class="text-lg font-bold mb-4">Publish New Post</h1>
                <form action="/admin/posts" method="POST" enctype="multipart/form-data" x-data="{ title: '' }">
                    @csrf

                    <div class="mb-6">
                        <label for="title"
                               class="block mb-2 uppercase font-bold text-xs text-gray-700">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required x-model="title"
                               class="border border-gray-400 p-2 w-full">
                        <x-error-message field="title"/>
                    </div>

                    <div class="mb-6">
                        <label for="slug"
                               class="block mb-2 uppercase font-bold text-xs text-gray-700">Slug</label>
                        <input type="text" id="slug" name="slug" x-bind:value="slugify(title).toLowerCase()" required
                               class="border border-gray-400 p-2 w-full">
                        <x-error-message field="slug"/>
                    </div>

                    <div class="mb-6">
                        <label for="excerpt"
                               class="block mb-2 uppercase font-bold text-xs text-gray-700">Excerpt</label>
                        <textarea id="excerpt" name="excerpt" required
                                  class="border border-gray-400 p-2 w-full">{{ old('excerpt') }}</textarea>
                        <x-error-message field="excerpt"/>
                    </div>

                    <div class="mb-6">
                        <label for="body"
                               class="block mb-2 uppercase font-bold text-xs text-gray-700">Body</label>
                        <textarea id="body" name="body" required
                                  class="border border-gray-400 p-2 w-full">{{ old('body') }}</textarea>
                        <x-error-message field="body"/>
                    </div>

                    <div class="mb-6">
                        <label for="category"
                               class="block mb-2 uppercase font-bold text-xs text-gray-700">Category</label>
                        <select name="category_id" id="category">
                            @foreach(\App\Models\Category::all() as $category)
                                <option
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-error-message field="category_id"/>
                    </div>

                    <div class="mb-6">
                        <label for="thumbnail"
                               class="block mb-2 uppercase font-bold text-xs text-gray-700">Thumbnail</label>
                        <input type="file" id="thumbnail" name="thumbnail" value="{{ old('thumbnail') }}"
                               class="border border-gray-400 p-2 w-full">
                        <x-error-message field="thumbnail"/>
                    </div>

                    <x-submit-button>Publish</x-submit-button>

                </form>
            </x-panel>
        </section>

    </x-slot>

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>
</x-layout>
