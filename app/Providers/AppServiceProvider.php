<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (!empty(env('ENABLE_QUERY_LOGGER'))) {
            DB::listen(function ($query) {
                $formatQuery = str_replace(array('?'), array('\'%s\''), $query->sql);
                $formatQuery = vsprintf($formatQuery, $query->bindings);

                // query time in milliseconds
                $loggerInfo = 'QUERY EXECUTED: ' . $formatQuery
                    . ' || TIME EXECUTED: ' . ($query->time / 1000) . 's'
                    . ' || DB CONNECTION: ' . $query->connectionName;

                Log::info($loggerInfo);
            });
        }
    }
}
