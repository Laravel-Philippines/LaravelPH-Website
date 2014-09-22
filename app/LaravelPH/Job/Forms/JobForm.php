<?php namespace LaravelPH\Job\Forms;

use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Auth\AuthManager;

use Job;

class JobForm
{
    protected $rules = [
        'title' => 'required',
        'description' => 'required',
    ];

    protected $validatorFactory;
    protected $auth;
    protected $job;

    public function __construct(ValidatorFactory $validatorFactory,
                                AuthManager $auth,
                                Job $job)
    {
        $this->validatorFactory = $validatorFactory;
        $this->auth = $auth;
        $this->job = $job;
    }

    public function create(array $input)
    {
        if ( ! $this->validate($input)) {
            return false;
        }

        $this->job->title = $input['title'];
        $this->job->description = $input['description'];
        $this->job->user_id = $this->auth->user()->id;
        return $this->job->save();
    }

    public function validate($data)
    {
        $this->validator = $this->validatorFactory->make($data, $this->rules);
        return $this->validator->passes();
    }

    public function errors()
    {
        return $this->validator->errors();
    }
}