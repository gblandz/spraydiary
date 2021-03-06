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
            <a class="btn btn-app" href="{{ url('admin/timekeeping') }}"><i class="fa fa-clock-o"></i> Timekeeping</a>
        </div>

        <div class="col-md-2 col-xs-4">
            <a class="btn btn-app" href="{{ url('admin/reports') }}"><i class="fa fa-folder-open"></i> Reports</a>
        </div>

        <div class="col-md-2 col-xs-4">
            <a class="btn btn-app" href="{{ url('admin/tasks') }}"><i class="fa fa-tasks"></i> Tasks</a>
        </div>

        <div class="col-md-2 col-xs-4">
            <a class="btn btn-app" href="{{ url('admin/chemicals') }}"><i class="fa fa-flask"></i> Chemicals</a>
        </div>

        <div class="col-md-2 col-xs-4">
            <a class="btn btn-app" href="{{ url('admin/greenhouse') }}"><i class="fa fa-th-large"></i> Greenhouse</a>
        </div>

        <div class="col-md-2 col-xs-4">
            <a class="btn btn-app" href="{{ url('admin/users') }}"><i class="fa fa-users"></i> Users</a>
        </div>
    </div>
</div>

<!-- <div class="row">
    <div class="col-md-6">
    <div class="box box-warning">
    <div class="box-header with-border">
        <h4>Task Progress:</h4>
        <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar"
          aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
            40%
          </div>
        </div>
    </div>
    </div>
    </div>


    <div class="col-md-6">
    </div>   

</div> -->
@endsection
