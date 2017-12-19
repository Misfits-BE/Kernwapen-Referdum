<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class RobotsMiddleware extends \Spatie\RobotsMiddleware\RobotsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function shouldIndex(Request $request): bool
    {
        return $request->segment(1) !== 'admin'
            || $request->segment(1) !== 'login'
            || $request->segment(1) !== 'logout'
            || $request->segment(1) !== 'home'
            || $request->segment(1) !== 'password';
    }
}
