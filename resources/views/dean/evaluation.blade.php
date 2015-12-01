<div class="tbl-responsive" id="evaluation">
    <form class="form" action="{{ url("evaluate/$id") }}" method="post">
        <input type="hidden" name="coursemajor" value="{{ $registration->coursemajor }}">
        <input type="hidden" name="registration" value="{{ $registration->id }}">
        <input type="hidden" name="academicterm" value="{{ $system->phaseterm }}">
        <input type="hidden" name="yearlevel" value="{{ $yearlevel }}">
        <input type="hidden" name="term" value="{{ $academicterm->term }}">
        
        <table class="table table-bordered table-hover" id = "tabletest">
            <tr class="main-table-header">
				<th  style="background: #2F5836" colspan="7">
					<h4 style="float: left">Select Subject</h4>
				</th>
			</tr>
            
			<tr>
				<th width="25"></th>
				<th>Days</th>
				<th>Period</th>
				<th>Room</th>
				<th>Location</th>
				<th width="10">Reserved</th>
				<th width="10">Enrolled</th>
			</tr>
            
            <?php 
                $classes = App\Classallocation::getClassAlloc($system->phaseterm, 
                        $registration->student, $registration->coursemajor, 
                        $yearlevel, $registration->curriculum, 
                        $academicterm->term);
            ?>
            
            @foreach($classes as $class)
                <?php $subject = App\Subject::find($class->subject) ?>
                
                <tr>
    				<td class="tbl-header" colspan="2"><strong>Code: </strong>{{ $subject->code }}</td>
    				<td class="tbl-header" colspan="4"><strong>Subject: </strong>{{ $subject->descriptivetitle }}</td>
    				<td class="tbl-header"><strong>Units: </strong>{{ $sub->units }}</td>
    			</tr>
                
                @foreach(App\Classallocation::academicterm($system->phaseterm)->subject($class->subject) as $sched)
                <?php 
                    $time   = App\Time::getPeriod($sched->id);
                    $day    = App\Day::getShortDay($sched->id);
                    $rooms  = App\Room::getRooms($sched->id);
                    
                 ?>
                    
                @endforeach
                
            @endforeach
            
        </table>
    </form>
</div>