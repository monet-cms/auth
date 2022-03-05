<?php

namespace Monet\Framework\Auth\Http\Controllers;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show()
    {
        return view('monet.auth::login');
    }

    public function store(Request $request)
    {
        $this->checkRateLimiter($request);

        $inputs = $this->validate($request, [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        if (!Auth::attempt($inputs, $request->boolean('remember'))) {
            RateLimiter::hit($this->getThrottleKey($request));

            throw ValidationException::withMessages([
                'email' => __('auth.failed')
            ]);
        }

        RateLimiter::clear($this->getThrottleKey($request));

        $request->session()->regenerate();

        return redirect()->intended();
    }

    protected function checkRateLimiter(Request $request): void
    {
        $key = $this->getThrottleKey($request);

        if (!RateLimiter::tooManyAttempts($key, 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60)
            ])
        ]);
    }

    protected function getThrottleKey(Request $request): string
    {
        return Str::lower('auth.' . $request->ip());
    }
}