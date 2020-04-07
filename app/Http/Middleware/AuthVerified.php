<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthVerified
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
        if (!Auth::check()){
            DB::table('metas')->where('key', $request->session()->token())->delete();
            DB::table('metas')->insert([
                'key'=>$request->session()->token(),
                'value'=>$request->url(),
                'metable_type'=>'Temp',
                'metable_id'=>0,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
//        if (
//            (Auth::check() && Auth::user()->hasVerifiedEmail()) ||
//            !Auth::check()
//        ){
            return $next($request);
//        }
//        else{
//            return redirect('email/verify');
//        }
    }
}
