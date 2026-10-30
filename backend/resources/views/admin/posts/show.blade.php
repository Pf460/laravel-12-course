@extends('admin.layouts.app')

@section('title', 'Просмотр поста')

@section('content')
    <div class="panel" style="max-width: 800px; margin: 0 auto;">

        <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--border);">
            <h1 class="panel__title" style="margin-bottom: 8px;">{{ $post->title }}</h1>
            <div class="muted" style="display: flex; align-items: center; gap: 10px; font-size: 13px;">
                <span>{{ $post->is_published ? 'Опубликован' : 'Не опубликован'}}</span>
                <span>•</span>
                <time datetime="2025-10-31">{{ $post->published_at?->format('d.m.Y') }}</time>
            </div>
        </div>

        <div class="post-excerpt" style="margin-top: 0; margin-bottom: 24px;">
            <h2 class="panel__title" style="font-size: 18px; margin-bottom: 8px;">Описание</h2>
            <p style="margin: 0;">{{ $post->excerpt }}</p>
        </div>

        <div class="post-body" style="margin-top: 0;">
            <h2 class="panel__title" style="font-size: 18px; margin-bottom: 12px;">Контент</h2>
            <p style="margin: 0;">{!! $post->body !!}</p>
        </div>
    </div>
@endsection
