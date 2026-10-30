@if ($paginator->hasPages())
    <nav style="display: flex; gap: 6px; justify-content: center; margin-top: 30px; align-items: center;">

        {{-- Кнопка назад --}}
        @if ($paginator->onFirstPage())
            <span style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; color: #9ca3af; background: #fff;">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; color: var(--text); background: #fff; text-decoration: none;">&lsaquo;</a>
        @endif

        {{-- Номера страниц --}}
        @foreach ($elements as $element)
            {{-- Троеточие --}}
            @if (is_string($element))
                <span style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; color: var(--muted); background: #fff;">{{ $element }}</span>
            @endif

            {{-- Ссылки на страницы --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding: 8px 12px; border: 1px solid var(--primary); border-radius: 6px; background: var(--primary); color: #fff; font-weight: 600;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; color: var(--text); background: #fff; text-decoration: none;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Кнопка "Вперед" --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; color: var(--text); background: #fff; text-decoration: none;">&rsaquo;</a>
            {{-- &rsaquo - сущность HTML которая выводит стрелку вправо --}}
        @else
            <span style="padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; color: #9ca3af; background: #fff;">&rsaquo;</span>
        @endif
    </nav>
@endif
