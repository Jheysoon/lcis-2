@extends('layouts.master')

@section('title' ,'Home')

@section('body')

    <div class="col-md-9 col-md-offset-3">
        <br/>
        <div class="card">
            <div class="card-header card-header-main">
                <h3 class="mdl-color-text--yellow-300">Personal Information</h3>
            </div>
            <div class="card-block">
                <div class="col-md-9">
                    <br/>
                    <h3>{{ $user->firstname.' '.$user->lastname }}</h3>
                </div>
                <div class="col-md-3">
                    <a data-toggle="modal" data-target=".modal-pic">
                        <img class="profile-main" src="{{ asset('assets/images/sample.jpg') }}">
                    </a>
                </div>
                <span class="clearfix"></span>
            </div>
            <div class="card-footer">
                <div class="col-md-12 pad-bottom-10">
                    <div class="col-md-2">ID</div>
                    <div class="col-md-10 text-main-16">{{ $user->legacyid }}</div>
                </div>
                <div class="col-md-12 pad-bottom-10">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-10 text-main-16">
                        {{ $user->firstname.' '.$user->middlename.' '.$user->lastname }}
                    </div>
                </div>
                <span class="clearfix"></span>
            </div>
        </div>
    </div>
@endsection
