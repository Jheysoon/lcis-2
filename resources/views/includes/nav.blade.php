<nav class="navbar mdl-color--green-900 nav-head" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1 ">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div>
                <img class="img-logo" src="<?php echo asset('assets/images/LC Logo.jpg'); ?>">
                <h2 class="hd-title"><a class="title" href="/"> &nbsp;LEYTE COLLEGES Information System</a></h2>
            </div>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav top-sign navbar-right">
                <li class="logout"><a href="/logout">Logout</a></li>
            </ul>

            <p class="navbar-text top-sign2 navbar-right">SY:{{ Session::get('current_sy') }}&nbsp;&nbsp;&nbsp;&nbsp; Term: {{ Session::get('term') }}</p>
        	<p class="navbar-text top-sign2 navbar-right">Signed in as {{ Auth::user()->username }}
            	<a href="index.php?page=home" class="navbar-link"></a>
            </p>
        	<p class="navbar-text navbar-right">
            	<img src="<?php echo asset('assets/images/sample.jpg'); ?>" alt="" class="img-rounded profile_pic">
            </p>
        </div>
    </div>
</nav>