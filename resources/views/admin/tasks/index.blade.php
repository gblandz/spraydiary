@extends('layouts.app')

@section('content')
@if (Auth::check())
        <h3>Tasks List</h3>
        <p>
            <a href="{{ url('admin/tasks/add') }}" class="btn btn-success">Add new Task</a>
        </p>    
        <div class="panel panel-default">
            <div class="panel-heading">
            @lang('global.app_list')
            </div>
            <div class="panel-body table-responsive">    
                <table class="table table-bordered table-stripe">
                    <thead><tr>
                        <th>Name</th>
                        <th>User</th>
                        <th>Created Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>

                        <tbody>
                        @foreach($user->tasks as $task)
                        <tr>
                            <td>{{$task->description}}</td>
                            <td>{{$task->user_id}}</td>
                            <td>{{$task->created_at}}</td>
                            <td>                                       
                                <form action="{{ url('admin/tasks') }}/{{$task->id}}">
                                    <button type="submit" name="edit" class="btn btn-xs btn-info">Edit</button>
                                    <button type="submit" name="delete" formmethod="POST" class="btn btn-xs btn-danger">Delete</button>
                                    {{ csrf_field() }}
                                </form>
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