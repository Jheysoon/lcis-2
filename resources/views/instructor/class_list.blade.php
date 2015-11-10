@extends('master')

@section('title', 'Class List')

@section('body')
    <div class="col-md-3"></div>
    <div class="col-md-9">
        <br/>
        <div class="mdl-card mdl-shadow--4dp">
            {{-- add header information like academicterm --}}
            <div class="mdl-card__title text-center mdl-color--green-900">
                <h1 class="mdl-card__title-text mdl-color-text--yellow-300">Classes List</h1>
            </div>
            <div class="mdl-card__supporting-text">
                <table class="table">
                    <caption>sdfsdf</caption>
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Room</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($classes as $class)
                            <tr>
                                <td>{{ $class->getCourse->description or '' }}</td>
                                <td>{{ $class->getSubject->code }}</td>
                                <td>{{ App\Room::getRooms($class->id) }}</td>
                                <td>{{ App\Day::getShortDay($class->id) }}</td>
                                <td>{{ App\Time::getPeriod($class->id) }}</td>
                                <td><a href="{{ url("class/$class->id") }}" class="label label-primary btn-block pull-right" style="padding:5px;">View Class</a></td>
                            </tr>
                        @empty
                            <div class="alert alert-info text-center">
                                No Class
                            </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
