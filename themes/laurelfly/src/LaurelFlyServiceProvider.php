<?php

namespace Caimari\LaraFlex\Themes\LaurelFly;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\View\FileViewFinder;

class LaurelFlyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laurelfly');
    }
}
