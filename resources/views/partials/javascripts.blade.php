<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script>
<script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('adminlte/js') }}/main.js"></script>

<script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('adminlte/js/app.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script>
    window._token = '{{ csrf_token() }}';
</script>


<!--Timer-->

<script type="text/javascript">
	$(document).ready(function(){		
		$("#stop_btn").hide();		
		$("#stop_btn").click(function(){
			var dt = new Date();
			var time = dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" + dt.getDate() + " " +dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
			$("#start_btn").show();
			$("#stop_btn").hide(); 
			var metoken = $('meta[name="_token"]').attr('content');
			var start_time = $("#startTimeContainer").val();
			var meId = $("#task_id").val();
			var lastId = $("#lastId").val();
			var last_start_time = $("#last_start_time").val();
			var timeDue = ( new Date(time) - new Date(last_start_time) ) / 1000 / 60 / 60;
			var decimalTime = parseFloat(timeDue);
			decimalTime = decimalTime * 60 * 60;
			var hours = Math.floor((decimalTime / (60 * 60)));
			decimalTime = decimalTime - (hours * 60 * 60);
			var minutes = Math.floor((decimalTime / 60));
			decimalTime = decimalTime - (minutes * 60);
			var seconds = Math.round(decimalTime);
			if(hours < 10)
			{
				hours = "0" + hours;
			}
			if(minutes < 10)
			{
				minutes = "0" + minutes;
			}
			if(seconds < 10)
			{
				seconds = "0" + seconds;
			}
			timeDue = "" + hours + ":" + minutes + ":" + seconds;
						
			$.ajax({
				type: "POST",
				url:"{!! URL::to('/stoptime') !!}",
				dataType: 'JSON',
				data: {
					"_method": 'POST',
					"_token": metoken,
					"stopTimeContainer": time,
					"startTimeContainer": start_time,
					"id": meId,
					"lastId":lastId,
					"timeDue":timeDue,
				},
				
				success: function( response ) {
					console.log( "Data Saved: " + responseText );
					 location.reload();
				},
				error: function (ts) {
					console.log( "Error: " + ts.responseText );
					location.reload();
				},
			});
		});
		
		
		$("#start_btn").click(function(event){
				$("#stop_btn").show();
				$("#start_btn").hide();  
				var token = $('meta[name="_token"]').attr('content');
				var dt = new Date();
				var timetobesaved = dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" + dt.getDate() + " " +dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
				var block_id = $("#block_id").val();
				var task_id = $("#task_id").val();
				var sheds = $("#sheds").val();
				var chemical_id = $("#id_1").val();
				var tank_capacity = $("#tank_capacity").val();
				var total_liquid = $("#liquidtotal").val();
				var is_fruiting = $("#is_fruiting").val();
				var sprayed_by = $("#sprayed_by").val();
				
				// make all fields read-only
				$('#task_id').attr('disabled',true);
				$('#block_id').attr('disabled',true);
				$('#sheds').attr('disabled',true);
				$('#id_1').attr('disabled',true);
				$('#tank_capacity').attr('disabled',true);
				$('#liquidtotal').attr('disabled',true);
				$('#is_fruiting').attr('disabled',true);
				$('#sprayed_by').attr('disabled',true);
				$('#trade_name_1').attr('disabled',true);
				
				$.ajax({
					type: "POST",
					url:"{!! URL::to('/starttime') !!}",
					dataType: 'JSON',
					data: {
						"_method": 'POST',
						"_token": token,
						"startTimeContainer": timetobesaved,
						"task_id": task_id,
						"block_id":block_id,
						"sheds":sheds,
						"chemical_id":chemical_id,
						"tank_capacity":tank_capacity,
						"total_liquid":total_liquid,
						"is_fruiting":is_fruiting,
						"sprayed_by":sprayed_by,
					},
					
					success: function( response ) {
						var data = response.msg; // separate them, messages does in data
						var last_id = response.last_insert_id; // last_id has the last insert id
						var start_time = response.last_start_time; // last_id has the last start time
						$('#last_start_time').val(start_time);
						$('#lastId').val(last_id);
					},
					error: function (ts) {
						alert(ts.responseText);
					}
				});			
		});
	});
</script>


<!--Chemical trade name autocomplete function-->


            <script type="text/javascript">                
            $(document).on('focus','.autocomplete_txt',function(){
              type = $(this).data('type');
              
              if(type =='trade_name' )autoType='trade_name'; 
              
               $(this).autocomplete({
                   minLength: 0,
                   source: function( request, response ) {
                        $.ajax({
                            url: "{{ route('searchajax') }}",
                            dataType: "json",
                            data: {
                                term : request.term,
                                type : type,
                            },
                            success: function(data) {
                                var array = $.map(data, function (item) {
                                   return {
                                       label: item[autoType],
                                       value: item[autoType],
                                       data : item
                                   }
                               });
                                response(array)
                            }
                        });
                   },
                   select: function( event, ui ) {
                       var data = ui.item.data;           
                       id_arr = $(this).attr('id');
                       id = id_arr.split("_");
                       elementId = id[id.length-1];
                       $('#id_'+elementId).val(data.id);
                       $('#trade_name_'+elementId).val(data.trade_name);
                       $('#components_'+elementId).val(data.components);
                       $('#rates_'+elementId).val(data.rates);
                       $('#withhold_period_'+elementId).val(data.withhold_period);
                       $('#pest_disease_'+elementId).val(data.pest_disease);
                   }
               });
               
               
            });
            </script>

<!--Display Current Time -->

<script type="text/javascript">
    function startTime() {
        var today = new Date(),
                curr_hour = today.getHours(),
                curr_min = today.getMinutes(),
                curr_sec = today.getSeconds();
        curr_hour = checkTime(curr_hour);
        curr_min = checkTime(curr_min);
        curr_sec = checkTime(curr_sec);
        document.getElementById('clock').innerHTML = curr_hour + ":" + curr_min + ":" + curr_sec;
    }
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(startTime, 500);
</script>
@yield('javascript')