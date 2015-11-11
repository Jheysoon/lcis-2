@extends('layouts.master')

@section('title', 'Instructors List')

@section('body')
    <div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <br>
        <div class="mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title text-center mdl-color--green-900">
                <h1 class="mdl-card__title-text text-center mdl-color-text--yellow-300">Instructors List</h1>
            </div>
            <div class="mdl-card__supporting-text">
                <table class="table">
                    <tr>
                        <th style="width:75%"> Instructor </th>
                        <th class="text-center"> Action </th>
                    </tr>
                    {{--  TODO: header for academiterm --}}
                    @foreach($instruc as $instructor)
                        <?php $p = App\Party::find($instructor->id)  ?>

                        @if( !$p instanceof ModelNotFoundException)
                        <tr>
                            <td> {{ $p->firstname.', '.$p->lastname }} </td>
                            <td> <a href="{{ url("instructor/$p->id") }}" class="btn btn-primary btn-sm center-block">View Schedule</a> </td>
                        </tr>
                        @endif

                    @endforeach

                </table>
            </div>
        </div>
    </div>
@endsection
