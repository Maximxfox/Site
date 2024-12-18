<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Category Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('posts.update',$post->id) }}">
                        @csrf
                        @method('put')
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Заголовок</span>
                                <input type="text" name="title"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" value="{{old('title',$post->title)}}" />
                            </label>
                            @error('title')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Описание</span>
                                <input type="text" name="slug"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" value="{{old('slug',$post->slug)}}" />
                            </label>
                            @error('slug')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Контент</span>
                                <textarea id="editor" class="block w-full mt-1 rounded-md" name="content"
                                    rows="3">{{ $post->content}}</textarea>
                            </label>
                            @error('content')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <x-primary-button type="submit">
                            Обновить
                        </x-primary-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>