@extends('layouts.master')

@section('title', 'Student Registration')

@section('body')
    <div class="col-md-9 col-sm-9 col-md-offset-3 col-sm-offset-3">
        <br/>
        <div class="card">
            <div class="card-header card-header-main">
                <h3 class="mdl-color-text--yellow-300">Student Registration</h3>
            </div>
            <div class="card-block">
                <h3 class="col-sm-offset-1">Student Information</h3>
                <hr>
                <div class="col-sm-8 col-sm-offset-1">
                    <label>Firstname</label>
                    <input type="text" class="form-control" name="name" value="{{ $firstname }}" readonly>
                    <label>Lastname</label>
                    <input type="text" class="form-control" name="name" value="{{ $lastname }}" readonly>
                </div>
                <span class="clearfix"></span>
            </div>
            <div class="col-sm-12">
                <form action="{{ url('confirm_reg') }}" method="post">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="submit" class="btn btn-success btn-raised pull-right" name="name" value="Confirm">
                </form>
            </div>
        </div>
    </div>
@endsection
