@extends('layouts.app')

@section('content')
@if (Auth::check())
     <h3 class="page-title">@lang('global.tasks.title')</h3>
        <p>
            <a href="{{ route('admin.tasks.create') }}" class="btn btn-success">Add new Task</a>
        </p>    
        <div class="panel panel-default">
            <div class="panel-heading">
            @lang('global.app_list')
            </div>
            <div class="panel-body table-responsive">    
                <table class="dataTable display compact cell-border">
                    <thead><tr>
                        <th>Name</th>
                        <th>Assigned User</th>
                        <th>Action</th>
                        </tr>
                    </thead>

                        <tbody>
                        @foreach($tasks as $task)
                        <tr>                 
                            <td>{{$task->description}}</td>
                            <td>{{$task->user->name}}</td>
                            <td>                                       
                                <a href="{{ route('admin.tasks.edit',[$task->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tasks.destroy', $task->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                            </td>
                        </tr>                     
                        @endforeach</tbody>
                </table>
            </div>
        </div>                
@else
    <h3>You need to log in. <a href="/login">Click here to login</a></h3>
@endif
               
@endsection