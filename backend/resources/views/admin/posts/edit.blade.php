@extends('admin.layouts.app')

@section('title', 'Редактирование поста')

@section('content')
    <div class="page-head">
        <h2 class="panel__title" style="margin: 0;">Редактирование поста</h2>
    </div>

    <div class="panel" style="max-width: 780px;">
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" class="form">
            @csrf
            @method('PUT')

            <div class="form__group">
                <label for="title" class="form__label">Заголовок</label>
                <input type="text" name="title" id="title" class="form__input"
                       value="{{ old('title', $post->title) }}" placeholder="Название поста" required autofocus>
                @error('title') <p class="alert--error"> {{ $message }} </p> @enderror
            </div>

            <div class="form__group">
                <label for="excerpt" class="form__label">Краткое описание</label>
                <textarea name="excerpt" id="excerpt" class="form__textarea" rows="3"
                          placeholder="Тизер для списка постов..." required>{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt') <p class="alert--error"> {{ $message }} </p> @enderror
            </div>

            <div class="form__group">
                <label for="body" class="form__label">Текст</label>
                <textarea name="body" id="body" class="form__textarea" rows="10"
                          placeholder="Основной контент..." required>{{ old('body', $post->body) }}</textarea>
                @error('body') <p class="alert--error"> {{ $message }} </p> @enderror

            </div>

            <div class="form__group">
                <label for="is_published" class="form__label">Статус</label>
                <input type="checkbox" name="is_published" {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }} />
            </div>

            <div class="form__actions">
                <a href="{{ route('admin.posts.index') }}" class="btn btn--secondary">Отмена</a>
                <button type="submit" class="btn btn--primary">Обновить</button>
            </div>
        </form>
    </div>
@endsection
