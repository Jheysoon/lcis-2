@extends('master')

@section('title', 'Room Schedule')

@section('body')
	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<br/>
		<div class="mdl-card mdl-shadow--4dp ">
            <div class="mdl-card__title mdl-card--expand text-center mdl-color--green-900">
            	<h4 class="mdl-card__title-text text-center mdl-color-text--yellow-300">Room Schedule</h4>
            </div>
            <div class="mdl-card__supporting-text" style="width:100%">
            	<a href="/preview/{{ $room_id }}" class="btn btn-primary btn-sm pull-right">Print Preview</a>
            	<div class="col-md-12">
            		<h4>Room: {{ $room_name }}</h4>
            		<h4>Location: {{ $location }}</h4>
            		<table class="table table-bordered">
            			<tr>
            				<th>Time / Day</th>

            				@foreach ($days as $day)
            					<th class="text-center">{{ $day->day }}</th>
            				@endforeach

            			</tr>

            			@for ($i = 0; $i < 27; $i++)
            				<tr>
            					<td class="text-center"><strong> {{ $times[$i]->time.' - '.$times[$i + 1]->time }}</strong></td>

            					@foreach ($days as $day)

            						@if ( !empty($table_day[$day->id][$i + 1] ))

            							@if ( !empty($table_day[$day->id][$i+1]['rowspan']))
            								<td rowspan="{{ $table_day[$day->id][$i+1]['rowspan'] }}" class="colspan" style="background-color:{{ $table_day[$day->id][$i+1]['color'] }}">
            									<span>
            										 {{ $table_day[$day->id][$i+1]['subject'] }}
            										<br/>
            										 {{ $table_day[$day->id][$i+1]['course'] }}
            									</span>

            								</td>
            							@endif

            						@else            						
            							<td style="height:5px;">&nbsp;</td>
            						@endif

            					@endforeach

            				</tr>
            			@endfor

            		</table>
            		
            	</div>
            </div>
        </div>
	</div>
@endsection