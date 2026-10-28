@extends('layouts.app')

@section('title', 'Блог на Laravel')

@section('content')
    <h1 class="page-title">Блог</h1>

    <form action="{{ route('blog.index') }}" method="GET" style="display: flex; gap: 10px; margin-top: 20px; margin-bottom: 30px; max-width: 500px; align-items: center;">

        <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по названию или тексту..." class="form__input" style="margin-bottom: 0; height: 42px; padding: 0 15px; flex: 1;">

        <button type="submit" class="btn btn--primary">Найти</button>

        @if(request('q'))
            <a href="{{ route('blog.index') }}" class="btn btn--secondary">Сбросить</a>
        @endif
    </form>

    @foreach($posts as $post)
        <article class="panel">
            @if ($post->image)
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
            @endif
            <h2 style="margin-top: 0; font-size: 24px;">
                 {{ $post->title }}
            </h2>
            <div class="muted" style="margin-bottom: 12px;">
                <p>{{ $post->published_at?->format('d.m.Y')}}</p>
                <p>{{ $post->is_published ? 'Опубликовано' : 'Черновик' }}</p>
            </div>

            <div class="post-excerpt">
                <p>{{ $post->excerpt }}</p>
            </div>

            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn--primary" >Читать далее</a>
        </article>
    @endforeach

    @if ($posts->hasPages())
        {{ $posts->onEachSide(1) -> links('pagination.custom') }}
    @endif
@endsection
