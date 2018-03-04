@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.times.title')</h3>
    

<div class="row">

    <div class="col-md-8">
        <div class="box box-primary">
        <div class="box-header with-border">
            <p><strong>Select Details for Recording:</strong></p>

            {!! Form::label('task_id', 'Select Task:', ['class' => 'control-label']) !!}
            {!! Form::select('task_id', $tasks, null, ['class' => 'form-control']) !!}
            {!! Form::label('block_id', 'Select Block:', ['class' => 'control-label']) !!}
            {!! Form::select('block_id', $blocks, null, ['class' => 'form-control']) !!}
            {!! Form::label('shed_id', 'Select Shed (hold shift to select more than one):', array('multiple'=>'multiple','name'=>'sheds[]')) !!}
            {!! Form::select('shed_id', $sheds, null, ['class' => 'form-control']) !!}
            {!! Form::label('chemical_id', 'Chemical Trade Name:', ['class' => 'control-label']) !!}
            {!! Form::select('chemical_id', $chemicals, null, ['class' => 'form-control']) !!} 
            </br>
            <div class="col-xs-3">
            {!! Form::label('pest_disease', 'Pest Disease', ['class' => 'control-label']) !!}        
            {!! Form::text('pest_disease', 'null', ['class'=>'form-control','readonly']) !!}
            </div>
            <div class="col-xs-3">
            {!! Form::label('components', 'Active Constituents', ['class' => 'control-label']) !!}        
            {!! Form::text('components', 'null', ['class'=>'form-control','readonly']) !!}
            </div>
            <div class="col-xs-3">
            {!! Form::label('rates', 'Chemical Application Rate', ['class' => 'control-label']) !!}        
            {!! Form::text('rates', 'null', ['class'=>'form-control','readonly']) !!}
            </div>
            <div class="col-xs-3">
            {!! Form::label('withhold_period', 'With Hold Period', ['class' => 'control-label']) !!}        
            {!! Form::text('withhold_period', 'null', ['class'=>'form-control','readonly']) !!}
            </div>
            <div class="col-xs-3">
            {!! Form::label('tank_capacity', 'Capacity of Spray Tank', ['class' => 'control-label']) !!}        
            {!! Form::text('tank_capacity', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-xs-3">
            {!! Form::label('total_liquid', 'Total Liquid', ['class' => 'control-label']) !!}        
            {!! Form::text('total_liquid', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-xs-3">
            {!! Form::label('is_fruiting', 'Fruiting?', ['class' => 'control-label']) !!}        
            {{ Form::select('is_fruiting', ['Yes', 'No'], null, ['class' => 'form-control']) }}
            </div>
            <div class="col-xs-3">
            {!! Form::label('sprayed_by', 'Sprayed By:', ['class' => 'control-label']) !!}        
            {!! Form::text('sprayed_by', $sprayer, ['class'=>'form-control', 'readonly']) !!}
            </div>
        </div>
        </div>
    </div>


    <div class="col-md-4">
        <div style="text-align: center">
        <p><h4>{{ date('F d, Y H:i:s') }}</h4> </p> 

            <span style="font-size: 11px">HH:MM:SS</span><br />
            <label id="hours">00</label>:<label id="minutes">00</label>:<label id="seconds">00</label>
            </br>
            <button type="button" class="btn btn btn-success" onclick="startTimer()">Start</button>
            <input type="text" name="stopTimeContainer" id="stopTimeContainer" value={{$date}}>
            <button type="button" class="btn btn btn-danger" onclick="stopTimer()" id="stop_btn">Stop</button>
            </br>
            <label id="totalTime">

            </label>
        </div>
        </br>
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
                        <th>Task</th>
                    </tr>
                </thead>                
                <tbody>
                         @foreach ($times as $time)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($time->created_at)) }} </td>
                                <td>{{ $time->start_time }}</td>
                                <td>{{ $time->end_time }}</td>
                                <td>{{ $time->duration }}</td>
                                <td>{{ $time->task->description }}</td>
                            </tr>
                        @endforeach                  
                </tbody>
            </table>
        </div>
    </div>
@stop

