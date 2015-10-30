<table class="table table-bordered" id="tbl_cl">
    <caption>
        <strong>
            Academicterm SY:
            <?php $acam = App\Academicterm::find($system->phaseterm) ?>
             {{ $acam->systart.' - '.$acam->syend.' Term: '.$acam->term }}
        </strong>
    </caption>
    <tr>
        <th style="text-align:center;">Subject</th>
        <th style="text-align:center;">Course</th>
        <th style="text-align:center;">Day</th>
        <th style="text-align:center;">Period</th>
        <th style="text-align:center;">Room</th>
        <th style="text-align:center;">Action</th>
    </tr>

    @foreach ($class as $cl)
        <tr>
            <td>
                <?php $s = App\Subject::find($cl->subject) ?>
                {{ $s->code }}
            </td>
            <td> {{ App\Library\Api::getCourseMajor($cl->coursemajor) }} </td>
            <td style="text-align:center;">
                {{ App\Classallocation::getShortDay($cl->id) }}
            </td>
            <td style="text-align:center;">
                {{ App\Classallocation::getPeriod($cl->id) }}
            </td>
            <td>
                <?php $rr = DB::table('tbl_dayperiod')->where('classallocation', $cl->id)->count() ?>

                @if ($rr > 0)
                    <?php $rr1 = DB::table('tbl_dayperiod')->where('classallocation', $cl->id)->where('classroom', 0)->count() ?>

                    @if ($rr1 < 1)
                        {{ App\Classallocation::getRooms($cl->id) }}
                    @else
                        Not Available
                    @endif

                @else
                    Not Available
                @endif

            </td>
            <td>

                @if ($rr > 0)

                    @if ($rr1 < 1)
                        Assigned
                    @else
                        <a href="/assign_room/{{ $cl->id }}" class="btn btn-primary btn-xs btn-block">Assign Room</a>
                    @endif

                @else
                    <a href="/assign_room/{{ $cl->id }}" class="btn btn-primary btn-xs btn-block">Assign Room</a>
                @endif

            </td>
        </tr>
    @endforeach
    
 </table>
