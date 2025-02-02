<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class WelcomePageVisitsAmountMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $key = 'welcome_page_visits_amount_' . config('app.env');

        if (Redis::get($key) === null) {
            Redis::set($key, 0);
        }

        Redis::set($key, Redis::get($key) + 1);

        return $next($request);
    }
}
