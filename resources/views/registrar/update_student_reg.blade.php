@extends('layouts.master')

@section('title', 'Update Student Registration')

@section('body')
    <div class="col-md-9 col-sm-9 col-md-offset-3 col-sm-offset-3">
        <br/>
        <div class="card">
            <div class="card-header card-header-main">
                <h3 class="mdl-color-text--yellow-300">Update Student Registration</h3>
            </div>
            <div class="card-block">
                <div class="col-md-4 col-md-offset-8">
                    <form action="/search_registration" method="post">
                        <input type="text" style="width:250px;" class="form-control" name="student" placeholder="Search for students" value="">
                        <input type="submit" class="btn btn-primary btn-sm pull-right" name="name" value="Search">
                    </form>
                </div>

                <table class="table">
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

            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets/js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/handlebars-v3.0.1.js') }}"></script>
    <script>
        $(document).ready(function () {
            var studlist = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                limit:6,
                remote: '/search_for_student/%QUERY'
            });
            studlist.initialize();
            //student_list.clearRemoteCache();
            $('input[name=student]').typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 1
                },
                {
                    name: 'student_list',
                    displayKey: 'value',
                    templates:{
                        suggestion: Handlebars.compile('<p style="padding: 0;"> @{{ value }} </p>' +
                        '<span> @{{ name }} </span>'),
                        empty:['<div class="alert alert-danger">Unable to find student</div>']
                    },
                    source: studlist.ttAdapter()
            });
        });
    </script>
@endsection
