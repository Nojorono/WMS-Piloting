<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserAccessCreate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $menu_id )
    {
        if(!empty($menu_id)){
            if(
                $request->session()->get('user_access') === NULL ||
                !in_array($menu_id,$request->session()->get('user_access'))
            ){
                if ($request->expectsJson()) {
                    return response()->json([
                        "err" => true,
                        "message" => "You dont have access to this page. Please Contact Administrator, and Re-Login.",
                        "data" => [],
                    ],200);
                }
                return redirect(route('forbidden'));
            }

            if(
                $request->session()->get('user_create') === NULL ||
                $request->session()->get('user_create') == 0
            ){
                if ($request->expectsJson()) {
                    return response()->json([
                        "err" => true,
                        "message" => "You dont have access to this page. Please Contact Administrator, and Re-Login.",
                        "data" => [],
                    ],200);
                }
                return redirect(route('forbidden'));
            }
        }
        return $next($request);
    }

}
