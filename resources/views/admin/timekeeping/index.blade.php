@extends('layouts.app')
@section('content')
    <h3 class="page-title">@lang('global.times.title')</h3>
    

<div class="row">

    <div class="col-md-8">
        <div class="box box-primary">
        <div class="box-header with-border">
            
            <p><strong>Select Details for Recording:</strong></p>

<!--
            {!! Form::open(['action' => 'TimesController@insertStartTime']) !!}
-->	
<!--
			<input type="text" name="token" id="token" value={{csrf_token()}} >
-->
            {!! Form::label('task_id', 'Select Task:', ['class' => 'control-label']) !!}
            {!! Form::select('task_id', $tasks, null, ['class' => 'form-control','id'=>'task_id']) !!}
            {!! Form::label('block_id', 'Select Block:', ['class' => 'control-label']) !!}
            {!! Form::select('block_id', $blocks, null, ['class' => 'form-control']) !!}
            {!! Form::label('shed_id', 'Select Sheds:', array('multiple'=>'multiple','class'=> 'control-label')) !!}
            {!! Form::select('sheds[]', $sheds, old('sheds'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'required' => 'required', 'id'=> 'sheds']) !!}
            {!! Form::label('chemical_id', 'Chemical Trade Name:', ['class' => 'control-label']) !!}
            {!! Form::text('trade_name[]', '', ['class' => 'form-control autocomplete_txt', 'placeholder'=> 'Input Chemical Name', 'type' => 'text', 'data-type' => 'trade_name', 'id' => 'trade_name_1', 'required'=> '']) !!}
            {!! Form::hidden('chemical_id', old('chemical_id'), array('id' => 'id_1')) !!}
            </br>
            <div class="col-md-3 col-xs-6">
            {!! Form::label('pest_disease', 'Pest Disease', ['class' => 'control-label']) !!}        
            {!! Form::text('pest_disease', '', ['class'=>'form-control','disabled', 'id' => 'pest_disease_1']) !!}
            </div>
            <div class="col-md-3 col-xs-6">
            {!! Form::label('components', 'Active Constituents', ['class' => 'control-label']) !!}        
            {!! Form::text('components', '', ['class'=>'form-control','disabled', 'id' => 'components_1']) !!}
            </div>
            <div class="col-md-3 col-xs-6">
            {!! Form::label('rates', 'Application Rate', ['class' => 'control-label']) !!}        
            {!! Form::text('rates', '', ['class'=>'form-control','disabled', 'id' => 'rates_1']) !!}
            </div>
            <div class="col-md-3 col-xs-6">
            {!! Form::label('withhold_period', 'With Hold Period', ['class' => 'control-label']) !!}        
            {!! Form::text('withhold_period', '', ['class'=>'form-control','disabled', 'id' => 'withhold_period_1']) !!}
            </div>
            <div class="col-md-3 col-xs-6">
            {!! Form::label('tank_capacity', 'Tank Capacity', ['class' => 'control-label']) !!}        
            {!! Form::select('tank_capacity', [
                '5' => '5', 
                '10' => '10', 
                '15' => '15', 
                '20' => '20', 
                '100' => '100',
                '200' => '200',
                '500' => '500',
                '1000' => '1000',
                '1500' => '1500',
                '2000' => '2000',
                ], null, ['placeholder' => 'Select Capacity...', 'class' => 'form-control', 'required' => '','id'=>'tank_capacity']) !!}
            </div>
            <div class="col-md-3 col-xs-6">
            {!! Form::label('total_liquid', 'Total Liquid', ['class' => 'control-label']) !!}        
            {!! Form::text('total_liquid', null, ['class'=>'form-control', 'required' => '', 'id' => 'liquidtotal']) !!}
            </div>
            <div class="col-md-3 col-xs-6">
            {!! Form::label('is_fruiting', 'Fruiting?', ['class' => 'control-label']) !!}        
            {{ Form::select('is_fruiting', ['Yes' => 'Yes', 'No' => 'No'], null, ['class' => 'form-control','id'=>'is_fruiting']) }}
            </div>
            <div class="col-md-3 col-xs-6">
            {!! Form::label('sprayed_by', 'Sprayed By:', ['class' => 'control-label']) !!}        
            {!! Form::text('sprayed_by', $user->name, ['class'=>'form-control', 'disabled','id'=>'sprayed_by']) !!}
        </br>
           
            </div>             
        </div>
        </div>
    </div>

<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
        <div style="text-align: center">
        <p> {{ date('jS \\of F Y,') }} <strong id="clock"></strong></p>        

            <span style="font-size: 11px">HH:MM:SS</span><br />
            <label id="hours">00</label>:<label id="minutes">00</label>:<label id="seconds">00</label>
            </br>
            <input type="hidden" name="startTimeContainer" id="startTimeContainer" value="{{$date}}"> 


<!--
            {{ Form::button('Start', array('class' => 'btn btn-success', 'type' => 'button', 'onclick' => 'startTimer()', 'id' => 'start_btn')) }}
-->

           <button type="button" class="btn btn btn-success" onclick="startTimer()" id="start_btn">Start</button>
<!--
            {{ Form::button('Stop', array('class' => 'btn btn-danger', 'type' => 'submit', 'onclick' => 'stopTimer()', 'id' => 'stop_btn')) }}
-->
            <input type="hidden" name="stopTimeContainer" id="stopTimeContainer" value=""> 
           <button type="button" class="btn btn btn-danger" onclick="stopTimer()" id="stop_btn">Stop</button>

            </br>
            <label id="totalTime">

            </label>
            {!! Form::close() !!}
        </div>

        </br>

        </div>
    </div>
    </br>

<!--Total Liquid autocomplete function-->
    

    <script type="text/javascript">
        $('#liquidtotal').autocomplete({
          source : '{!!URL::route('autoliquidtotal')!!}',
          minlenght:1,
          autoFocus:true,
          select:function(e,ui){
            var data = (ui);
          }
        });
    </script>


    <script type="text/javascript">

        var hoursLabel = document.getElementById("hours");
        var minutesLabel = document.getElementById("minutes");
        var secondsLabel = document.getElementById("seconds");
        var totalTime = document.getElementById("totalTime");
        var totalSeconds = 0;
        var totalMinutes = 0;
        var totalHours = 0;
        var counter;
        var timerOn;
        var htmlResets;
        var totalMills = 0; 

        function startTimer() {
            if (timerOn == 1) {
                return;
            }

            else {
                counter = setInterval(setTime, 10);
                timerOn = 1;
                htmlResets = 0;
            }
        }

        function stopTimer() {
            totalTime.innerHTML = "Time Recorded: " + hoursLabel.innerHTML + ":" + minutesLabel.innerHTML + ":" + secondsLabel.innerHTML;
            hoursLabel.innerHTML = "00";
            minutesLabel.innerHTML = "00";
            secondsLabel.innerHTML = "00";
            totalMills = 0;
            totalSeconds = 0;
            totalMinutes = 0;
            totalHours = 0;
            clearInterval(counter);
            timerOn = 0;
        }

        function setTime() {
            ++totalMills;
            if (totalHours == 99 & totalMinutes == 59 & totalSeconds == 60) {
                totalHours = 0;
                totalMinutes = 0;
                totalSeconds = 0;
                hoursLabel.innerHTML = "00";
                minutesLabel.innerHTML = "00";
                secondsLabel.innerHTML = "00";
                clearInterval(counter);

            }

            if (totalMills == 100) {
                totalSeconds++;
                secondsLabel.innerHTML = pad(totalSeconds % 60);
                totalMills = 0;
            }

            if (totalSeconds == 60) {
                totalMinutes++;
                minutesLabel.innerHTML = pad(totalMinutes % 60);
                totalSeconds = 0;
            }

            if (totalMinutes == 60) {
                totalHours++;
                hoursLabel.innerHTML = pad(totalHours);
                totalMinutes = 0;
            }

        }

         function pad(val) {
            var valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            }

            else {
                return valString;
            }
        }

    </script>
    </div>

</div>    
    <div class="panel panel-default">
        <div class="panel-heading">Time Logs</div>
        <div class="panel-body table-responsive">
            <table class="dataTable display compact">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Duration</th>
                        <th>Block</th>
                        <th>Sheds</th>
                        <th>Task</th>
                    </tr>
                </thead>                
                <tbody>
                         @foreach ($times as $time)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($time->start_time)) }} </td>
                                <td>{{ date('H:i:s', strtotime($time->start_time)) }}</td>
                                <td>{{ date('H:i:s', strtotime($time->end_time)) }}</td>
<!--							
                               {{ $duration = (strtotime($time->end_time))-(strtotime($time->start_time)) /60}}
                               {{$duration = date('H:i', $duration)}}
-->
                                <td>{{ $duration }}</td>
                                <td>{{ $time->block_id }}</td>
                                <td>{{ $time->sheds }}</td>
                                <td>{{ $time->task->description }}</td>
                            </tr>
                        @endforeach                  
                </tbody>
            </table>
        </div>
    </div>

@stop

