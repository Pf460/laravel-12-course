@extends('admin.layouts.app')

@section('title', 'Посты')

@section('content')
    <form action="{{ route('admin.posts.index') }}" method="GET"
          style="display: flex; flex-wrap: wrap; gap: 14px; align-items: flex-end; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
        <div style="flex: 1 1 220px;">
            <label for="search" class="form__label">Поиск</label>
            <input type="text" name="search" id="search" class="form__input"
                   value="{{ request('search') }}" placeholder="Заголовок или slug">
        </div>

        <div style="flex: 0 0 180px;">
            <label for="status" class="form__label">Статус</label>
            <select name="status" id="status" class="form__input">
                <option value="">Все</option>
                <option value="published" @selected(request('status') === 'published')>Опубликованные</option>
                <option value="draft" @selected(request('status') === 'draft')>Черновики</option>
            </select>
        </div>

        <div style="flex: 0 0 160px;">
            <label for="date_from" class="form__label">Публикация с</label>
            <input type="date" name="date_from" id="date_from" class="form__input"
                   value="{{ request('date_from') }}">
        </div>

        <div style="flex: 0 0 160px;">
            <label for="date_to" class="form__label">по</label>
            <input type="date" name="date_to" id="date_to" class="form__input"
                   value="{{ request('date_to') }}">
        </div>

        <div style="display: flex; gap: 8px;">
            <button type="submit" class="btn btn--primary">Применить</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn--secondary">Сбросить</a>
        </div>
    </form>

    <div class="page-head">
        <p class="page-head__text">
            Всего постов: {{ $posts->total() }}
            @if ($posts->hasPages())
                · страница {{ $posts->currentPage() }} из {{ $posts->lastPage() }}
            @endif
        </p>
        <a href="{{ route('admin.posts.create') }}" class="btn btn--primary">Новый пост</a>
    </div>

    @if ($posts->isEmpty())
        <div class="table-wrap">
            <div class="empty">
                Постов пока нет. <a href="{{ route('admin.posts.create') }}">Создайте первый</a>.
            </div>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>Slug</th>
                        <th>Статус</th>
                        <th>Публикация</th>
                        <th>Создан</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                <strong>{{ $post->title }}</strong>
                                @if ($post->excerpt)
                                    <div class="table-excerpt">{{ Str::limit($post->excerpt, 80) }}</div>
                                @endif
                            </td>
                            <td><code>{{ $post->slug }}</code></td>
                            <td>
                                @if ($post->is_published)
                                    <span class="badge badge--green">Опубликован</span>
                                @else
                                    <span class="badge badge--gray">Черновик</span>
                                @endif
                            </td>
                            <td>{{ $post->published_at?->format('d.m.Y') ?? '—' }}</td>
                            <td>{{ $post->created_at?->format('d.m.Y') }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn--secondary btn--sm">Открыть</a>
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn--secondary btn--sm">Изменить</a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                          onsubmit="return confirm('Удалить этот пост?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--danger btn--sm">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="admin-pagination">
            {{ $posts->withQueryString()->links('pagination::simple-tailwind') }}
        </div>
    @endif
@endsection
