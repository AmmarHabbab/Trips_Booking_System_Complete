@extends('pages.master')

@section('content')

@if(count($trips) > 0)
<ul>
    @foreach($trips as $trip)
    <li>{{ $trip->name }}</li>
    @endforeach
</ul>
@else
<p>No results found</p>
@endif

@endsection