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
                        <th></th>
                        <th>Effectivity</th>
                        <th colspan="2">

                        </th>
                    </tr>
                    <tr>
                        <td class="tbl-header-main" colspan="5">Year Level : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Term : </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
