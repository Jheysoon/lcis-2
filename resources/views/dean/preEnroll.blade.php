@extends('layouts.master')

@section('title', 'Evaluation')
    
@section('body')
<div class="col-md-3"></div>
<div class="col-md-9">
    <br/>
    <div class="card">
        <div class="card-header card-header-main">
            <h3 class="mdl-color-text--yellow-300">Evaluation</h3>
        </div>
        <div class="card-block">
            <div class="col-md-12">
                {{ $message }}
            </div>

            <div class="col-md-6">
                <label class="lbl-data">STUDENT ID</label>
                <input class="form-control" type="text" readonly value="{{ $registration->user->legacyid }}">
            </div>

            <div class="col-md-6 ">
                <label class="lbl-data">STUDENT NAME</label>
                <input class="form-control" type="text" readonly value="
                {{ $registration->user->lastname.', '.$registration->user->firstname }}">
            </div>

            <div class="col-md-3 ">
                <label class="lbl-data">SCHOOL YEAR</label>
                <input class="form-control" type="text" readonly value="{{ $academicterm->systart.'-'.$academicterm->syend }}">
            </div>

            <div class="col-md-3 ">
                <label class="lbl-data">TERM</label>
                <input class="form-control" type="text" readonly value="{{ $academicterm->term }}">
            </div>

            <div class="col-md-3 ">
                <label class="lbl-data">YEAR LEVEL</label>
                <input class="form-control" type="text" readonly value="<?php print_r($yearlevel) ?>">
            </div>

            <div class="col-md-3 ">
                <label class="lbl-data">CURRICULUM</label>
                <input class="form-control" type="text" readonly value="{{ $registration->curriculum }}">
            </div>

            <div class="col-md-6 ">
                <label class="lbl-data">COURSE</label>
                <input class="form-control" type="text" readonly value="{{ $coursemajor }}">
            </div>

            <div class="col-md-6">
                <br/><br/>
                <!--<a class="btn btn-primary" href="/lc_curriculum/viewcurriculum/<?php //echo $pid; ?>/<?php //echo $dte; ?>/<?php //echo $cid; ?>" target="_blank" style="margin-right:10px">View Curriculum</a> -->
                {{-- other options here --}}

            </div>

            <div class="col-md-12">&nbsp;</div>

            <div class="col-md-12" id="tbl-eval">

            </div>

        <span class="clearfix"></span>
        <br/>
    </div>
</div>
@endsection