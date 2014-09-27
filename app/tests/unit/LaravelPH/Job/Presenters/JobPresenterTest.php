<?php namespace Tests\Unit\LaravelPH\Job\Presenters;

use GrahamCampbell\Markdown\Markdown;
use ParsedownExtra;

use TestCase;
use LaravelPH\Job\Presenters\JobPresenter;
use Job;

class JobPresenterTest extends TestCase
{
    public function testPresentDescriptionParsesDescriptionToMarkdown()
    {
        $this->createUser();

        $job = new Job;
        $job->title = 'php dev';
        $job->description = 'should be familiar with Laravel';
        $job->user_id = $this->user->id;
        $job->save();

        $decoratedJob = new JobPresenter(Job::first(), new Markdown(new ParsedownExtra));

        $markdown = new Markdown(new ParsedownExtra);
        $expected = $markdown->render($job->description);

        $this->assertEquals($expected, $decoratedJob->description);
    }

}