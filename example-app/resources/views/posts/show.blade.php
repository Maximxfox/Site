<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Статья' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Заголовок' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $post->title }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Текст' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $post->content }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Изображение' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            <img class="h-64 w-128" src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" srcset="">
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Создано' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $post->created_at }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Обновлено' }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $post->updated_at }}
                        </p>
                    </div>
                    <a href="{{ route('posts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">BACK</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>