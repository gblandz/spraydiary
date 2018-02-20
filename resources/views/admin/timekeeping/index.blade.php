@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.times.title')</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Duration</th>
                        <th>Task ID</th>
                    </tr>
                </thead>
                
                <tbody>
                         @foreach ($times as $time)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($time->created_at)) }} </td>
                                <td>{{ $time->start_time }}</td>
                                <td>{{ $time->end_time }}</td>
                                <td>{{ $time->duration }}</td>
                                <td>{{ $time->task_id }}</td>
                            </tr>
                        @endforeach
                  
                </tbody>
            </table>
        </div>
    </div>
@stop

