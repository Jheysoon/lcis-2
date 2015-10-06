@extends('master')

@section('title')
    View Curriculum
@stop

@section('body')
    <div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <div class="panel p-body panel-success">
            <div class="panel-heading search">
    			<div class="col-md-6">
    				<h4>System Parameter: Add Subject To Curriculum</h4>
    			</div>
    		</div>
            <form action="/insert_subject" method="post">
                <div class="panel-body">
                    <div class="col-md-6 col-md-offset-3">
                        <input type="hidden" name="cur_id" value="{{ $id }}">

                        <div class="col-md-12 ">
        					<label class="lbl-data">Subject</label>
        					<select class="form-control" name="subid">
        						<option value="0">Select Subject</option>
                                @foreach($get_cur as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->code.' '.$subject->descriptivetitle }}</option>
                                @endforeach
        					</select>
        				</div>

                        <div class="col-md-12 ">
        					<label class="lbl-data">Year Level</label>
        					<select class="form-control" name = "yearlevel">
        					<option value="0">Select Year Level</option>
                            @for( $i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
        					</select>
        				</div>

                        <div class="col-md-12 ">
        					<label class="lbl-data">Term</label>
        					<select class="form-control" name = "term">
        					<option value="0" selected>Select Term</option>
                            @for( $i = 1; $i <= 3; $i++)
                                <option value="{{ $i }}">{{ $i == 3 ? 'Summer' : $i }}</option>
                            @endfor
        					</select>
        				</div>
                        </br />
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>
                </div>
            </form>

            <div class="panel-body">
                <strong class="strong">LIST OF SUBJECTS</strong>
        		<div class="table-responsive">
                    <table class="table table-bordered no-space">
                        <tr>
                            <th>Course</th>
                            <th>{{ $course }}</th>
                            <th>Effectivity</th>
                            <th colspan="2" class="text-center">
                                <?php $acam = App\Academicterm::find($cur->academicterm) ?>
                                {{ $acam->systart.'-'.$acam->syend }}
                            </th>
                        </tr>
                        @foreach($cur_detail as $curriculum_detail)
                            <tr>
                                <td class="tbl-header-main" colspan="5">Year Level : {{ $curriculum_detail->yearlevel }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Term : {{ $curriculum_detail->term }}</td>
                            </tr>
                            <tr>
                                <td class="tbl-header">Code</td>
                                <td class="tbl-header">Descriptive Title</td>
                                <td class="tbl-header" colspan="2">Units</th>
                                <td class="tbl-header">Action</th>
                        	</tr>
                            <?php $cur_d = DB::table('tbl_curriculumdetail')->whereCurriculumAndYearlevelAndTerm($id, $curriculum_detail->yearlevel, $curriculum_detail->term )->get() ?>
                            @foreach($cur_d as $detail)
                                <?php $subject1 = App\Subject::where('id', $detail->subject); ?>
                                @if($subject1->count() > 0)
                                    <?php $subject = $subject1->first() ?>
                                    <tr>
                                        <td>{{ $subject->code }}</td>
                                        <td>{{ $subject->descriptivetitle }}</td>
                                        <td colspan="2">{{ $subject->units }}</td>
                                        <td>
                                            <a class="a-table label label-danger" href="/lc_curriculum/deletesub/" onclick="return confirm('Are you sure?')">Delete<span class="glyphicon glyphicon-trash"></span></a>
                                            <a class="a-table label label-info" href="/dean/ident_subj/" target="_blank">Edit/View<span class="glyphicon glyphicon-pen"></span></a>
                                            <a class="a-table label label-info" href="/menu/dean-subject_list" target="_blank">Add<span class="glyphicon glyphicon-pen"></span></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop