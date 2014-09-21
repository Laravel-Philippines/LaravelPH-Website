<?php namespace LaravelPH\LaravelPH\Controllers;

use Illuminate\View\Factory as ViewFactory;

use BaseController;

class LaravelPHController extends BaseController {

    protected $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    public function showHomePage()
    {
        return $this->view->make('LaravelPH::laravelph.home');
    }

}
