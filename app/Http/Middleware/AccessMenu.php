<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccessMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $action
     * @return mixed
     */
    public function handle($request, Closure $next, $action)
    {
        $user = Auth::user();

        if (!$user->can($action)) {
            if($request->ajax()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Forbidden',
                ], 403);
            } else {
                abort(403);
            }
        }

        return $next($request);
    }
}
