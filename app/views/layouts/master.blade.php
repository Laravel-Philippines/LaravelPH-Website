<html>
    <body>
        @include('partials/top-nav')

        @if (Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif

        @yield('content')
    </body>
</html>