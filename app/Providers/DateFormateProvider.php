<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;


class DateFormateProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    function formatDate($date){
        return Carbon::parse($date)->format('d F Y');
    }
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function($views){
            $views->with('formatDate', function($date){
                return $this->formatDate($date);
            });
         });
    }
}
