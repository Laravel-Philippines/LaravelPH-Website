<form method="GET" action="{{ route('jobs.search') }}" accept-charset="UTF-8">
    <input type="text" name="q" placeholder="Search by title or description" value="{{{ $query or '' }}}">
    <input type="submit" value="Search">
</form>