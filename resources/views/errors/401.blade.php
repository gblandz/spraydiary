@extends('layouts.app')

@section('content')

<h2>{{ $exception->getMessage() }}</h2>
<a href="{{ url('/') }}"><i class="fa fa-arrow-left"></i>
    <span class="title">Go Back</span>
</a>

@endsection