@extends('layouts.master')

@section('title', 'Shifting Registration')

@section('body')
    <div class="col-md-9 col-sm-9 col-md-offset-3 col-sm-offset-3">
        <br/>
        <div class="card">
            <div class="card-header card-header-main">
                <h3 class="mdl-color-text--yellow-300">Shifting Student Registration</h3>
            </div>

            @if(Session::has('message'))
                {!! Session::get('message') !!}
            @endif

            <div class="card-block">
                <div class="col-md-4 col-md-offset-8">
                    <form action="{{ url('search_student') }}" method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="redirect" value="update_registration">
                        <input type="text" style="width:250px;" class="form-control" name="student" placeholder="Search for students" value="">
                        <input type="submit" class="btn btn-primary btn-sm pull-right" name="name" value="Search">
                    </form>
                </div>
            </div>

            <form action="index.html" method="post">

                @include('registrar.registration_form')
                
            </form>

        </div>
    </div>
@endsection
