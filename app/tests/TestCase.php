<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    protected $user;
    protected $rawPassword = 'dummypassword';

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown()
    {
    	Artisan::call('migrate:reset');
    }

    protected function createUser()
    {
        $user = new User;
        $user->username = 'johndoe25';
        $user->password = $this->rawPassword;
        $user->email = 'johndoe25@gmail.com';
        $user->save();
        $this->user = $user;
    }

    protected function createAndLoginUser()
    {
        $this->createUser();
        $this->be($this->user);
    }

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

}
