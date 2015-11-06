@extends('master')

@section('title', 'Assign Instructor')

@section('body')
	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<br/>
		<div class="mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title text-center mdl-color--green-700">
				<div class="col-sm-6">
					<h1 class="mdl-card__title-text mdl-color-text--yellow-300">Assign Instructor</h1>
				</div>
				<div class="col-sm-6">
					<a href="{{ url('instructor_sched_list') }}" target="_blank" class="btn btn-warning pull-right">View Instructor Schedule</a>
				</div>
            </div>
            <div class="mdl-card__supporting-text" style="width:100%">

	            @if ($val == 'valid')
	            	<div class="col-md-6">
						<h3 style="text-align: center; font-weight: bold"> {{ Auth::user()->id == $system->employeeid ? '': $college->description }} </h3>
						<h5 style="text-align: center; font-weight: bold">School Year: {{ $acam->systart.'-'.$acam->syend }} Term: {{ $acam->term }} </h5>
					 </div>
					 <div class="col-md-4">
						<form class="form" action="/change_sy" method="post">
							<div class="form-group">
							<label class="control-label">School Year : </label>
							<div class="input-group">
								<select class="form-control" name="sy">

									@foreach($sy as $sys)
										<?php $sem = $sys->term == 3 ? 'Summer' : 'Term: '.$sys->term ?>
										<option value="{{ $sys->id }}" {{ (Session::get('phaseterm') == $sys->id) ? 'selected' : '' }} > SY: {{ $sys->systart.'-'.$sys->syend.' '.$sem }} </option>
									@endforeach

								</select>
								<span class="input-group-btn">
									<input type="submit" class="btn btn-primary btn-sm pull-right" name="name" value="Change">
								</span>
							</div>
							</div>
						</form>
					</div>

					<div class="col-md-2">
						<div class="form">
							<div class="form-group">
								<label class="control-label">Sort by :</label>
								<select class="form-control" id="sorting">
									<option value="0">All</option>
									<option value="1">Assigned</option>
									<option value="2">Not Assigned</option>
								</select>
							</div>
						</div>
					</div>
					<div class="table-body">

						@if (Session::has('message'))
							{!! Session::get('message') !!}
						@endif

						@include('dean.assigned_ins', ['classes' => $classes])

						@include('dean.not_assigned_ins', ['classes' => $classes])

					</div>

				@else
					<div class="alert alert-danger">
						Cannot run program. Class allocation status is not valid
					</div>
				@endif

            </div>
        </div>
	</div>

	<div class="modal fade" id="myModalIns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
	    	<div class="modal-content modal-sm">
	    		<form action="/dean/ass_ins_other" method="POST">
		    		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        		<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Assign Other Instructor</h4>
		    		</div>
		    		<div class="modal-body">
						<label>Instructor</label>
						<input type="hidden" id="cl_id" name="cl_id" value="">
		    			<select class="form-control" name="instructor">

		    				@if ($val == 'valid')
		    					@foreach ($otherInst as $ins)
			    					<?php $p = App\Party::findOrFail($ins->id) ?>

			    					@if (!$p instanceof ModelNotFoundException)
			    						<option value="{{ $p->id }}">{{ $p->firstname.' '.$p->lastname }}</option>
			    					@endif

			    				@endforeach
		    				@endif

		    			</select>
		    		</div>
		    		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        		<button type="submit" class="btn btn-primary">Save</button>
		    		</div>
	    		</form>
	    	</div>
		</div>
	</div>

@endsection

@section('footer')
	<script type="text/javascript">
		$(document).ready(function(){
			$('.save_instructor').submit(function(e){
				$.post('/save_instructor', $(this).serialize(),function(data){
					if (data == 'conflict') {
						alert('Instructor Conflict');
					} else if(data == 'no') {
						alert('Please select a Instructor');
					} else {
						alert('Successfully Assigned');
					}
				});
				e.preventDefault();
			});
			$('#sorting').change(function(){
				v = $(this).val();
				$.post('/dean/sorts',{sort:v},function(data){
					$('#table-body').html(data);
				});
			});
		});
	</script>
@endsection
