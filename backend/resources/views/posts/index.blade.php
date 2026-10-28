@extends('layouts.app')

@section('title', 'Блог на Laravel')

@section('content')
    <h1 class="page-title">Блог</h1>

    @foreach($posts as $post)
        <article class="panel">
            <h2 style="margin-top: 0; font-size: 24px;">
                <a href="#" style="color: var(--text);">{{ $post->title }}</a>
            </h2>
            <div class="muted" style="margin-bottom: 12px;">
                <p>{{ $post->published_at?->format('d.m.Y')}}</p>
                <p>.</p>
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
