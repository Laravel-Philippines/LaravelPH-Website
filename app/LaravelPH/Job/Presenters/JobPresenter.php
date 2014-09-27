<?php namespace LaravelPH\Job\Presenters;

use Robbo\Presenter\Presenter;
use GrahamCampbell\Markdown\Markdown;

use Job;

class JobPresenter extends Presenter
{
    protected $markdown;

    public function __construct(Job $job, Markdown $markdown)
    {
        parent::__construct($job);
        $this->markdown = $markdown;
    }

    public function presentDescription()
    {
        return $this->markdown->render(e($this->object->description));
    }
}