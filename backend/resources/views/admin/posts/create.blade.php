@extends('admin.layouts.app')

@section('title', 'Создание поста')

@section('content')
    <div class="page-head">
        <h2 class="panel__title" style="margin: 0;">Новый пост</h2>
    </div>

    <div class="panel" style="max-width: 780px;">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf

            <div class="form__group">
                <label for="image" class="form__label">Изображение</label>
                <input type="file" name="image" accept="image/*" class="form__input">
                @error('image') <p class="alert--error"> {{ $message }} </p> @enderror
            </div>

            <div class="form__group">
                <label for="title" class="form__label">Заголовок</label>
                <input type="text" name="title" id="title" class="form__input"
                       value="{{ old('title') }}" placeholder="Название поста" autofocus>
                @error('title') <p class="alert--error"> {{ $message }} </p> @enderror
            </div>

            <div class="form__group">
                <label for="excerpt" class="form__label">Краткое описание</label>
                <textarea name="excerpt" id="excerpt" class="form__textarea" rows="3"
                          placeholder="Тизер для списка постов..." >{{ old('excerpt') }}</textarea>
                @error('excerpt') <p class="alert--error"> {{ $message }} </p> @enderror
            </div>

            <div class="form__group">
                <label for="body" class="form__label">Текст</label>
                <textarea name="body" id="body" class="form__textarea" rows="10"
                          placeholder="Основной контент..." >{{ old('body') }}</textarea>
                @error('body') <p class="alert--error"> {{ $message }} </p> @enderror

            </div>

            <div class="form__group">
                <label for="is_published" class="form__label">Статус</label>
                <input type="checkbox" name="is_published" />
            </div>

            <div class="form__actions">
                <a href="{{ route('admin.posts.index') }}" class="btn btn--secondary">Отмена</a>
                <button type="submit" class="btn btn--primary">Создать</button>
            </div>
        </form>
    </div>
@endsection
