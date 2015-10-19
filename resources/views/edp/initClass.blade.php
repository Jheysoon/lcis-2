@extends('master')

@section('body')
	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body" >
			<div class="col-md-12" style="background-color:#F0FBF0;">
			@include('edp.cl_status')

			@if($system->phase == env('FIN'))

				@if($system->classallocationstatus == 2 OR $system->classallocationstatus == 1)
					
					@if($c == env('COLLEGE_COUNT'))
						<?php
							// update the systemvalues
							DB::table('tbl_systemvalues')->update(['classallocationstatus' => 3]);
							// delete classallocation for this phaseterm
							DB::table('tbl_classallocation')->where('academicterm', $system->phaseterm)
								->delete();
							$sec = DB::table('out_section')->get();

							foreach ($sec as $section) {

								// if the section is zero it will not satisfy this condition
								for ($i = 1; $i <= $section->section; $i++) {
									$data['academicterm'] 	= $ssection->academicterm;
									$data['coursemajor'] 	= $ssection->coursemajor;
									$data['subject'] 		= $ssection->subject;
									$data['instructor']		= 0;
									$data['reserved']		= 0;
									$data['enrolled']		= 0;
									DB::table('tbl_classallocation')->insert($data);
								}
							}
						 ?>
						 <div class="alert alert-success">
							Class Allocation Successfully Created
						</div>
					@else
						@include('edp.dean_activity', ['stage' => 2, 'message' => 'You cannot initialize the classallocation'])
					@endif

				@else
					<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
						Cannot run this program
					</div>
				@endif

			@else
				<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
					Cannot run this program in this phase
				</div>
			@endif
			</div>
		</div>
	</div>
@endsection