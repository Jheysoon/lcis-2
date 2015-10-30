@extends('master')

@section('title', 'Assign Room To Subject')

@section('body')
	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<div class="panel p-body">

			<div class="col-md-12" style="background-color: #F0FBF0;">
				@include ('edp.cl_status')

				@if ($val == 'ok')
					<div style="max-width:200px;">
						<label for="">Sort by :</label>
						<select class="form-control" id="sort_cl">
							<option value="1">Assigned & Not Assigned</option>
							<option value="2">Assigned</option>
							<option value="3">Not Assigned</option>
							<option value="4">Dean</option>
						</select>
					</div>
					<div id="tbl_cl">

						@include ('edp.ajax_edp_all')

					</div>
					<form action="/edp/cl_inc" method="post">
						<input type="hidden" name="name" value="99">
						<input type="submit" value="Attest All" class="btn btn-primary pull-right">
					</form>
					<span class="clearfix"></span>
					<br/>
				@elseif ($val == 'you cannot continue')

					@include ('edp.dean_activity', ['colleges' => $colleges, 'system' => $system, 'message' => 'You Cannot Continue'])

				@else
					<div class="alert alert-danger center-block" style="text-align:center;width:400px;">
						The process is not yet here ...
					</div>
				@endif

			</div>
		</div>
	</div>

@endsection