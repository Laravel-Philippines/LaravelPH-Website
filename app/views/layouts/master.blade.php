<html>
    <body>
        @if (Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif

        @yield('content')
    </body>
</html>