<?php

namespace App\Providers;

use App\Models\Content\Comment;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('admin.layouts.header', function ($view){
            $view->with('unseenComments', Comment::where('seen', 0)->get());
        });
    }
}
