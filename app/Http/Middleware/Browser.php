<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
class Browser
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
        $config = DB::table('configs')->where('id','1')->first();
        $except_ip_list = array(
            "140.122.109.160",
            // "127.0.0.1",
        );
        //網站沒開放或不在IP許可名單中
        if ($config->is_open == '0' && in_array($_SERVER['REMOTE_ADDR'], $except_ip_list) != true) {
            abort(403);
        }
        //使用IE任何版本瀏覽器
        if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) || preg_match('/(?i)windows nt 5.1/',$_SERVER['HTTP_USER_AGENT']) || preg_match('/Trident\/7.0; rv:11.0/i',$_SERVER['HTTP_USER_AGENT'])) {
            return redirect('errors/change_browser');
        }
        return $next($request);
    }
}
