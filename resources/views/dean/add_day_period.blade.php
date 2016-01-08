@extends('layouts.master')

@section('title', 'Add Day Period')

@section('body')
<div class="col-md-3"></div>
<div class="col-md-9 body-container">
	<br/>
	<div class="card">
		<div class="card-header card-header-main">
			<h3 class="card-title mdl-color-text--yellow-300">Add Day/Period</h3>
		</div>
		<div class="card-block">
			<div class="modal fade" id="modal_classalloc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">

						<form action="/add_classalloc" method="post">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h5 class="modal-title" id="myModalLabel">ADD</h5>
							</div>
							<div class="modal-body">
								<select name="subj" class="form-control">

									@foreach ($subject as $sub)
										<option value="{{ $sub->id }}">
											{{ $sub->code.' | '.$sub->descriptivetitle }}
										</option>
									@endforeach

								</select>
								<br/>
								<select class="form-control" name="course_major">
									<?php $c = DB::table('tbl_course')->get(); ?>

									@foreach ($c as $cc)
										<option value="{{ $cc->id }}"> {{ $cc->description }} </option>
									@endforeach

								</select>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				@include ('edp.cl_status')

				@if (Session::has('message'))
					{!! Session::get('message') !!}
				@endif

				@if ($val == 'class not init')
					<div class="alert alert-danger center-block" style="max-width:400px;text-align:center">
						<strong>Class Allocation is not been iniatialized<strong>
					</div>
				@elseif ($val == 'attested')
					<div class="alert alert-danger center-block" style="text-align:center;max-width:400px;">
						You have attested this..
					</div>
				@else
					<a href="/add_classalloc" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_classalloc">Add</a>

					<table class="table">
						<caption>
							<strong>
								{{ $acam }}
								<br/>
								@if ($system->employeeid != Session::get('uid'))
									<?php $of = DB::table('tbl_college')->where('id', $owner)->first() ?>
									College {{ $of->description }}
								@endif
							</strong>
						</caption>

						<tr>
							<th class="text-center">Subject</th>
							<th class="text-center">Course</th>
							<th class="text-center">Action</th>
							<th class="text-center">Status</th>
						</tr>

						@foreach ($sub as $subj)
							<tr>
								<td class="text-center">
									{{ $subj->code }}
								</td>
								<td class="text-center">
									<?php
										$course = DB::table('tbl_course')
												->where('id', $subj->coursemajor)
												->first();
									?>
									{{ $course->description }}
								</td>
								<td class="text-center">
									<a href="/add_day_period/{{ $subj->cid }}"
									   {{ empty($subj->status) ? '' : 'disabled' }}
									   class="btn btn-primary btn-xs">
										Add Day/Period
									</a> |
									<a href="/delete_classalloc/{{ $subj->cid }}" class="btn btn-danger btn-xs"
									   onClick="return confirm('Are you sure you want to delete ?');">
										Delete
									</a>
								</td>
								<td>
									<?php $cc = DB::table('tbl_dayperiod')->where('classallocation', $subj->cid)->count(); ?>

									@if ($cc > 0)
										Added Day Period
									@else
										No assigned day/period
									@endif

								</td>
							</tr>
						@endforeach

					</table>

					<a href="/dean/add_task_comp/4/O" class="btn btn-primary pull-right">Attest All</a>
				@endif

			</div>
		</div>
	</div>
</div>
@endsection
