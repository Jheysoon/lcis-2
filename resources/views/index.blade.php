@extends('simple')

@section('title', 'Login')

@section('header')
    <style type="text/css">
        .mdl-card {
            width: 330px;   
        }
    </style>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mdl-color--green-900">
                <div class="col-md-8">

                </div>
                <div class = "col-md-4">
                    <form class="form-horizontal" action="/" method="post">
                        <br/>
                        <div class="mdl-card mdl-shadow--4dp">
                            <div class="mdl-card__title mdl-card--expand text-center">
                                <h1 class="mdl-card__title-text text-center">Sign in</h1>
                            </div>
                            <div class="mdl-card__supporting-text">
                                {!! $error !!}
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control floating-label" name="username" id="username" autofocus placeholder="Username" value="{{ request('username') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control floating-label" name="password" id="password" placeholder="Password" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="submit" class="btn btn-success pull-right btn-raised" name="name" value="Sign in">
                                </div>
                            </div>
                        </div>
                        <br/>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
@stop
