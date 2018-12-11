<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthMiddleware
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
        //check()验证是否登录后台  auth('admin') 权限认证调用我们自定义守卫
        if ( !auth('admin')->check() ) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
