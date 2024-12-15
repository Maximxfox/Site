<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between;">
            <h2 style="font-weight: 600; font-size: 1.25rem; color: #2d3748; line-height: 1.25rem;">
                {{ 'Посты' }}
            </h2>
            <a href="{{ route('posts.create') }}" style="background-color: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; text-align: center;">Добавить</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 1.5rem;">
            <div style="background-color: #ffffff; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.375rem;">
                <div style="padding: 1.5rem; color: #1a202c;">
                    <table style="border-collapse: collapse; width: 100%; font-size: 0.875rem;">
                        <thead>
                            <tr>
                                <th style="border-bottom: 1px solid #ccc; font-weight: 500; padding: 1rem 1rem 0.75rem 2rem; color: #64748b; text-align: left;">Заголовок</th>
                                <th style="border-bottom: 1px solid #ccc; font-weight: 500; padding: 1rem 1rem 0.75rem 2rem; color: #64748b; text-align: left;">Создано</th>
                                <th style="border-bottom: 1px solid #ccc; font-weight: 500; padding: 1rem 1rem 0.75rem 2rem; color: #64748b; text-align: left;">Обновлено</th>
                                <th style="border-bottom: 1px solid #ccc; font-weight: 500; padding: 1rem 1rem 0.75rem 2rem; color: #64748b; text-align: left;">Действие</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            {{-- populate our post data --}}
                            @foreach ($posts as $post)
                                <tr>
                                    <td style="border-bottom: 1px solid #e2e8f0; padding: 1rem 1rem 1rem 2rem; color: #6b7280; background-color: #f9fafb;">{{ $post->title }}</td>
                                    <td style="border-bottom: 1px solid #e2e8f0; padding: 1rem 1rem 1rem 2rem; color: #6b7280; background-color: #f9fafb;">{{ $post->created_at }}</td>
                                    <td style="border-bottom: 1px solid #e2e8f0; padding: 1rem 1rem 1rem 2rem; color: #6b7280; background-color: #f9fafb;">{{ $post->updated_at }}</td>
                                    <td style="border-bottom: 1px solid #e2e8f0; padding: 1rem 1rem 1rem 2rem; color: #6b7280; background-color: #f9fafb;">
                                        <a href="{{ route('posts.show', $post->id) }}" style="border: 1px solid #3b82f6; padding: 0.5rem 1rem; border-radius: 0.375rem; color: #3b82f6; text-decoration: none; display: inline-block; text-align: center; transition: background-color 0.2s ease, color 0.2s ease;">Показать</a>

                                        {{-- Проверка, если текущий пользователь создал пост --}}
                                        @if ($post->user_id === auth()->id())
                                            <a href="{{ route('posts.edit', $post->id) }}" style="border: 1px solid #f59e0b; padding: 0.5rem 1rem; border-radius: 0.375rem; color: #f59e0b; text-decoration: none; display: inline-block; text-align: center; transition: background-color 0.2s ease, color 0.2s ease;">Обновить</a>

                                            <form method="post" action="{{ route('posts.destroy', $post->id) }}" style="display: inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" style="border: 1px solid #ef4444; padding: 0.5rem 1rem; border-radius: 0.375rem; color: #ef4444; background-color: transparent; text-decoration: none; display: inline-block; text-align: center; transition: background-color 0.2s ease, color 0.2s ease;">Удалить</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
