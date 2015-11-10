@extends('master')

@section('title', 'Subjects')

@section('body')
    <div class="col-md-3"></div>
    <div class="col-md-9 body-container">
        <br/>
        <div class="mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title text-center mdl-color--green-900">
                <h1 class="mdl-card__title-text mdl-color-text--yellow-300">Subjects</h1>
            </div>
            <div class="mdl-card__supporting-text">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Code</th>
                            <th class="text-center">Descriptivetitle</th>
                            <th class="text-center">Units</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($subjects as $subject)
                            <tr>
                                <td> {{ $subject->code }} </td>
                                <td> {{ $subject->descriptivetitle }} </td>
                                <td> {{ $subject->units }} </td>
                                <td><a href="{{ url("subject/$subject->id") }}" class="label label-primary btn-block pull-right" style="padding:5px;">View</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {!! $subjects->render() !!}
            </div>
        </div>
    </div>
@endsection
