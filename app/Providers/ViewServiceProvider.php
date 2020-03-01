<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Projects;
use App\Models\Skill;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('front.layouts.partials.portfolio', function ($view) {
            $view->with('projects', Projects::orderBy('id', 'desc')->get());
            $view->with('categories', Category::orderBy('id', 'desc')->get());
        });
        View::composer('front.pages.about', function ($view) {
            $view->with('skills', Skill::orderBy('id', 'desc')->get());
        });
    }
}
