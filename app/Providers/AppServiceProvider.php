<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Schema::defaultStringLength(191);
        Response::macro('download_csv', function ($content,$fileName) {
            $headers = [
                'Content-type'        => 'text/csv',
                'Content-Disposition' => 'attachment; filename='.$fileName,
            ];
            return \Response::make($content, 200, $headers);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
