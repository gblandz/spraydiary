@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.times.title')</h3>
    

<div class="row">
<div class="col-md-6">
    <div class="well">
    <p><strong>Select Details for Recording</strong></p>
    
    <p>Select Tasks: 
    <select class="selectpicker">
        <option>Spray 1</option>
        <option>Spray 2</option>
        <option>Spray 3</option>
        </select> 
    </p>
    <p>Select Block: 
    <select class="selectpicker">
        <option>Block 1</option>
        <option>Block 2</option>
        <option>Block 3</option>
        </select> 
    </p>
    <p>Select Chemical: 
    <select class="selectpicker">
        <option>Chemical 1</option>
        <option>Chemical 2</option>
        <option>Chemical 3</option>
        </select> 
    </p>
</div>

</div>


<div class="col-md-6">
<div class="well">

<div style="text-align: center">
    <p>{{ date('F d, Y H:i:s') }} </p> 

        <span style="font-size: 11px">HH:MM:SS</span><br />

        <label id="hours">

            00</label>:<label id="minutes">00</label>:<label id="seconds">00</label>

        <br />
<input type="button" value="Start" onclick="startTimer()">
<input type="button" value="Stop" onclick="stopTimer()">
        <br />

        <label id="totalTime">

        </label>

    </div>

    <br />

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
</div>    
    <div class="panel panel-default">
        <div class="panel-heading">
            Time Logs
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

