<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Blade::directive('datetime', function ($expression) {
            return "<?php echo Carbon\Carbon::parse(${expression})->format('d-m-Y H:i'); ?>";
        });

        Blade::directive('date', function ($expression) {
            return "<?php echo Carbon\Carbon::parse(${expression})->format('d-m-Y'); ?>";
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
