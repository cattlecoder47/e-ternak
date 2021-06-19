<?php

namespace App\Http\Middleware;

use App\Helpers\Utility;
use App\Models\Sys_userlog;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AccessMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $route = request()->route()->uri();
        if (strtoupper(getOption('log_akses_menu')) == 'YA') {
            if (Session::has(env('SESSION_NAME'))) {
                Sys_userlog::create([
                    'sysuser_id'           => Utility::getSession('sysuser_id'),
                    'rtypelog_kode'        => env('TYPELOG_AKSESMENU'),
                    'sysuser_logdesk'      => 'User ' . Utility::getSession('sysuser_id') . ' melakukan akses ' . $route,
                    'sysuser_logcreate_at' => Carbon::parse(now())->format('Y-m-d H:m:s')
                ]);
            }
        }
        return $next($request);
    }
}
