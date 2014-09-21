@if( $errors->has() )
    <p>We encountered the following errors:</p>
    <ul>
        @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif