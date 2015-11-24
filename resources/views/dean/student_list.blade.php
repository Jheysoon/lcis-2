@extends('layouts.master')

@section('title', 'Student List')

@section('header')
    <style>
        .btn {
            margin: 2px 1px;
        }
    </style>
@endsection

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
                            <th>Lastname</th>
                            <th>Firstname</th>
                            <th class="text-center">College</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($students as $student)
                            <tr>
                                <td>
                                    <strong> {{ $student->lastname }} </strong>
                                </td>
                                <td>
                                    <strong> {{ $student->firstname }} </strong>
                                </td>
                                <td class="text-center">
                                    {{ $student->description }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-block btn-sm">Evaluate</a>
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
