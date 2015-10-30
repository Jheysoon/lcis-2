@extends('master')

@section('title', 'Add Day Period')

@section('body')
	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<br/>
		<div class="mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title mdl-color--green-700">
                <h1 class="mdl-card__title-text text-center" style="color:#fff;">Subject Schedule</h1>
            </div>
            <div class="mdl-card__supporting-text" style="width:100%;">
            	<form action="/add_day_period/{{ $cid }}" method="post">

					@if (Session::has('message'))
						{!! Session::get('message') !!}
					@endif

					{!! $error !!}

					 <table class="table">
						<tr>
							<th>Subject</th>
							<th>Course</th>
						</tr>
						<tr>
							<td>{{ $cl->getSubject->code }}</td>
							<td>
								<?php $t = DB::table('tbl_course')->where('id', $cl->coursemajor); ?>
								@if ($t->count() > 0)
									<?php $tt = $t->first() ?>
									{{ $tt->description }}
								@endif
							</td>
						</tr>
					 </table>					 
							
					<input type="hidden" name="class_id" value="{{ $cid }}">
					<table class="table">
						<tr>
							<th style="text-align:center;">Days</th>
							<th style="text-align:center;">Start Time</th>
							<th style="text-align:center;">End Time</th>
						</tr>

						@foreach ($days as $day)
							<tr>
								<td>
									<div class="checkbox">
										<label>
											<input type="checkbox" style="margin-top:8px;" name="day[]" value="{{ $day->id }}" {{ set_checkbox('day', $day->id) }}>
											<strong style="font-size:18px">{{ $day->day }}</strong>
										</label>
									</div>
								</td>
								<td>
									<select class="form-control" name="start_time{{ $day->id }}">

										@foreach ($times as $time)
											<option value="{{ $time->id }}" {{ set_select('start_time'.$day->id, $time->id) }}> {{ $time->time }} {{ ($time->id < 11) ? 'AM' : 'PM' }}</option>
										@endforeach

									</select>
								</td>
								<td>
									<select class="form-control" name="end_time{{ $day->id }}">

										@foreach ($times as $time)
											<option value="{{ $time->id }}" {{ set_select('end_time'.$day->id, $time->id) }}> {{ $time->time }} {{ ($time->id < 11) ? 'AM' : 'PM' }}</option>
										@endforeach

									</select>
								</td>
							</tr>
						@endforeach

					</table>
					<input type="submit" class="btn btn-primary pull-right" value="Submit" name="submit">
				</form>
            </div>
        </div>
	</div>

@endsection