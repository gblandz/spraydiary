@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.chemicals.title')</h3>
    <p>
        <a href="{{ route('admin.chemicals.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="compact table table-bordered table-striped {{ count($chemicals) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.chemicals.fields.id')</th>
                        <th>@lang('global.chemicals.fields.trade_name')</th>
                        <th>@lang('global.chemicals.fields.components')</th>
                        <th>@lang('global.chemicals.fields.rates')</th>
                        <th>@lang('global.chemicals.fields.pest_disease')</th>
                        <th>@lang('global.chemicals.fields.withhold_period')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($chemicals) > 0)
                        @foreach ($chemicals as $chemical)
                            <tr data-entry-id="{{ $chemical->id }}">
                                <td></td>
                                <td>{{ $chemical->id }}</td>
                                <td>{{ $chemical->trade_name }}</td>
                                <td>{{ $chemical->components }}</td>
                                <td>{{ $chemical->rates }}</td>
                                <td>{{ $chemical->pest_disease }}</td>
                                <td>{{ $chemical->withhold_period }}</td>
                                <td>
                                    <a href="{{ route('admin.chemicals.edit',[$chemical->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.chemicals.destroy', $chemical->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
              
            </table>
        </div>
    </div>
@stop


