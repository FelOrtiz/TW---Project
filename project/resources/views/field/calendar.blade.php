@extends('layouts.app')

@section('content')
<body>

	<div id='calendar'></div>

</body>
@endsection
@section('script')
<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicDay'
			},
			allDayText: false,
			allDaySlot: false,
			defaultTimedEventDuration: '01:00:00',
			slotLabelFormat: 'h(:mm)a',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: {
		        url: '/field/schedules',
		        type: 'POST',
		        data:{
		        	"field": "{{ $field->id }}",
		        	"_token": "{{ csrf_token() }}"
		        },
		        error: function() {
		            alert('Error al cargar las fechas');
		        },
		        color: '#008000',   
		        textColor: 'white' 
		    }
		});
		
	});

</script>

@endsection

@section('style')
<style>

	body {
		margin: 0 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
@endsection('style')

