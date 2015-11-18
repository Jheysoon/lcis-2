@extends('layouts.master')

@section('title', 'Pending Students Registration')

@section('body')
    <div class="col-md-9 col-sm-9 col-md-offset-3 col-sm-offset-3">
        <br/>
        <div class="card">
            <div class="card-header card-header-main">
                <h3 class="mdl-color-text--yellow-300">Pending Student Registration</h3>
            </div>
            <div class="card-block">
                <table class="table">
                    <caption>
                        <h3 class="text-center">Pending Students Registration</h3>
                    </caption>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Course w/ Major</th>
                            <th style="width:20%;" colspan="2" class="text-center">Action</th>
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
                                    <a href="{{ url("registration/$registration->id") }}" class="btn btn-primary btn-sm btn-raised pull-left">View</a>
                                </td>
                                <td>
                                    <a href="{{ url("registration/$registration->id") }}" class="btn btn-success btn-sm btn-raised pull-right">Confirm</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {!! $registrations->render() !!}
            </div>
        </div>
    </div>
@endsection
