<?php
/**
 * Created by PhpStorm.
 * User: Dae
 * Date: 10/10/2019
 * Time: 6:02 PM
 */

namespace App\Helpers;


use Zizaco\Entrust\Middleware\EntrustAbility;
use Closure;

class CustomEntrustAbility extends EntrustAbility
{
    public function handle($request, Closure $next, $roles, $permissions, $validateAll = false)
    {
        if (!is_array($roles)) {
            $roles = explode(self::DELIMITER, $roles);
        }

        if (!is_array($permissions)) {
            $permissions = explode(self::DELIMITER, $permissions);
        }

        if (!is_bool($validateAll)) {
            $validateAll = filter_var($validateAll, FILTER_VALIDATE_BOOLEAN);
        }

        if ($this->auth->guest()) {
            return redirect('login');
        }
        if ( !$request->user()->ability($roles, $permissions, [ 'validate_all' => $validateAll ])){
            return redirect('forbidden');
        }

        return $next($request);
    }
}