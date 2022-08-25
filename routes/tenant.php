<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::group([
    'prefix' => '/{tenant}',
    'middleware' => [
        'web',
        \Stancl\Tenancy\Middleware\InitializeTenancyByPath::class,
//        \App\Http\Middleware\SetDefaultTenantForUrls::class
    ],
    'as' => 'tenant.',
], function () {
    Route::get('path', function (){
//        ray(app(\Illuminate\Contracts\Http\Kernel::class)->getMiddlewarePriority());
        return route('tenant.path2');
        return tenant()->getTenantKey();
    })->name('path');

    Route::get('path2', function (){

    })->name('path2');
});
