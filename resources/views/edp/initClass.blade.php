@extends('layouts.master')

@section('title', 'Iniatialize Classallocation')

@section('body')
	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body" >
			<div class="col-md-12" style="background-color:#F0FBF0;">

			@include('edp.cl_status')

			@if($val == 'cannot run in this phase')
				<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
					Cannot run this program in this phase
				</div>

			@elseif($val == 'cannot run')
				<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
					Cannot run this program
				</div>

			@elseif($val == 'college count')

				@include('edp.dean_activity', ['stage' => 2, 'message' => 'You cannot initialize the classallocation'])

			@elseif($val == 'OK')
				<div class="alert alert-success">
					Class Allocation Successfully Created
				</div>
			@endif

			</div>
		</div>
	</div>
@endsection
