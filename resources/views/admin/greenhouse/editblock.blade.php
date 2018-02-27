@extends('layouts.app')

@section('content')


<h3 class="page-title">@lang('global.tasks.title')</h3>
{!! Form::model($blocks, ['method' => 'put', 'route' => ['admin.greenhouse.update', $block->id]]) !!}

<div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('block_name', 'Block Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('block_name', old('block_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}


@stop