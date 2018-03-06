@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
    <div class="alert alert-info text-center animated fadeIn">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            {!! session()->get('success') !!}
        </strong>
    </div>
    @endif

<div class="container-fluid" align="center">
<div class="row">
    <div class="col-md-2 col-xs-4">
<a class="btn btn-app"><i class="fa fa-clock-o"></i> Timekeeping</a>
</div>

<div class="col-md-2 col-xs-4">
<a class="btn btn-app"><i class="fa fa-folder-open"></i> Reports</a>
</div>

<div class="col-md-2 col-xs-4">
<a class="btn btn-app"><i class="fa fa-tasks"></i> Tasks</a>
</div>

<div class="col-md-2 col-xs-4">
<a class="btn btn-app"><i class="fa fa-flask"></i> Chemicals</a>
</div>

<div class="col-md-2 col-xs-4">
<a class="btn btn-app"><i class="fa fa-th-large"></i> Greenhouse</a>
</div>

<div class="col-md-2 col-xs-4">
<a class="btn btn-app"><i class="fa fa-users"></i> Users</a>
</div>

</div>
</div>
@endsection
