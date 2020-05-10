<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class checkrole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   if (Auth::check()){
            $username = Auth::user()->USERNAME;
            $result = DB::table('user')->join('role','role.ID','=','user.level')
            ->where([
                ['user.USERNAME','=',$username],
                ['user.STATUS','=',1]
            ])
            ->select('role.NAME as ROLE_NAME','user.ID','user.USERNAME','user.NAME','user.LEVEL','user.EMAIL','user.COUNT_LOGIN','user.STATUS')
            ->first();
            if ($result->ROLE_NAME=='ADMIN'){
                return $next($request);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
