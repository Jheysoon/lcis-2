<table class="table table-striped">
	<tr>
        <td class="tbl-header" style="text-align: center;" colspan="8"><strong>Assigned Subjects</strong></td>
    </tr>
    <tr>
        <th>Subject</th>
        <th>Course</th>
        <th>Room</th>
        <th>Day</th>
        <th>Period</th>
        <th style="width:200px;">Instructor</th>
        <th>Other Instructors</th>
        <th>Action</th>
    </tr>
	<tbody>

    @foreach ($classes as $class)

    	@if ($class->instructor == 0)
    		<?php
    			$day 	= App\Day::getShortDay($class->cid);
    			$time 	= App\Time::getPeriod($class->cid);
    			$room 	= App\Room::getRooms($class->cid);
    		 ?>

    		@if (!empty($room) AND !empty($time))
    			<form class="save_instructor" method="post" data-alloc = "{{ $class->cid }}">
	    			<tr>
	    				<input type="hidden" name="cl_id" value="{{ $class->cid }}">
	    				<td> {{ $class->code }} </td>
	    				<td>
							@if($class->coursemajor != 0)
								<?php $course = App\Course::find($class->coursemajor) ?>

								@if( !$course instanceof ModelNotFoundException)
									{{ $course->description }}
								@endif

							@else
								Not Available
							@endif
						</td>
	    				<td> {{ $room }} </td>
	    				<td> {{ $day }} </td>
	    				<td> {{ $time }} </td>
	    				<td>
	    					<select class="form-control" name="instructor" required>
	    						<option value="{{ $class->instructor }}" selected>No Instructor</option>

	    						@foreach ($instruc as $i)
		    						<?php $conflict = App\Library\Api::checkInstructor($i->id, $time, $day) ?>

		    						@if ($conflict == false)
		    							<option value="{{ $i->id }}">
		    								<?php $party = App\Party::find($i->id) ?>

											@if( !$party instanceof ModelNotFoundException)
												{{  $party->lastname.', '.$party->firstname }}
											@endif

		    							</option>
		    						@endif

		    					@endforeach

	    					</select>
	    				</td>
	                    <td><a href="#" data-param="{{ $class->cid }}" data-toggle="modal" data-target="#myModalIns" class="btn btn-primary btn-sm cl_id_other">Choose</a></td>
	                    <td>
	                        <button type="submit" class="btn btn-primary btn-sm" name="button">Save</button>
	                    </td>
	                </tr>
    			</form>
    		@endif

    	@endif

    @endforeach

	</tbody>

</table>
