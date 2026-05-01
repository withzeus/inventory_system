<?php

namespace App\Http\Controllers;

use App\Ctx\CreateUserContext;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthRepositoryInterface $authRepository
    ) {}

    public function getUser(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(RegisterRequest $request)
    {
        $context = CreateUserContext::fromArray(
            $request->validated()
        );
        $user = $this->authRepository->createUser($context);

        Auth::login($user);

        return redirect('/');
    }

    public function authenticate(AuthRequest $request)
    {
        $payload = $request->validated();

        if (Auth::attempt($payload)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
