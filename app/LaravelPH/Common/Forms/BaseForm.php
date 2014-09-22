<?php namespace LaravelPH\Common\Forms;

use Illuminate\Validation\Factory as ValidatorFactory;

abstract class BaseForm
{
    protected $validatorFactory;
    protected $validator;

    public function __construct(ValidatorFactory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
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