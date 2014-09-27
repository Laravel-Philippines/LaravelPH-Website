<?php namespace Tests\Unit\LaravelPH\User\Controllers;

use Route;
use Event;

use TestCase;
use Job;

class JobControllerTest extends TestCase
{
    public function testCreateShouldRespondWithOk()
    {
        $crawler = $this->client->request('GET', route('jobs.create'));
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testCreateShouldRedirectToLoginPageIfUserIsNotAuthenticated()
    {
        Route::enableFilters();
        $crawler = $this->client->request('GET', route('jobs.create'));
        $this->assertRedirectedToRoute('sessions.create');
    }

    public function testIndexShouldShowPublishedJobs()
    {
        $this->createUser();
        $job = new Job;
        $job->title = 'php dev';
        $job->description = 'should be familiar w/ laravel';
        $job->user_id = $this->user->id;
        $job->status = 'published';
        $job->save();

        $response = $this->call('GET', route('jobs.index'));
        $view = $response->original;
        $this->assertEquals(1, $view['jobs']->count());
    }

    public function testIndexShouldNotShowJobsThatAreNotPublished()
    {
        $this->createUser();
        $job = new Job;
        $job->title = 'php dev';
        $job->description = 'should be familiar w/ laravel';
        $job->user_id = $this->user->id;
        $job->save();

        $response = $this->call('GET', route('jobs.index'));
        $view = $response->original;
        $this->assertEquals(0, $view['jobs']->count());
    }

    public function testShowShouldShowTheRequestedJob()
    {
        $this->createUser();
        $job = new Job;
        $job->title = 'php dev';
        $job->description = 'should be familiar w/ laravel';
        $job->user_id = $this->user->id;
        $job->status = 'published';
        $job->save();

        $response = $this->call('GET', route('jobs.show', $job->id));
        $view = $response->original;
        $this->assertEquals($job->title, $view['job']->title);
    }

    /**
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testShowShouldNotShowAJobThatIsNotPublished()
    {
        $this->createUser();
        $job = new Job;
        $job->title = 'php dev';
        $job->description = 'should be familiar w/ laravel';
        $job->user_id = $this->user->id;
        $job->save();

        $response = $this->call('GET', route('jobs.show', $job->id));
    }

    public function testShowShouldDecorateTheRequestedJob()
    {
        $this->createUser();
        $job = new Job;
        $job->title = 'php dev';
        $job->description = 'should be familiar w/ laravel';
        $job->user_id = $this->user->id;
        $job->status = 'published';
        $job->save();

        $response = $this->call('GET', route('jobs.show', $job->id));
        $view = $response->original;
        $this->assertNotInstanceOf('Job', $view['job']);
    }

    public function testStoreShouldRedirectToLoginPageIfUserIsNotAuthenticated()
    {
        Route::enableFilters();
        Event::forget('router.filter: csrf');
        $response = $this->call('POST', route('jobs.store', []));
        $this->assertRedirectedToRoute('sessions.create');
    }

    public function testStoreShouldBeAbleToSuccessfullyCreateAJob()
    {
        $this->createAndLoginUser();

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

    public function testStoreShouldRedirectBackToCreateAJobPageOnInvalidInput()
    {
        $inputs = [];
        $response = $this->call('POST', route('jobs.store', $inputs));
        $this->assertRedirectedToRoute('jobs.create');
    }

    public function testSearchShouldFilterJobs()
    {
        $this->createUser();
        $job = new Job;
        $job->title = 'laravel dev';
        $job->description = 'should be familiar w/ laravel';
        $job->user_id = $this->user->id;
        $job->status = 'published';
        $job->save();

        $job = new Job;
        $job->title = 'codeigniter dev';
        $job->description = 'should be familiar w/ codeigniter';
        $job->user_id = $this->user->id;
        $job->status = 'published';
        $job->save();


        $inputs = ['q' => 'laravel'];
        $response = $this->call('GET', route('jobs.search', $inputs));
        $view = $response->original;
        $this->assertEquals(1, $view['jobs']->count());
    }

    public function testSearchShouldPassQueryToTemplate()
    {
        $inputs = ['q' => 'laravel'];
        $response = $this->call('GET', route('jobs.search', $inputs));
        $view = $response->original;
        $this->assertEquals($inputs['q'], $view['query']);
    }

}