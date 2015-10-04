<div class="container-fluid main-body">
    <div class="row">
        <nav class="navbar navbar-default nav-head" role="navigation">
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
            	<p class="navbar-text top-sign2 navbar-right">Signed in as {{ Session::get('username') }}
	            	<a href="index.php?page=home" class="navbar-link"></a>
	            </p>
            	<p class="navbar-text navbar-right">
	            	<img src="<?php echo asset('assets/images/sample.jpg'); ?>" alt="" class="img-rounded profile_pic">
	            </p>
            </div>
          </div>
        </nav>

        <div class="row">
            <div class="col-md-3 side-bar-menu hidden-print">
                <div class="collapse navbar-collapse">
                    <div class="panel-heading"><h2></h2></div>
                    <?php
                        $user   = Session::get('uid');
                        $menu1  = DB::table('tbl_useroption')->where('userid', $user)->groupBy('header')->orderBy('priors')->get();
                     ?>
                    @foreach ($menu1 as $option)
                        <li class="list-group-item">
                            <a class="menu">
                                <span class="glyphicon glyphicon-th-list"></span>&nbsp;
                                &nbsp;
                                <?php $opt = DB::table('tbl_option_header')->where('id', $option->header)->first(); ?>
                                {{ $opt->name }}
                            </a>
                            <?php $o = DB::table('tbl_useroption')->where('header', $option->header)->where('userid', $user)->orderBY('optionid', 'ASC')->get(); ?>
                            @foreach($o as $oo)
                                <?php $options = App\Option::find($oo->optionid); ?>
                                <ul class="sub-menu">
                                    <li class="li-sub-menu">
                                        <a class="menu" href="{{ $options->link }}">
                                            <span class="glyphicon glyphicon-chevron-right"></span>&nbsp;
                                            &nbsp;
                                            {{ $options->desc }}
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </li>
                    @endforeach

                    <li class="list-group-item hidden-print">
                        <a class="menu" style="cursor: pointer;" id="change_sy_sem">
                            <span class="glyphicon glyphicon-cog"></span>&nbsp;
                              Change School Year & Sem
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- =============================================================================== -->

    <div class="modal fade schoolYear" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="panel">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle close-modal"></span></button>
              <div class="panel-heading"><h4>Add Year and Semester</h4></div>
              <div class="panel-body">
                  <form role="form" method="post" action="index.php?page=addSem">
                    <div class="form-group">
                      <label class="add-label" for="sy">School Year</label>
                      <input type="text" class="form-control" name = "sy" placeholder="school year ">
                    </div>
                    <div class="form-group">
                      <label class="add-label" for="add">Semester</label>
                      <div class="radio col-sm-offset-1">
                          <label>
                            <input type="radio" name="sem" value="1" checked>
                            First Semester
                          </label>
                      </div>
                      <div class="radio col-sm-offset-1">
                          <label>
                            <input type="radio" name="sem" value="2">
                            Second Semester
                          </label>
                      </div>
                    </div>
                    <div class="button-group pull-right">
                      <button type="submit" class="btn btn-primary ">Add</button>
                      <button type="reset" class="btn btn-default ">Reset</button>
                    </div>
                  </form>
              </div>
          </div>
        </div>
      </div>
    </div>
        <!-- changing semester modal -->
        <div class="modal fade" id="modal_sy_sem">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">

                    <form action="sy_sem" id="form_sy_sem">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">School Year & Sem Settings</h3>
                        </div>
                        <div class="modal-body">
                            <p>
                                <div class="col-sm-6">
                                    <input type="number" name="from_sy" max="2015" min="1999" class="form-control" placeholder="To" value="2014">
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" name="to_sy" readonly value="2015" class="form-control" placeholder="From">
                                </div>

                                <div class="form-group center-block" style="width: 150px;">
                                    <label style="margin: 5px -10px;">Semester</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="semester" value="1" checked>
                                                First Semester
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="semester" value="2">
                                                Second Semester
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="semester" value="3">
                                                Summer
                                            </label>
                                        </div>
                                </div>
                            </p>
                            <span class="clearfix"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
