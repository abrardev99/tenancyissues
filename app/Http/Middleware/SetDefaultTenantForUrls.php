<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Stancl\Tenancy\Events\InitializingTenancy;
use Stancl\Tenancy\Resolvers\PathTenantResolver;

class SetDefaultTenantForUrls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Event::listen(InitializingTenancy::class, function (InitializingTenancy $event) {
            URL::defaults([PathTenantResolver::$tenantParameterName => tenant()->getTenantKey()]);
        });
        URL::defaults([PathTenantResolver::$tenantParameterName => tenant()->getTenantKey()]);

        return $next($request);
    }
}
