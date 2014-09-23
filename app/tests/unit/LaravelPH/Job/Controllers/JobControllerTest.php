<?php namespace Tests\Unit\LaravelPH\User\Controllers;

use TestCase;
use Hash;

use Job;

class JobControllerTest extends TestCase
{
    public function testCreateShouldRespondWithOk()
    {
        $crawler = $this->client->request('GET', route('jobs.create'));
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testIndexShouldShowJobs()
    {
        $response = $this->call('GET', route('jobs.index'));
        $this->assertViewHas('jobs');
    }

    public function testShowShouldShowTheRequestedJob()
    {
        $this->createUser();
        $job = new Job;
        $job->title = 'php dev';
        $job->description = 'should be familiar w/ laravel';
        $job->user_id = $this->user->id;
        $job->save();

        $response = $this->call('GET', route('jobs.show', $job->id));
        $view = $response->original;
        $this->assertEquals($job->title, $view['job']->title);
    }

    public function testStoreShouldBeAbleToSuccessfullyCreateAJob()
    {
        $this->createUser();
        $this->be($this->user);

        $inputs = [
            'title' => 'php dev',
            'description' => 'should be familiar w/ laravel',
        ];

        $response = $this->call('POST', route('jobs.store', $inputs));

        $job = Job::first();
        $this->assertNotNull($job);
    }

    public function testStoreShouldNotCreateAJobOnInvalidInput()
    {
        $inputs = [];
        $response = $this->call('POST', route('jobs.store', $inputs));
        $jobs = Job::all();
        $this->assertEmpty($jobs);
    }

    public function testStoreShouldReturnErrorsOnInvalidInput()
    {
        $inputs = [];
        $response = $this->call('POST', route('jobs.store', $inputs));
        $this->assertSessionHas('errors');
    }

    public function testStoreShouldRedirectBackOnRegistrationPageOnInvalidInput()
    {
        $inputs = [];
        $response = $this->call('POST', route('jobs.store', $inputs));
        $this->assertRedirectedToRoute('jobs.create');
    }

}