@extends('simple')

@section('title')
    Login
@stop

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 header">
                <div class="col-md-8">

                </div>
                <div class = "col-md-4">
                    <form class="form-horizontal login" action="/" method="post">
                        <h2 class="sign">
                            <h1 class="text-center">Sign in</h1>
                        </h2>
                        <br/>
                        <?php echo $error ?>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" class="btn btn-success pull-right btn-raised" name="name" value="Sign in">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
@stop
