<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->user_type_id !== 2){
            return response()->json(['error' => ['message' => 'Unathorized!', 'status' => 401]],401);
        }
        return $next($request);
    }
}