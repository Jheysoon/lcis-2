@extends('layouts.master')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}" media="screen" title="no title" charset="utf-8">
@endsection

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
                        <input type="hidden" name="redirect" value="shift_student">
                        <input type="text" style="width:250px;" class="form-control" name="student" placeholder="Search for students" value="">
                        <input type="submit" class="btn btn-primary btn-sm pull-right" name="name" value="Search">
                    </form>
                </div>
            </div>

            <form action="index.html" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="student" value="{{ $id or '' }}">

                @include('registrar.registration_form')

            </form>

        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/handlebars-v3.0.1.js') }}"></script>
    <script src="{{ asset('assets/js/search_for_student.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select[name=course], select[name=major]').select2();
        });
    </script>
@endsection
