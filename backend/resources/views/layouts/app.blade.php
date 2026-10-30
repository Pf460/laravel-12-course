<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Блог')</title>
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

        .topbar {
            background: var(--panel);
            border-bottom: 1px solid var(--border);
            padding: 18px 28px;
        }

        .topbar__inner {
            max-width: 1024px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar__logo {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            text-decoration: none;
        }
        .topbar__logo:hover { text-decoration: none; }

        .topbar__nav {
            display: flex;
            gap: 24px;
            font-size: 14px;
        }

        .topbar__nav a {
            color: var(--muted);
            font-weight: 500;
        }
        .topbar__nav a:hover {
            color: var(--text);
            text-decoration: none;
        }

        .main-content {
            max-width: 1024px;
            margin: 0 auto;
            padding: 40px 28px;
        }

        .page-title {
            font-size: 36px;
            font-weight: 700;
            margin: 0 0 32px 0;
            color: var(--text);
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .muted { color: var(--muted); font-size: 14px; }

        .post-excerpt {
            margin: 18px 0;
            padding: 14px 16px;
            background: #f9fafb;
            border-left: 3px solid var(--primary);
            color: #374151;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 14px;
            border: 1px solid transparent;
            border-radius: 6px;
            font: inherit;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn--primary { background: var(--primary); color: #fff; }
        .btn--primary:hover { background: var(--primary-dark); text-decoration: none; }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar__inner">
            <a href="/" class="topbar__logo">Мой блог</a>
            <nav class="topbar__nav">
                <a href="/">Blog</a>
                <a href="#">Index</a>
            </nav>
        </div>
    </header>


    <main class="main-content">
        @yield('content')
    </main>
</body>
</html>
