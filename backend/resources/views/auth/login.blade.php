@extends('layouts.app')

@section('title', 'Авторизация в блог на Laravel')

@section('content')
    <div style="max-width: 400px; margin: 40px auto 0;">
        <h1 class="page-title" style="text-align: center; font-size: 28px;">Вход в систему</h1>

        <div class="panel">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 6px; font: inherit; font-size: 14px;">
                    @error('email')
                    <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;">Пароль</label>
                    <input id="password" type="password" name="password" required
                           style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 6px; font: inherit; font-size: 14px;">
                    @error('password')
                    <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" name="remember" id="remember" style="cursor: pointer; width: 16px; height: 16px;">
                    <label for="remember" style="cursor: pointer; font-size: 14px; color: var(--muted);">Запомнить меня</label>
                </div>

                <button type="submit" class="btn btn--primary" style="width: 100%;">
                    Войти
                </button>
            </form>
        </div>
    </div>
@endsection
