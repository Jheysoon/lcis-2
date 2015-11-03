<table class="table">
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

    @foreach ($classes as $class)

    	@if ($class->instructor != 0)
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
	    				<td> {{ $class->getCourse->description or 'Not Available' }} </td>
	    				<td> {{ $room }} </td>
	    				<td> {{ $day }} </td>
	    				<td> {{ $time }} </td>
	    				<td>
	    					<select class="form-control" name="instructor" required>
	    						<option value="{{ $class->instructor }}" selected></option>

	    						@foreach ($instruc as $i)
		    						<?php $conflict = App\Library\Api::checkInstructor($i->id, $time, $day) ?>

		    						@if ($conflict == false)
		    							<option value="{{ $i->id }}">
		    								<?php $party = DB::table('tbl_party')->where('id', $i->id)->first() ?>
		    								{{  $party->lastname.', '.$party->firstname }}
		    							</option>
		    						@endif

		    					@endforeach

	    					</select>
	    				</td>
	                    <td><a href="#" data-param="{{ $class->cid }}" data-toggle="modal" data-target="#myModalIns" class="btn btn-primary cl_id_other">Choose</a></td>
	                    <td>
	                        <button type="submit" class="btn btn-primary btn-sm" name="button">Save</button>
	                    </td>
	                </tr>
    			</form>
    		@endif

    	@endif

    @endforeach

</table>