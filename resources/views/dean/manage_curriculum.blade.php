@extends('master')

@section('title')
    Manage Curriculum
@endsection

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
                                <a href="/delete_cur/{{ $curriculum->cur_id }}" onclick="return confirm('Are you sure you want to delete ?')" class="label label-danger">Delete Curriculum</a>
                                <a href="/copy" data-curriculum="{{ $curriculum->cur_id }}" class="copy_cur label label-primary">Copy Curriculum</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Copy Curriculum</h3>
                </div>
                <div class="modal-body">
                    <form action="{{ url('copy_curriculum') }}" method="post">
                        <input type="hidden" name="curriculum_id" value="">
                        <label>Copy To : </label>
                        <select class="form-control" name="sy_id">
                            <?php $acam = App\Academicterm::all() ?>
                            @foreach($acam as $ac)
                                <option value="{{ $ac->id }}">{{ $ac->systart.'-'.$ac->syend }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.copy_cur').click(function(e) {
                $('input[name=curriculum_id]').val($(this).data('curriculum'));
                $('#myModal').modal();
                e.preventDefault();
            });
        });
    </script>
@endsection
