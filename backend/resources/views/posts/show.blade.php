@extends('layouts.app')

@section('title', 'Просмотр поста ' . $post->title)

@section('content')
    <div style="max-width: 800px; margin: 0 auto;">

        <div style="margin-bottom: 20px;">
            <a href="{{ route('blog.index') }}" class="btn btn--secondary">
                &larr; Ко всем постам
                {{-- &larr - сущность HTML которая выводит стрелку влево --}}
            </a>
        </div>

        <article class="panel">

            <p class="muted" style="text-transform: uppercase; letter-spacing: 0.05em; font-size: 12px; margin-top: 0;">
                Опубликовано: {{ ($post->published_at ?? $post->created_at)?->format('d.m.Y') }}
            </p>

            @if ($post->image)
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
            @endif

            <h1 class="panel__title" style="margin-bottom: 24px; font-size: 32px;">
                {{ $post->title }}
            </h1>

            <div class="post-body">
                {!! $post->body !!}
            </div>
        </article>
    </div>
@endsection
