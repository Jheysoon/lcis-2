@extends('master')

@section('title')
    Student Statistics
@stop

@section('body')
    <div class="col-md-3"></div>
    <div class="col-md-9">
        <div class="panel panel-success p-body">
            <div class="panel-heading search">
                <div class="col-md-12">
                    <h4>Student Statistics</h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        @if ($nxt->phase == env('FIN') AND $nxt->classallocationstatus == 0)
                            <div class="alert alert-info center-block" id="confirmBox" style="max-width:400px;">
                                <strong> Do you want to run the student statistics for <br/>
                                <?php $acam = App\Academicterm::find($nxt->nextacademicterm); ?>
                                {{ $acam->systart }} - {{ $acam->syend }} Term: {{ $acam->term }}
                                </strong>
                                <br/>
                                <input type="button" name="btnYes" class="btn btn-primary pull-right" value="Yes">
                                <span class="clearfix">
                            </div>
                        @elseif($nxt->classallocationstatus > 0)
                            <div class="alert alert-danger center-block" style="text-align:center;width:400px;">
                                You have already run this program .... !!!
                            </div>
                        @else
                            <div class="alert alert-danger center-block" style="text-align:center;width:400px;">
                                Current Phase term is not FINALS !!!
                                <br/>
                                You Are unable to run this program...
                            </div>
                        @endif
                        <div id="stat_wrapper" class="hide">
                            <div class="progress" style="height:25px;">
                              <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only"></span>
                                Loading ....
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[name=btnYes]').click(function (e) {
                $('#confirmBox').hide();
                $('#stat_wrapper').removeClass('hide');
                $.post('/load_stat',{},function (data){
                    if(data == 'Not final')
                    {
                        alert('Phase term is not final');
                        $('#confirmBox').show();
                        $('#stat_wrapper').addClass('hide');
                    }
                    else
                    {
                        $('#stat_wrapper').html(data);
                    }
                });
            });
        });
    </script>
@stop
