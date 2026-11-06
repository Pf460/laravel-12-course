@extends('layouts.app')

@section('title', 'Сброс пароля в Блог на Laravel')

@section('content')
    <div style="max-width: 400px; margin: 40px auto 0;">
        <h1 class="page-title" style="text-align: center; font-size: 28px;">Сброс пароля</h1>

        <div class="panel">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">

                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', request('email')) }}" required readonly>
                    @error('email')
                    <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;">Новый пароль</label>
                    <input id="password" type="password" name="password" required autofocus
                           style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 6px; font: inherit; font-size: 14px;">
                    @error('password')
                    <span style="color: var(--danger); font-size: 13px; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="password_confirmation" style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;">Повторите пароль</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           style="width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 6px; font: inherit; font-size: 14px;">
                </div>

                <button type="submit" class="btn btn--primary" style="width: 100%;">
                    Сбросить пароль
                </button>
            </form>
        </div>
    </div>
@endsection
