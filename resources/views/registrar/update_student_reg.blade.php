@extends('layouts.master')

@section('title', 'Update Student Registration')

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
                <h3 class="mdl-color-text--yellow-300">Update Student Registration</h3>
            </div>
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

            <form action="{{ url('update_student_reg') }}" method="post">
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
    <script>
        $(document).ready(function () {

            $('select[name=course], select[name=major]').select2();

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
