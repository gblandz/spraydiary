@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('global.greenhouse')</h3>
{!! Form::model($block, ['route' => ['admin.greenhouse.updateblock', $block->id]]) !!}

<div class="panel panel-default">
        <div class="panel-heading">
            <strong>Edit Block</strong>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('id', 'ID*', ['class' => 'control-label']) !!}
                    {!! Form::text('id', old('id'), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                    {!! Form::label('block_name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('block_name', old('block_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('block_name'))
                        <p class="help-block">
                            {{ $errors->first('block_name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop