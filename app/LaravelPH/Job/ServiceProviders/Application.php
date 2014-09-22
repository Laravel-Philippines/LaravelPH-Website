<?php namespace LaravelPH\Job\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use View;

class Application extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        View::addNamespace('Job', __DIR__.'/../Views/');
    }
}