@extends('layouts.master')

@section('title', 'Students In Class')

@section('body')
    <div class="col-md-3"></div>
    <div class="col-md-9">
        <br/>
        <div class="card">
            <div class="card-header card-header-main">
                <h3 class="mdl-color-text--yellow-300">List of Students</h3>
            </div>
            <div class="card-block">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Student Name</th>
                            <th colspan="2">Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 0 ?>
                        @forelse($students as $student)

                            <tr>
                                <td>{{ ++$ctr }}</td>
                                <td>
                                    {{ $student->lastname.' '.$student->firstname.' '.$student->middlename }}
                                </td>
                                <form class="save_grade_form" method="post">
                                    <input type="hidden" name="id" value="{{ $student->studentgrade_id }}">
                                    <td>
                                        <select class="form-control" name="grade">

                                            @foreach($grades as $grade)
                                                <?php
                                                    $g = DB::table('tbl_studentgrade')->where('id', $student->studentgrade_id)->first();

                                                    if ($g->semgrade == 0)
                                                        $init_grade = 44;
                                                    else
                                                        $init_grade = $g->semgrade;
                                                 ?>
                                                <option value="{{ $grade->id }}" {{ ($init_grade == $grade->id) ? 'selected' : '' }}>
                                                    {{ ($grade->value == '0.00') ? $grade->description : $grade->value }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-primary btn-sm" name="name" value="Save Grade">
                                    </td>
                                </form>
                            </tr>
                        @empty
                            <div class="alert alert-info text-center">
                                No Students Enrolled Yet..
                            </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('.save_grade_form').submit(function (e) {
                $.post('{{ url('save_grade') }}', $(this).serialize(), function (data) {
                    if (data == 'ok') {
                        alert('Successfully Add grade');
                    } else {
                        alert('Something went wrong');
                    }
                });
                e.preventDefault();
            })
        });
    </script>
@endsection
