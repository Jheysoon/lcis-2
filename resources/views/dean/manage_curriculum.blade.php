@extends('master')

@section('title')
    Manage Curriculum
@stop

@section('body')
    <div class="col-md-9 col-md-offset-3 body-container">
        <div class="panel panel-success p-body">
            <div class="panel-heading search">
                <div class="col-md-6">
                    <h4>System Parameter: Add Subject To Curriculum</h4>
                </div>
            </div>
            <div class="panel-body">
                <form action="/insert_cur" method="post">
                    <div class="col-md-6">
                        <label class="lbl-data">EFFECTIVE SCHOOLAR YEAR</label>
                        <select class="form-control" name="acad_id">
                            <option value="0">Select Effectivity</option>
                                @foreach($acam as $academic)
                                <option value="{{ $academic->id }}">{{ $academic->systart.'-'.$academic->syend }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 ">
                        <label class="lbl-data">REMARKS</label>
                        <input class="form-control" type="text" name="remarks" value="">
                    </div>
                    <div class="col-md-6">
                        <label class="lbl-data">COURSE</label>
                        <select class="form-control" name = "coursemajor">
                            <option value="0">Select Course</option>
                            @foreach($c as $coursemajor)
                                <?php
                                    $course = DB::table('tbl_course')->where('id', $coursemajor->course)->first();
                                    $m      = '';
                                    if($coursemajor->major != 0)
                                    {
                                        $major  = DB::table('tbl_major')->where('id', $coursemajor->major)->first();
                                        $m      = '('.$major->description.')';
                                    }
                                 ?>
                                 <option value="{{ $coursemajor->id }}">{{ $course->description.' '.$m }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 ">
                        <label class="lbl-data">Year Level</label>
                        <select class="form-control" name="yearlevel">
                            <option value="0">Select Year Level</option>
                            @for( $i = 1; $i < 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-12">
                        <br/>
                        <button type="submit" class="btn btn-primary btn-raised pull-right">Save</button>
                    </div>
                </form>

                <strong class="strong">LIST OF Curriculum</strong>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>Course</th>
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Effective Year</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach($cur as $curriculum)
                        <tr>
                            <td> {{ $curriculum->c_description }} </td>
                            <td class="text-center"> {{ $curriculum->cur_description }} </td>
                            <td class="text-center">
                                <?php $c = App\Academicterm::find($curriculum->cur_academicterm) ?>
                                {{ $c->systart.'-'.$c->syend }}
                            </td>
                            <td>
                                <a href="/view_curriculum/{{ $curriculum->cur_id }}" class="label label-primary">View Curriculum</a>
                                <a href="/delete_curriculum/{{ $curriculum->cur_id }}" onclick="return confirm('Are you sure you want to delete ?')" class="label label-danger">Delete Curriculum</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
