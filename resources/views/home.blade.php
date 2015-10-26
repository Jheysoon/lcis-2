@extends('master')

@section('title' ,'Home')

@section('header')
    <style type="text/css">
        .mdl-card__title-text {
            color: #fff;
        }
    </style>
@endsection

@section('body')
    
    <div class="col-md-9 col-md-offset-3">
        <br/>
        <div class="mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title text-center mdl-color--green-700">
                <h1 class="mdl-card__title-text">Personal Information</h1>
            </div>
            <div class="mdl-card__supporting-text">
                <a data-toggle="modal" data-target=".modal-pic">
                    <img class="profile-main" src="{{ asset('assets/images/sample.jpg') }}">
                </a>
                <br>
                <h3>{{ $user->firstname.' '.$user->lastname }}</h3>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <div class="col-md-12 pad-bottom-10">
                    <div class="col-md-2">ID</div>
                    <div class="col-md-10 text-main-16">{{ $user->legacyid }}</div>
                </div>
                <div class="col-md-12 pad-bottom-10">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-10 text-main-16">{{ $user->firstname.' '.$user->middlename.' '.$user->lastname }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
