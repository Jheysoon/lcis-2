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
				{{-- <th>Location</th> --}}
				<th width="10">Reserved</th>
				<th width="10">Enrolled</th>
			</tr>
            
            <?php 
                $classes = App\Classallocation::getClassAlloc($system->phaseterm, 
                        $registration->student, $registration->coursemajor, 
                        $yearlevel, $registration->curriculum, 
                        $academicterm->term);
                        
                $ctr    = 1;
				$ctr2   = 1;
            ?>
            @foreach($classes as $class)
                <?php $subject = App\Subject::find($class->subject) ?>
                
                <tr>
    				<td class="tbl-header" colspan="2"><strong>Code: </strong>{{ $subject->code }}</td>
    				<td class="tbl-header" colspan="4"><strong>Subject: </strong>{{ $subject->descriptivetitle }}</td>
    				<td class="tbl-header"><strong>Units: </strong>{{ $sub->units }}</td>
    			</tr>
                
                @foreach(App\Classallocation::academicterm($system->phaseterm)->subject($class->subject) as $classallocation)
                    <?php 
                        $time       = App\Time::getPeriod($classallocation->id);
                        $day        = App\Day::getShortDay($classallocation->id);
                        $rooms      = App\Room::getRooms($classallocation->id);
                     ?>
                    
                    <tr onclick="clickrow({{ $ctr.','.$ctr2.','.$subject->units }})">
                        <td id="r-{{ $ctr  }}">
                            <input type="radio" class="rad-{{ $ctr }}" name="rad-{{ $ctr }}" value="{{ $classallocation->id }}"
                                
                                @if(isset($select))
                                    @if(in_array($classallcation->id, $select))
                                        checked
                                        <?php $removed[] = $classallocation->id ?>
                                    @endif
                                @endif
                                
                                @if(old('rad-'.$ctr) == $classallocation->id)
                                    checked
                                @endif
                            >
                        </td>
                        <td>{{ $day }}</td>
                        <td>{{ $time }}</td>
                        <td id="r-{{ $ctr }}">{{ $rooms }}</td>
                        <td class="text-center">
                            {{ $classallocation->reserved }}
                        </td>
                        <td class="text-center">
                            {{ $classallocation->enrolled }}
                        </td>
                    </tr>
                    <?php $ctr2++; ?>
                     
                @endforeach
                
                <?php $ctr++ ?>
            @endforeach
            
        </table>
        
        <table class="table table-bordered table-hover" id="tblAddSubject">
            <tr class="main-table-header">
				<th  style="background: #2F5836" colspan="8">
					<h4 style="float: left">Additional Subject</h4>
					<button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#addEvalSub">Add Subject</button>
				</th>
			</tr>
			<tr>
				<th>Subject</th>
				<th>Days</th>
				<th>Period</th>
				<th>Room</th>
				{{-- <th >Location</th> --}}
				<th width="10">Reserved</th>
				<th width="10">Enrolled</th>
				<th width="100">Action</th>
			</tr>
            
            @if(isset($remove))
                <?php $ret = array_diff($select, $remove) ?>
            @endif
            
            @if($ret)
            
                @foreach($ret as $key => $cid)
                    <?php 
                        $sub        = App\Subject::find($cid);
                        $time       = App\Time::getPeriod($cid);
                        $day        = App\Day::getShortDay($cid);
                        $rooms      = App\Room::getRooms($cid);
                        $class      = App\Classallocation::find($cid);
                     ?>
                     
                    <tr>
                        <input type="hidden" name="additional" value="{{ $cid }}">
                        <td>{{ $sub->code }}</td>
                        <td>{{ $day }}</td>
                        <td>{{ $time }}</td>
                        <td>{{ $rooms }}</td>
                        <td>{{ $class->reserved }}</td>
                        <td>{{ $class->enrolled }}</td>
                        <td>
                            <a type="button" class="a-table label label-danger remove"  data-param="{{ $sub->code }}">Remove
		                    <span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
                
            @endif
        </table>
        
        <input type="hidden" name="count" value = "{{ $ctr }}">
		<input type="hidden" name="legid" value = "{{ $register->user->legacyid }}">
		<div class="form-group">
			<button type="submit" name="btn" value="1" class="btn btn-primary pull-right">Save Evaluation</button>
		</div>
        
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="addEvalSub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false" style="background: rgba(0,0,0, .5)">
	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
    		<div class="modal-header panel-heading ">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Add subject</h4>
    		</div>
    		<div class="modal-body col-md-12"  style="background-color: #fff;">
            	<form id = "searchSubject" class="navbar-form navbar-right col-md-12" role="search" onsubmit="return false">
	            	<input type="hidden" name="term" value="{{ $academicterm->term }}">
	            	<input type="hidden" name="student" value="{{ $registration->student }}">
	            	<input type="hidden" name="course" value="{{ $registration->coursemajor }}">
	                <div class="form-group">
	                    <input type="text" type="text" name="subject" id="inputdata" class="form-control" required autocomplete="off" placeholder="Subject">
	                </div>
	                <button type="submit" class="btn btn-primary">
	                    <span class="glyphicon glyphicon-search"></span>
	                </button>
            	</form>
	            <div id="alert1" class="alert alert-info" role="alert">
	                  <strong>Please search a subject!</strong>
	            </div>
	            <div id="alert2" class="alert alert-danger" role="alert">
	                  <strong>Subject not found! Please search another subject!</strong>
	            </div>
				<form id="modal-table" class="form" role="form" onsubmit="return false">
					<div class="progress" id="prog">
					  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
					    <span >Please wait while loading subjects.</span>
					  </div>
					</div>
	            	<div id="div_eval">
		            <?php
		            	// echo $term;
		            	$param = array(
		            		'term' => $term,
		            		'student' => $student,
		            		'course' => $course,
		            		'subject' => ''
		            	);
		            ?>
                    @include('dean.modal_evaluation', $param)
	            	</div>
			    		<div class="pull-right">
			        		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        		<button type="submit" class="btn btn-primary">Save</button>
			        	</div>
		        </form>
    		</div>
    	</div>
	</div>
</div>