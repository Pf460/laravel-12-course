<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Блог на Laravel</title>
</head>
<body>
    <div>
        <h2>Блог на Laravel</h2>

        @foreach($posts as $post)
            <div>
                <h2>
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </h2>
                <p>
                    {{ $post->published_at?->format('d.m.Y') }}
                </p>
                <p>{{ Str::limit($post->excerpt, 150) }}</p>
                <a href="{{ route('posts.show', $post->slug) }}">Читать дальше</a>
            </div>
        @endforeach

        <div>
            {{ $posts->links() }}
        </div>
    </div>
</body>
</html>
