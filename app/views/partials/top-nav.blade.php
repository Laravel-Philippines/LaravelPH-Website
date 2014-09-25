<div>
    <ul>
        <li>
            <a class="{{ Request::is('/') ? 'active' : null }}" href="{{ route('laravelph.showHomePage') }}">Home</a>
        </li>
        <li>
            <a class="{{ Request::is('jobs*') ? 'active' : null }}" href="{{ route('jobs.index') }}">Jobs</a>
        </li>
        @if(Auth::check())
            <li>
                {{ Form::open(array('route' => array('sessions.destroy'), 'method' => 'delete')) }}
                    <button type="submit">Sign out</button>
                {{ Form::close() }}
            </li>
        @else
            <li>
                <a href="{{ route('sessions.create') }}">Sign In</a>
            </li>
            <li>
                <a href="{{ route('users.create') }}">Sign Up</a>
            </li>
        @endif
    </ul>
</div>