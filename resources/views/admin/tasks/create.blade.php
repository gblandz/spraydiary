@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.tasks.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.tasks.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('user_id', 'Assign User*', ['class' => 'control-label']) !!}
                    {!! Form::select('id', $userSelect, null, ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

