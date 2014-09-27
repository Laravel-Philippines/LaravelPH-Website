<?php namespace LaravelPH\Job\Controllers;

use Illuminate\View\Factory as ViewFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

use GrahamCampbell\Markdown\Markdown;

use BaseController;
use LaravelPH\Job\Forms\JobForm;
use LaravelPH\Job\Presenters\Factories\JobPresenterFactory;
use Job;

class JobController extends BaseController {

    protected $view;
    protected $input;
    protected $redirect;
    protected $form;
    protected $job;
    protected $jobPresenterFactory;

    public function __construct(ViewFactory $view,
                                Request $input,
                                Redirector $redirect,
                                JobForm $form,
                                Job $job,
                                JobPresenterFactory $jobPresenterFactory)
    {
        $this->beforeFilter('auth', ['only' => ['create', 'store']]);

        $this->view = $view;
        $this->input = $input;
        $this->redirect = $redirect;
        $this->form = $form;
        $this->job = $job;
        $this->jobPresenterFactory = $jobPresenterFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view->make('Job::job.list')
            ->with('jobs', $this->job->getAllPublishedPaginated());
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
            return $this->redirect->route('jobs.index')
                ->with('message', 'Job successfully posted');
        }

        return $this->redirect->route('jobs.create')
            ->withInput()
            ->withErrors($this->form->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $job = $this->job->findPublishedByIdOrFail($id);
        $job = $this->jobPresenterFactory->make($job);
        return $this->view->make('Job::job.detail')
            ->with('job', $job);
    }

    public function search()
    {
        $query = $this->input->get('q');
        $jobs = $this->job->getByQueryPaginated($query);
        return $this->view->make('Job::job.search', compact('jobs', 'query'));
    }

}
