<x-layout>
    <x-slot name="mainContent">
        <x-setting heading="Publish New Post">
            <form action="/admin/posts" method="POST" enctype="multipart/form-data" x-data="{ title: '' }">
                @csrf

                <x-form.input name="title" x-model="title"/>
                <x-form.input name="slug" x-bind:value="slugify(title).toLowerCase()"/>
                <x-form.textarea name="excerpt"/>
                <x-form.textarea name="body"/>
                <x-form.input name="thumbnail" type="file"/>

                <x-form.field>
                    <x-form.label name="category"/>

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
                </x-form.field>

                <x-form.button>Publish</x-form.button>

            </form>
        </x-setting>
    </x-slot>

    <x-slot name="mainTitle">
        {{ $page_title }}
    </x-slot>
</x-layout>
