<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-6">
        <label class="block">
            <span class="text-gray-700">Заголовок</span>
            <input type="text" name="title" class="block w-full mt-1 rounded-md" value="{{ old('title') }}" />
        </label>
        @error('title')
            <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-6">
        <label class="block">
            <span class="text-gray-700">Пояснения</span>
            <input type="text" name="slug" class="block w-full mt-1 rounded-md" value="{{ old('slug') }}" />
        </label>
        @error('slug')
            <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-6">
        <label class="block">
            <span class="text-gray-700">Контент</span>
            <textarea class="block w-full mt-1 rounded-md" name="content" rows="3">{{ old('content') }}</textarea>
        </label>
        @error('content')
            <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-6">
        <label class="block">
            <span class="text-gray-700">Изображение</span>
            <input type="file" name="featured_image" class="block w-full mt-1 rounded-md" />
        </label>
        @error('featured_image')
            <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <x-primary-button type="submit">
        Подтвердить
    </x-primary-button>
</form>
