<x-layout>
    <x-slot name="mainContent">
        <x-setting :heading="'Edit Post: ' . $post->title">
            <form action="/admin/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data" x-data="{ title: '{{ old('title', $post->title) }}' }">
                @csrf
                @method('PATCH')

                <x-form.input name="title" x-model="title" required/>
                <x-form.input name="slug" x-bind:value="slugify(title).toLowerCase()" required/>
                <x-form.textarea name="excerpt">{{ old('excerpt', $post->excerpt) }} </x-form.textarea>
                <x-form.textarea name="body">{{ old('body', $post->body) }}</x-form.textarea>
                <div class="flex mt-6">
                    <div class="flex-1">
                        <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)"/>
                    </div>
                    <img src="{{ asset('storage/' . $post->thumbnail_path) }}" alt="" class="rounded-xl ml-6" width="100" style="height: 100px">
                </div>


                <x-form.field>
                    <x-form.label name="category"/>

                    <select name="category_id" id="category">
                        @foreach(\App\Models\Category::all() as $category)
                            <option
                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
                                value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-error-message field="category_id"/>
                </x-form.field>

                <x-form.button>Update</x-form.button>

            </form>
        </x-setting>
    </x-slot>

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>
</x-layout>
