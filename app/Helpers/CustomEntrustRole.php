<?php
/**
 * Created by PhpStorm.
 * User: Dae
 * Date: 10/10/2019
 * Time: 12:05 PM
 */

namespace App\Helpers;


use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\Middleware\EntrustRole;

class CustomEntrustRole extends EntrustRole
{
    public function handle($request, Closure $next, $roles)
    {
        if (!is_array($roles)) {
            $roles = explode(self::DELIMITER, $roles);
        }

        if ($this->auth->guest() ) {
//            dd($request->getPathInfo());
            session()->put('request', $request->getPathInfo());
            return redirect('login');
        }
        if (!$request->user()->hasRole($roles)){
            return redirect('forbidden');
        }

        return $next($request);
    }
}