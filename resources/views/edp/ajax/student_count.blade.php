<form class="form-horizontal add-user" method="post" action="/edp/studentcount" role="form">
<?php $t = App\Academicterm::find($system->currentacademicterm); ?>

@if($t->term != 2)
    <input type="hidden" name="acam" value="{{ $system->nextacademicterm }}">
    <table class="table">
    	<caption>
    		<strong>
    		Preparation Statistics for Academicterm SY:
            <?php $nnxt = App\Academicterm::find($system->nextacademicterm) ?>
            {{ $nnxt->systart.' - '.$nnxt->syend.' Term: '.$nnxt->term }}
    		 </strong>
    	</caption>
    	<tr>
    		<td>Course</td>
    		<td>Year Level</td>
    		<td>Number of Student</td>
    	</tr>
	<?php $curs = DB::table('tbl_course')->get() ?>
    @foreach($curs as $cu)
        <?php
            $yearL 	= array(0 => 0,1 => 0,2 => 0,3 => 0);
            $course = $cu['id'];

            $count 	= 0;
        ?>
            @if($t->term == 3)
                <?php
                    // if term is summer . get the students enrolled in last 2nd sem.
                    $acam   = $system->currentacademicterm - 1;
                    $e      = App\Classallocation::getStudEnrol($cu->id, $acam);
                 ?>
            @else
                <?php
                    // if not get the students in enrolled in current academicterm
                    $e = App\Classallocation::getStudEnrol($cu->id, $system->currentacademicterm);
                 ?>
            @endif

            @foreach($e as $stud)
                <?php
                    $yearlevel = App\Library\Api::yearLevel($stud->student);
                    if ( is_numeric($yearlevel) ) {
                        if ($yearlevel > 1) {
                            if ($yearlevel > 4)
                                $yearL[3] += 1;
                            else
                                $yearL[$yearlevel - 1] += 1;
                        }
                    }
                 ?>
            @endforeach

            @if($t->term == 3)
                <?php
                    $acam = $system->currentacademicterm - 2;
                    $e      = App\Classallocation::getStudEnrol($cu->id, $acam);
                 ?>
            @else
                <?php $e = App\Classallocation::getStudEnrol($cu->id, $system->currentacademicterm) ?>
            @endif

            @foreach($e as $stud)
                <?php
                    $yearlevel = App\Library\Api::yearLevel($stud->student);
                    if ( is_numeric($yearlevel) ) {
                        if ($yearlevel == 1)
                            $yearL[0] += 1;
                    }
                ?>
            @endforeach

            @for($i = 1; $i <= 4 ; $i++)
                <tr>
                    <input type="hidden" name="coursemajor[]" value="{{ $cu->id }}">
                    <input type="hidden" name="year_level[]" value="{{ $i }}">
                    <td>{{ $cu->description }}</td>
                    <td>{{ $i }}</td>
                    <td>{{ $yearL[$i - 1]}}</td>
                    <input type="hidden" name="count[]" value="{{ $yearL[$i - 1] }}">
                </tr>
            @endfor
    @endforeach
@else
	<div class="alert alert-danger">
		Not applicable for summer term
	</div>
@endif
</table>
<button type="submit" class="btn btn-success pull-right">Save</button>
</form>
