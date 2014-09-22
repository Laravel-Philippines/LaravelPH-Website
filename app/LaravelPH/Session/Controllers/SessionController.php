<?php namespace LaravelPH\Session\Controllers;

use Illuminate\View\Factory as ViewFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

use BaseController;
use LaravelPH\Session\Forms\SessionForm;

class SessionController extends BaseController {

    protected $view;
    protected $input;
    protected $redirect;
    protected $form;

    public function __construct(ViewFactory $view,
                                Request $input,
                                Redirector $redirect,
                                SessionForm $form)
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
        return $this->view->make('Session::session.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $params = array(
            'username' => $this->input->get('username'),
            'password' => $this->input->get('password')
        );

        if ($this->form->create($params)) {
            return $this->redirect->route('laravelph.showHomePage')
                ->with('message', 'Successfully logged-in');
        }

        return $this->redirect->route('sessions.create')
            ->withInput()
            ->with('message', 'Wrong username or password');
    }

}
