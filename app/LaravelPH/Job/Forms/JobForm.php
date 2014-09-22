<?php namespace LaravelPH\Job\Forms;

use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Auth\AuthManager;

use Job;
use LaravelPH\Common\Forms\BaseForm;

class JobForm extends BaseForm
{
    protected $rules = [
        'title' => 'required',
        'description' => 'required',
    ];

    protected $auth;
    protected $job;

    public function __construct(ValidatorFactory $validatorFactory,
                                AuthManager $auth,
                                Job $job)
    {
        parent::__construct($validatorFactory);
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

}