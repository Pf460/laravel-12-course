@extends('layouts.app')

@section('title', 'Забыли пароль в Блог на Laravel')

@section('content')
        <div style="max-width: 400px; margin: 40px auto 0;">
            <h1 class="page-title" style="text-align: center; font-size: 28px;">Восстановление пароля</h1>

            <div class="panel">
                <p class="muted" style="margin-top: 0; margin-bottom: 20px; text-align: center; font-size: 14px;">
                    Забыли пароль? Введите свой Email, и мы отправим вам ссылку для сброса пароля.
                </p>

                @if (session('status'))
                    <div style="color: #166534; background: #dcfce7; padding: 10px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div style="margin-bottom: 24px;">
                        <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 6px; font: inherit; font-size: 14px;">
                        @error('email')
                        <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn--primary" style="width: 100%;">
                        Отправить ссылку
                    </button>
                </form>
            </div>

            <div style="text-align: center; margin-top: 20px; font-size: 14px;">
                <span class="muted">Вспомнили пароль?</span>
                <a href="{{ route('login') }}">Войти</a>
            </div>
        </div>
@endsection
