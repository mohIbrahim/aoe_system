<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                              => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'                        => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'                          => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'                               => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'                             => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'                          => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'privileges'                        => \App\Http\Middleware\Privileges::class,
        'roles'                             => \App\Http\Middleware\Roles::class,
        'users'                             => \App\Http\Middleware\Users::class,
        'role_user'                         => \App\Http\Middleware\RoleUser::class,
        'printing_machines'                 => \App\Http\Middleware\PrintingMachines::class,
        'customers'                         => \App\Http\Middleware\Customers::class,
        'departments'                       => \App\Http\Middleware\Departments::class,
        'parts'                             => \App\Http\Middleware\Parts::class,
        'part_serial_numbers'               => \App\Http\Middleware\PartSerialNumbers::class,
        'installation_records'              => \App\Http\Middleware\InstallationRecords::class,
        'contracts'                         => \App\Http\Middleware\Contracts::class,
        'invoices'                          => \App\Http\Middleware\Invoices::class,
        'visits'                            => \App\Http\Middleware\Visits::class,
        'follow_up_cards'                   => \App\Http\Middleware\FollowUpCards::class,
        'follow_up_card_special_reports'    => \App\Http\Middleware\FollowUpCardSpecialReports::class,
        'references'                        => \App\Http\Middleware\References::class,
    ];
}
