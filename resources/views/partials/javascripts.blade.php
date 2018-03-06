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
<script>
    window._token = '{{ csrf_token() }}';
</script>

<!--Timer-->

<script type="text/javascript">
	$(document).ready(function(){
		
		$("#stop_btn").hide(); 
		
		$("#stop_btn").click(function(){
			//~ alert(new Date($.now()));
			var dt = new Date();
			var time = dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" + dt.getDate() + " " +dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
			$("#start_btn").show();
			$("#stop_btn").hide(); 
			var metoken = $('meta[name="_token"]').attr('content');
			//~ var metimetobesaved = moment().format('YYYY-MM-DD hh:mm:ss');
			//~ var stop_time = $("#stopTimeContainer").val(metimetobesaved);
			var start_time = $("#startTimeContainer").val();
			var meId = $("#task_id").val();
			$.ajax({
				type: "POST",
				url:"{!! URL::to('/insert') !!}",
				dataType: 'JSON',
				data: {
					"_method": 'POST',
					"_token": metoken,
					"stopTimeContainer": time,
					"startTimeContainer": start_time,
					"id": meId,
				},
				
				success: function( dataType ) {
					console.log( "Data Saved: " + dataType );
					 //location.reload();
				},
				error: function (dataType) {
					console.log( "Error: " + dataType );
				}
			});
		});
		
		
		$("#start_btn").click(function(){
			$("#stop_btn").show();
			$("#start_btn").hide();  
			var token = $('meta[name="_token"]').attr('content');
			var timetobesaved = $("#startTimeContainer").val();
			var myId = $("#task_id").val();
			//~ alert(token);
			$.ajax({
				type: "POST",
				url:"{!! URL::to('/insertStartTime') !!}",
				dataType: 'JSON',
				data: {
					"_method": 'POST',
					"_token": token,
					"startTimeContainer": timetobesaved,
					"id": myId,
				},
				
				success: function( dataType ) {
					console.log( "Data Saved: " + dataType );
				},
				error: function (dataType) {
					console.log( "Error: " + dataType );
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

<!--Display Current Time-->

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