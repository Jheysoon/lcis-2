@include('includes.header', ['title' => 'Manage Curriculum'])
<body>
    @include('includes.menu')

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
            </div>
        </div>
    </div>

    @include('includes.footer')
</body>
</html>
