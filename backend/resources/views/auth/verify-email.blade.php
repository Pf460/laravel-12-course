@extends('layouts.app') {{-- Укажите правильное имя вашего базового шаблона --}}

@section('title', 'Подтверждение Email')

@section('content')
    <div class="panel" style="max-width: 600px; margin: 40px auto;">

        <h1 class="page-title" style="font-size: 28px; margin-bottom: 16px;">
            Подтвердите ваш email
        </h1>

        <p class="muted" style="margin-bottom: 24px; font-size: 15px;">
            Прежде чем продолжить, пожалуйста, проверьте свою почту.
            Если письмо не пришло — вы можете отправить его ещё раз.
        </p>
        @if (session('message'))
            <div class="alert alert--success">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn--primary">
                Отправить письмо повторно
            </button>
        </form>

    </div>
@endsection
