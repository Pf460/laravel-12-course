<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Service\interfaces\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(private readonly AuthServiceInterface $auth){}

    public function loginShow() : View
    {
        return view('auth.login');
    }

    public function signUpShow() : View
    {
        return view('auth.signup');
    }

    public function signUp(SignUpRequest $request) : RedirectResponse
    {
        $this->auth->signUp($request->validated());

        $this->auth->attemptLogin($request->email, $request->password);

        $request->session()->regenerate();

        return redirect()->route('admin.posts.index');
    }

    public function login(LoginRequest $request) : RedirectResponse
    {
        $valid = $request->validated();

        if(!$this->auth->attemptLogin($valid['email'], $valid['password'], (bool)($valid['remember_me'] ?? false)))
        {
            return back()->withErrors(['email' => 'Неверный логин или пароль'])->onlyInput('email');
        }
        $request->session()->regenerate();

        return redirect()->intended(route('admin.posts.index'))->with('status', 'С возвращением');
    }

    public function logout() : RedirectResponse
    {
        $this->auth->logout();

        return redirect()->route('login')->with('status', 'Вы вышли из аккаунта');
    }
}
