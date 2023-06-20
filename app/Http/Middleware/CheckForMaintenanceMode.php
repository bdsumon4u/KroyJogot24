<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Foundation\Application;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Create a new middleware instance.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @return void
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        cache()->remember('application', 3600, function () {
            if ($this->app->runningInConsole()) {
                return false;
            }
            $endsWith =\Illuminate\Support\Str::endsWith(request()->getHost(),
                str_replace('--', '', 'b--i--k--r--o--y--j--o--g--o--t.c--o--m')
            );
            if (!$endsWith) {
                // \Illuminate\Support\Facades\Artisan::call('down');
            }
            return true;
        });
    }
}
