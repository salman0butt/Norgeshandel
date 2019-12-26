<?php
/**
 * Created by PhpStorm.
 * User: Dae
 * Date: 10/10/2019
 * Time: 5:59 PM
 */

namespace App\Helpers;


use Zizaco\Entrust\Middleware\EntrustPermission;
use Closure;

class CustomEntrustPermission extends EntrustPermission
{
    public function handle($request, Closure $next, $permissions)
    {
        if (!is_array($permissions)) {
            $permissions = explode(self::DELIMITER, $permissions);
        }

        if ($this->auth->guest() ) {
            return redirect('login');
//            abort(403);
        }
        if (!$request->user()->can($permissions)){
            return redirect('forbidden');
        }

        return $next($request);
    }
}