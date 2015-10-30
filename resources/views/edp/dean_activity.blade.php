<div class="center-block" style="max-width:600px;">
    <div class="alert alert-danger" style="text-align:center;">
        {{ $message }}
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title" style="text-align:center;">
                Dean's Activity
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <td style="text-align:center;">College</td>
                <td style="text-align:center;">Status</td>
                <td style="text-align:center;">Date Completed</td>
            </tr>

            @foreach ($colleges as $college)
                <tr>
                    <td>{{ $college->description }}</td>
                    <td style="text-align:center;">
                        <?php $c = DB::table('tbl_completion')->where('completedby', $college->dean)->where('stage', $stage); ?>
                        
                        @if ($c->count() > 0)
                            <?php $cc = $c->first() ?>

                            @if ($cc->status == 'O')
                                Attested
                            @endif

                        @else
                            Untouched
                        @endif

                    </td>
                    <td style="text-align:center;">

                        @if ($c->count() > 0)
                            {{ $cc->statusdate }}
                        @else
                            Not Available
                        @endif

                    </td>
                </tr>
            @endforeach

            <tr>
                <td>COMPUTER SUBJECTS AND NSTP</td>
                <td style="text-align:center;">
                    <?php $c = DB::table('tbl_completion')->where('completedby', $system->employeeid)->where('stage', $stage); ?>
                    
                    @if ($c->count() > 0)
                        <?php $cc = $c->first() ?>

                        @if ($cc->status == 'O')
                            Attested
                        @endif

                    @else
                        Untouched
                    @endif
                    
                </td>
                <td style="text-align:center;">
                    @if ($c->count() > 0)
                        {{ $cc->statusdate }}
                    @else
                        Not Available'
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
