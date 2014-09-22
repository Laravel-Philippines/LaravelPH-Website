<?php namespace LaravelPH\Job\Controllers;

use Illuminate\View\Factory as ViewFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

use BaseController;
use LaravelPH\Job\Forms\JobForm;

class JobController extends BaseController {

    protected $view;
    protected $input;
    protected $redirect;
    protected $form;

    public function __construct(ViewFactory $view,
                                Request $input,
                                Redirector $redirect,
                                JobForm $form)
    {
        $this->view = $view;
        $this->input = $input;
        $this->redirect = $redirect;
        $this->form = $form;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view->make('Job::job.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $params = array(
            'title' => $this->input->get('title'),
            'description' => $this->input->get('description')
        );

        if ($this->form->create($params)) {
            return 'Job created';
            // return $this->redirect->route('laravelph.showHomePage')
            //     ->with('message', 'Successfully logged-in');
        }

        return $this->redirect->route('jobs.create')
            ->withInput()
            ->withErrors($this->form->errors());
    }

}
