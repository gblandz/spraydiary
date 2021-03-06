@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.chemicals.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.chemicals.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
					{!! Form::label('chem_type', 'Chemical Type*', ['class' => 'control-label']) !!}
                    {!! Form::select('chem_type', $chemSelect, null, ['class' => 'form-control', 'placeholder' => 'Select Chemical Type', 'required' => '']) !!}
                    {!! Form::label('trade_name', 'Trade Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('trade_name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                     {!! Form::label('components', 'Components*', ['class' => 'control-label']) !!}
                    {!! Form::text('components', old('components'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('withhold_period', 'Withhold period*', ['class' => 'control-label']) !!}
                    {!! Form::text('withhold_period', old('withhold_period'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('rates', 'Rates*', ['class' => 'control-label']) !!}
                    {!! Form::text('rates', old('rates'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                      {!! Form::label('pest_disease', 'Pest / Disease*', ['class' => 'control-label']) !!}
                    {!! Form::text('pest_disease', old('pest_disease'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

