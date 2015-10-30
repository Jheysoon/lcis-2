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
            <td>{{ $cl->getSubject->code }}</td>
            <td> {{ $cl->getCourse->shortname or '' }} </td>
            <td style="text-align:center;">
                {{ App\Day::getShortDay($cl->id) }}
            </td>
            <td style="text-align:center;">
                {{ App\Time::getPeriod($cl->id) }}
            </td>
            <td>
                <?php $rr = App\Day_period::where('classallocation', $cl->id)->count() ?>

                @if ($rr > 0)
                    <?php $rr1 = App\Day_period::where('classallocation', $cl->id)->where('classroom', 0)->count() ?>

                    @if ($rr1 < 1)
                        {{ App\Room::getRooms($cl->id) }}
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
