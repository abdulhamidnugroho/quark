<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class VerifyIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->isAdmin())
        {
            // flash message
            session()->flash('error', 'You have to be an Admin to do this!');
            return redirect('/home');
        }
        return $next($request);
    }
}
