@extends('layouts.app')

@section('content')

<h3>Greenhouse</h3>
<div class="row">
	<div class="col-md-6">
    <div class="box box-primary">
    <div class="box-header with-border">
		{!! Form::open(['method' => 'POST', 'route' => ['admin.greenhouse.storeblock'], 'class' => 'form-inline']) !!}
		<div class="form-group">
		    {!! Form::label('block_name', 'Add Block:', ['class' => 'control-label']) !!}
		    {!! Form::text('block_name', old('block_name'), ['class' => 'form-control', 'placeholder' => 'Enter block name here', 'required' => '']) !!}
		  	{!! Form::submit(trans('global.app_add'), ['class' => 'btn btn-success']) !!}
    	{!! Form::close() !!}
		</div>
	</div>
	</div>

		<div class="panel panel-default">
        <div class="panel-heading">Blocks:</div>
		<div class="panel-body table-responsive">
		<table class="dataTable display compact">
		    <thead>
		        <tr>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    
		    <tbody>
		    	@foreach ($blocks as $block)
	                <tr>
	                    <td> {{$block->id}} </td>
	                    <td> {{$block->block_name}} </td>
	                    <td></td>
	                </tr>
	            @endforeach
		    </tbody>
		</table>
		</div>
		</div>

 	</div>
 	<div class="col-md-6">
 	<div class="box box-primary">
    <div class="box-header with-border">
    	{!! Form::open(['method' => 'POST', 'route' => ['admin.greenhouse.storeshed'], 'class' => 'form-inline']) !!}
		<div class="form-group">
		    {!! Form::label('shed_name', 'Add Shed:', ['class' => 'control-label']) !!}
		    {!! Form::text('shed_name', old('shed_name'), ['class' => 'form-control', 'placeholder' => 'Enter shed name here', 'required' => '']) !!}
		  	{!! Form::submit(trans('global.app_add'), ['class' => 'btn btn-success']) !!}
    	{!! Form::close() !!}	
		</div>	
 	</div>
 	</div>

 		<div class="panel panel-default">
        <div class="panel-heading">Sheds:</div>
		<div class="panel-body table-responsive">
		<table class="dataTable display compact">
		    <thead>
		        <tr>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    
		    <tbody>
		    	@foreach ($sheds as $shed)
	                <tr>
	                    <td>{{ $shed->id }}</td>
	                    <td>{{ $shed->shed_name }}</td>
	                    <td></td>
	                </tr>
	            @endforeach
		    </tbody>
		</table>
		</div>
		</div>

 	</div>
</div>

@endsection