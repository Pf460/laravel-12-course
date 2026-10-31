@extends('layouts.app')

@section('title', 'Регистрация в блоге на Laravel')

@section('content')
    <div style="max-width: 400px; margin: 40px auto 0;">
        <h1 class="page-title" style="text-align: center; font-size: 28px;">Регистрация</h1>

        <div class="panel">
            <form method="POST" action="{{ route('signup') }}">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;">Имя</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 6px; font: inherit; font-size: 14px;">
                    @error('name')
                    <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
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

                <div style="margin-bottom: 24px;">
                    <label for="password_confirmation" style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;">Повторите пароль</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 6px; font: inherit; font-size: 14px;">
                    @error('password_confirmation')
                    <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn--primary" style="width: 100%;">
                    Зарегистрироваться
                </button>
            </form>
        </div>

        <div style="text-align: center; margin-top: 20px; font-size: 14px;">
            <span class="muted">Уже есть аккаунт?</span>
            <a href="{{ route('login') }}">Войти</a>
        </div>
    </div>
@endsection
