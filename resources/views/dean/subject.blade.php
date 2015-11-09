@extends('master')

@section('title', 'Subject')

@section('body')
    <div class="col-md-3"></div>
    <div class="col-md-9">
        <br/>
        <div class="mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title text-center mdl-color--green-700">
                <h1 class="mdl-card__title-text mdl-color-text--yellow-300">Subject Information</h1>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="col-md-6">

                    @if($owner == $subject->owner OR ($owner == 1 AND $subject->gesubject == 1))
                        <input type="text" class="form-control" name="name" value="{{ $subject->code }}">
                        <input type="text" class="form-control" name="name" value="{{ $subject->descriptivetitle }}">
                        <input type="text" class="form-control" name="name" value="{{ $subject->units }}">
                    @else
                        <input type="text" class="form-control" readonly name="name" value="{{ $subject->code }}">
                        <input type="text" class="form-control" readonly name="name" value="{{ $subject->descriptivetitle }}">
                        <input type="number" class="form-control text-right" readonly name="name" value="{{ $subject->units }}">
                    @endif

                </div>
                <div class="col-md-6">

                </div>
                <span class="clearfix"></span>
                <a href="{{ url('subject_list') }}" class="btn btn-primary btn-sm pull-right">Back</a>
            </div>
        </div>
    </div>
@endsection
