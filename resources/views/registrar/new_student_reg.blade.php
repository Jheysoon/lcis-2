@extends('layouts.master')

@section('title', 'New Student Registration')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}" media="screen" title="no title" charset="utf-8">
@endsection

@section('body')
    <div class="col-md-9 col-sm-9 col-md-offset-3 col-sm-offset-3">
        <br/>
        <div class="card">

            @if(Session::has('message'))
                {!! Session::get('message') !!}
            @endif

            <div class="card-header card-header-main">
                <h3 class="mdl-color-text--yellow-300">New Student Registration</h3>
            </div>
            <form action="{{ url('new_student') }}" method="post">

                @include('registrar.registration_form')

            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select[name=course], select[name=major]').select2();
        });
    </script>
@endsection
