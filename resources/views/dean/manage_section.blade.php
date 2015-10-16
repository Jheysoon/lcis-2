@extends('master')

@section('title')
	Manage Section
@endsection

@section('body')
	<div class="col-md-3"></div>
	<div class="col-md-9">
		<div class="panel p-body panel-success">
			<div class="panel-heading search">
				<div class="col-md-12">
					<h4>Manage Section</h4>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-12">
						@include('edp.cl_status', ['system' => $system])

						@if ($system->classallocationstatus == 1)

							@if ($count < 1)
								<a href="/non_exist" class="btn btn-primary btn pull-right">Add Non - Existing Subject</a>
								<span class="clearfix"></span>
								<br/>

								<table class="table table-bordered">
									<caption>
										Preparation for Academicterm SY:
										<?php $sy = App\Academicterm::find($system) ?>
										{{ $sy->systart.' - '.$sy->syend.' Term: '.$sy->term }}

										@if (Session::get('uid') == $system->employeeid)
											<?php $col = DB::table('tbl_college')->where('id', $owner)->first() ?>
											{{ 'College'.$col->description }}
										@endif

									</caption>
									<tr>
										<th>Subject</th>
										<th>Description</th>
										<th>Course</th>
										<th>Year Level</th>
										<th>No. of Student</th>
										<th>Apprx. Section <br/>({{ $system->numberofstudent }} students)</th>
										<th>Section</th>
										<th>Action</th>
									</tr>

									@foreach ($sql as $subj)
										<tr>
											<td> {{ $subj->code }} </td>
											<td> {{ $subj->descriptivetitle }} </td>
											<td> 
												<?php $course = DB::table('tbl_course')->where('id', $subj->coursemajor)->first(); ?>
												{{ $course->shortname }}
											</td>
											<td> {{ $subj->yearlevel }} </td>
											<td> {{ round($subj->section) }} </td>
											<form class="addClassAllocation">
												<td>
													<input type="number" min="1" data-param="{{ round($subj->section) }}" class="form-control input-sm section" name="sections" value="{{ $subj->section }}" required>
													<input type="hidden" name="out_section_id" value="{{ $subj->id }}">
												</td>
												<td>
													<input type="submit" value="Update" class="btn btn-primary btn-sm">
												</td>
											</form>
										</tr>
									@endforeach

								</table>
								<a href="/dean/add_task_comp/2/O" class="btn btn-primary pull-right">Attest all</a>
							@else
								<div class="alert alert-danger center-block" style="max-width:400px;text-align:center;">
									You have attested this
								</div>
							@endif

						@else
							<div class="alert alert-danger center-block" style="max-width:400px;">
								Cannot run this program. The EDP must complete the step 1.
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<script type="text/javascript">
        $(document).ready(function(){
            $('.addClassAllocation').submit(function (e){
                elem = $(this).parent();
                $.post('/dean/addClassAlloc1',$(this).serialize(),function(data){
                    elem.removeClass('danger');
                    alert('Successfully Updated');
                });
                e.preventDefault();
            });
            $('.section').change(function() {
                param = $(this).data('param');

                if (param != $(this).val()) {
                    $(this).parent().parent().addClass('danger');
                } else {
                    $(this).parent().parent().removeClass('danger');
                }

            });
            $('.section').keyup(function() {
                param = $(this).data('param');

                if (param != $(this).val()) {
                    $(this).parent().parent().addClass('danger');
                } else {
                    $(this).parent().parent().removeClass('danger');
                }

            });
        });
    </script>
@endsection