<?php

namespace App\Http\Middleware;

use Closure;

class AccountType
{
    /**
     * Handle an incoming request and checks if the user has the required account type.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next, ...$account_types)
    {
        $user = $request->user();

        foreach ($account_types as $account_type) {
            if ($user->hasAccountType($account_type)) {
                return $next($request);
            }
        }

        return redirect()->back();
    }
}
