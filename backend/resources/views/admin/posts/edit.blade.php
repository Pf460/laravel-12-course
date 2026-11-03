@extends('admin.layouts.app')

@section('title', 'Редактирование поста')

@section('content')
    <div class="page-head">
        <h2 class="panel__title" style="margin: 0;">Редактирование поста</h2>
    </div>

    <div class="panel" style="max-width: 780px;">
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form__group">
                <label for="image" class="form__label">Изображение</label>
                <input type="file" name="image" accept="image/*" class="form__input">
                @error('image') <p class="alert--error"> {{ $message }} </p> @enderror
            </div>

            @if (isset($post) && $post->image)
                <div class="form__group" style="margin-top: 20px;">
                    <p class="muted" style="margin-bottom: 8px;">Текущее изображение</p>
                    <img src="{{ $post->image_url }}" alt=""
                         style="height: 128px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border);" />

                    <label class="form__check" style="margin-top: 12px; cursor: pointer;">
                        <input type="checkbox" name="remove_image" value="1">
                        <span>Удалить изображение</span>
                    </label>
                </div>
            @endif

            <div class="form__group">
                <label for="title" class="form__label">Заголовок</label>
                <input type="text" name="title" id="title" class="form__input"
                       value="{{ old('title', $post->title) }}" placeholder="Название поста"  autofocus>
                @error('title') <p class="alert--error"> {{ $message }} </p> @enderror
            </div>

            <div class="form__group">
                <label for="excerpt" class="form__label">Краткое описание</label>
                <textarea name="excerpt" id="excerpt" class="form__textarea" rows="3"
                          placeholder="Тизер для списка постов..." >{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt') <p class="alert--error"> {{ $message }} </p> @enderror
            </div>

            <div class="form__group">
                <label for="body" class="form__label">Текст</label>
                <textarea name="body" id="body" class="form__textarea" rows="10"
                          placeholder="Основной контент..." >{{ old('body', $post->body) }}</textarea>
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
