@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('global.greenhouse')</h3>
{!! Form::model($shed, ['method' => 'put', 'route' => ['admin.greenhouse.update', $shed->id]]) !!}

<div class="panel panel-default">
        <div class="panel-heading">
            <strong>Edit Shed</strong>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id', 'ID*', ['class' => 'control-label']) !!}
                    {!! Form::text('id', old('id'), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                    {!! Form::label('shed_name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('shed_name', old('shed_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('shed_name'))
                        <p class="help-block">
                            {{ $errors->first('shed_name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop