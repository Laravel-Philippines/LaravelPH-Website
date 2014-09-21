<?php namespace Tests\Unit\LaravelPH\User\Controllers;

use TestCase;
use User;
use Hash;

class UserControllerTest extends TestCase
{
    public function testCreateShouldRespondWithOk()
    {
        $crawler = $this->client->request('GET', route('users.create'));
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testStoreShouldBeAbleToSuccessfullyCreateAUser()
    {
        $inputs = [
            'username' => 'johndoe25',
            'password' => 'dummypassword',
            'password_confirmation' => 'dummypassword',
            'email' => 'johndoe25@gmail.com'
        ];

        $response = $this->call('POST', route('users.store', $inputs));
        $this->assertRedirectedToRoute('users.create');
        $user = User::where('email', '=', $inputs['email'])->first();
        $this->assertNotNull($user);
        $this->assertTrue((Hash::check($inputs['password'], $user->password)));
    }

    public function testStoreShouldNotCreateAUserOnInvalidInput()
    {
        $inputs = [];
        $response = $this->call('POST', route('users.store', $inputs));
        $users = User::all();
        $this->assertEmpty($users);
    }

    public function testStoreShouldReturnErrorsOnInvalidInput()
    {
        $inputs = [];
        $response = $this->call('POST', route('users.store', $inputs));
        $this->assertSessionHas('errors');
    }

    public function testStoreShouldRedirectBackOnRegistrationPageOnInvalidInput()
    {
        $inputs = [];
        $response = $this->call('POST', route('users.store', $inputs));
        $this->assertRedirectedToRoute('users.create');
    }


}