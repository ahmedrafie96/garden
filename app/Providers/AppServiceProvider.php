<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Gardner;
use App\Models\Media;
use App\Models\Purchase;
use App\Observers\CustomerObserver;
use App\Observers\GardnerObserver;
use App\Observers\MediaObserver;
use App\Observers\PurchaseObserver;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Customer::observe(CustomerObserver::class);
        Gardner::observe(GardnerObserver::class);
        Purchase::observe(PurchaseObserver::class);
        // Media::observe(MediaObserver::class);
    }
}
