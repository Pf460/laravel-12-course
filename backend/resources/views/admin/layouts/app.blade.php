<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Админка') — Блог на Laravel</title>
    <style>
        :root {
            --bg: #f4f5f7;
            --panel: #ffffff;
            --border: #e5e7eb;
            --text: #111827;
            --muted: #6b7280;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --danger: #dc2626;
            --sidebar: #111827;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 15px;
            line-height: 1.5;
        }

        a { color: var(--primary); text-decoration: none; }
        a:hover { text-decoration: underline; }

        code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 13px;
        }

        .admin { display: flex; min-height: 100vh; }

        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: var(--sidebar);
            color: #e5e7eb;
            padding: 24px 0;
        }

        .sidebar__brand {
            padding: 0 22px 24px;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
        }

        .sidebar__brand span {
            display: block;
            margin-top: 2px;
            font-size: 11px;
            font-weight: 400;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .sidebar__nav { display: flex; flex-direction: column; gap: 2px; }

        .sidebar__link {
            padding: 10px 22px;
            color: #d1d5db;
            font-size: 14px;
        }

        .sidebar__link:hover {
            background: #1f2937;
            color: #fff;
            text-decoration: none;
        }

        .sidebar__link.is-active { background: var(--primary); color: #fff; }

        .main { flex: 1; min-width: 0; display: flex; flex-direction: column; }

        .topbar {
            background: var(--panel);
            border-bottom: 1px solid var(--border);
            padding: 18px 28px;
        }

        .topbar__title { margin: 0; font-size: 22px; }

        .content { padding: 28px; }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert ul { margin: 8px 0 0; padding-left: 20px; }
        .alert--success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert--error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        .page-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .page-head__text { margin: 0; color: var(--muted); }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 9px 14px;
            border: 1px solid transparent;
            border-radius: 6px;
            font: inherit;
            font-size: 14px;
            line-height: 1;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover { text-decoration: none; }
        .btn--primary { background: var(--primary); color: #fff; }
        .btn--primary:hover { background: var(--primary-dark); }
        .btn--secondary { background: #fff; border-color: #d1d5db; color: #374151; }
        .btn--secondary:hover { background: #f9fafb; }
        .btn--danger { background: var(--danger); color: #fff; }
        .btn--danger:hover { background: #b91c1c; }
        .btn--sm { padding: 6px 10px; font-size: 13px; }

        .table-wrap {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow-x: auto;
        }

        table { width: 100%; border-collapse: collapse; }

        th, td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            vertical-align: middle;
        }

        th {
            background: #f9fafb;
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        tr:last-child td { border-bottom: none; }

        .table-excerpt { margin-top: 3px; color: var(--muted); font-size: 13px; }
        .table-actions { display: flex; gap: 6px; flex-wrap: wrap; }

        .badge {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge--green { background: #dcfce7; color: #166534; }
        .badge--gray { background: #e5e7eb; color: #374151; }

        .empty { padding: 48px 20px; text-align: center; color: var(--muted); }

        .form { max-width: 780px; }
        .form__group { margin-bottom: 18px; }

        .form__label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 600;
        }

        .form__input,
        .form__textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font: inherit;
            background: #fff;
            color: var(--text);
        }

        .form__input:focus,
        .form__textarea:focus {
            outline: 2px solid #bfdbfe;
            outline-offset: 0;
            border-color: var(--primary);
        }

        .form__textarea { min-height: 120px; resize: vertical; }
        .form__hint { margin-top: 5px; color: var(--muted); font-size: 13px; }

        .form__check {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .form__actions {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 24px;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 24px;
        }

        .panel__title { margin: 0 0 8px; font-size: 26px; }
        .muted { color: var(--muted); font-size: 14px; }

        .post-excerpt {
            margin: 18px 0;
            padding: 14px 16px;
            background: #f9fafb;
            border-left: 3px solid var(--primary);
            color: #374151;
        }

        .post-body { margin-top: 20px; font-size: 16px; line-height: 1.7; }

        .admin-pagination { margin-top: 20px; }
        .admin-pagination nav { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }

        .admin-pagination nav a,
        .admin-pagination nav span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #374151;
            text-decoration: none;
            font-size: 14px;
        }

        .admin-pagination nav a:hover { background: #f3f4f6; }
    </style>
</head>
<body>
<div class="admin">
    <aside class="sidebar">
        <div class="sidebar__brand">
            Блог
            <span>Админка</span>
        </div>

        <nav class="sidebar__nav">
            <a href="{{ route('posts.index') }}"
               class="sidebar__link {{ request()->routeIs('posts.index', 'posts.show', 'posts.edit') ? 'is-active' : '' }}">
                Посты
            </a>
            <a href="{{ route('posts.create') }}"
               class="sidebar__link {{ request()->routeIs('posts.create') ? 'is-active' : '' }}">
                Добавить пост
            </a>
        </nav>
    </aside>

    <div class="main">
        <header class="topbar">
            <h1 class="topbar__title">@yield('title', 'Админка')</h1>
        </header>

        <main class="content">
            @if (session('success'))
                <div class="alert alert--success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert--error">
                    <strong>Проверьте форму:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
