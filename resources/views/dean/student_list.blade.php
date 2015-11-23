@extends('layouts.master')

@section('title', 'Student List')

@section('body')
    <div class="col-md-3"></div>
    <div class="col-md-9">
        <br/>
        <div class="card">
            <div class="card-header card-header-main">
                <h3 class="mdl-color-text--yellow-300">Students List</h3>
            </div>
            <div class="card-block">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th class="text-center">College</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($students as $student)
                            <tr>
                                <td>
                                    {{ $student->firstname }}
                                </td>
                                <td>
                                    {{ $student->lastname }}
                                </td>
                                <td class="text-center">
                                    {{ $student->description }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {!! $students->render() !!}
            </div>
        </div>
    </div>
@endsection
