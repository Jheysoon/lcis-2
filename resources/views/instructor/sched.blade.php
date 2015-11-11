@extends('layouts.master')

@section('title', 'Instructor Schedule')

@section('body')
    <div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <br>
        <div class="mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title text-center mdl-color--green-700">
                <h1 class="mdl-card__title-text mdl-color-text--yellow-300">{{ $instructor->firstname.', '.$instructor->lastname }}</h1>
            </div>
            <div class="mdl-card__supporting-text">
                <a href="{{ url('instructor_sched_list') }}" class="btn btn-warning btn-sm pull-right">Back</a>
                <table class="table table-bordered">
                    <tr>
                        <th>
                            Time \ Day
                        </th>

                        @foreach ($days as $day)
                            <th class="text-center">{{ $day->day }}</th>
                        @endforeach

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

                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
