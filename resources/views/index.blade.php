@extends('simple')

@section('title', 'Login')

@section('header')
    <style type="text/css">
        .mdl-card__supporting-text {
            width: 100%;
        }
        .mdl-card__actions, .mdl-card__supporting-text  {
            background-color: #fff;
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
                        <div class="card pull-right" style="width: 330px;">
                            <div class="card-block">
                                <h2 class="card-title">Sign In</h2>
                            </div>
                            <div class="card-block">
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
        <div class="row">
            <div class="col-sm-4">
                <br/>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Goals</h3>
                    </div>
                    <div class="card-block">
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <br/>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Mission</h3>
                    </div>
                    <div class="card-block">
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <br/>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Vision</h3>
                    </div>
                    <div class="card-block">
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
