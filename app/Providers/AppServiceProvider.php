<?php

namespace App\Providers;

use App\Models\FrontendData;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (request()->is(['admin/*'])) {
            Inertia::setRootView('layouts.admin');
        }else{
            Inertia::setRootView('app');
        }

        View::composer(['welcome', 'app'], function ($view){
            $aboutUs = FrontendData::where('key', FrontendData::DataKeys['About Us'])->first();
            $contactUs = FrontendData::where('key', FrontendData::DataKeys['Contact us'])->first();
            $view->with('aboutUs', $aboutUs)
            ->with('contactUs', $contactUs);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Inertia::share('flash', function () {
            return [
                'success' => Session::get('success'),
                'error' => Session::get('error'),
            ];
        });
    }
}
