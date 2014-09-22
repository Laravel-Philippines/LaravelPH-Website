<?php namespace LaravelPH\Session\Forms;

use Illuminate\Auth\AuthManager;

class SessionForm
{
    protected $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function create(array $inputs)
    {
        return $this->auth->attempt($inputs);
    }
}