<table class="table">
    <caption>
        <h3 class="text-center">Pending Students Registration</h3>
    </caption>
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Course w/ Major</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach($registrations as $registration)
            <tr>
                <td> {{ $registration->user->legacyid }} </td>
                <td> {{ $registration->user->lastname.', '.$registration->user->firstname }} </td>
                <td>
                    <?php
                        $coursemajor    = DB::table('tbl_coursemajor')->where('id', $registration->coursemajor)->first();
                        $course         = App\Course::find($coursemajor->course);
                        $major          = '';

                        if ($coursemajor->major != 0) {
                            $majors = DB::table('tbl_major')->where('id', $coursemajor->major)->first();
                            $major  = '('.$majors->description.')';
                        }
                     ?>
                    {{ $course->description.' '.$major }}
                </td>
                <td>
                    <a href="{{ url("registration/$registration->id") }}" class="btn btn-primary btn-sm btn-raised">Update</a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

{!! $registrations->render() !!}
