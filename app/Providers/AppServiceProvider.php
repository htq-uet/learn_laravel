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
        if (env('ENABLE_QUERY_LOGGER')) {
            DB::listen(function ($query) {
                $formatQuery = str_replace(array('?'), array('\'%s\''), $query->sql);
                $formatQuery = strtoupper(vsprintf($formatQuery, $query->bindings));

                // Get the caller's file and line
                $trace = debug_backtrace();
                $caller = array_shift($trace);

                // Query time in milliseconds
                $loggerInfo = 'QUERY EXECUTED: ' . $formatQuery
                    . ' || TIME EXECUTED: ' . ($query->time / 1000) . 's'
                    . ' || DB CONNECTION: ' . $query->connectionName
                    . ' || FILE: ' . ($caller['file'] ?? 'Unknown')
                    . ' || LINE: ' . ($caller['line'] ?? 'Unknown');

                Log::info($loggerInfo);
            });
        }

    }
}
