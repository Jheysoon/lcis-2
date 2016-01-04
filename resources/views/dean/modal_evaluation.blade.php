@if($subject != '')
    <?php 
        $res = DB::select(
                "SELECT a.*
                    FROM tbl_subject a, tbl_classallocation b
                    WHERE (a.code LIKE '%$subject%'
                        OR a.descriptivetitle LIKE '%$subject%')
                    AND b.academicterm = '$term'
                    AND a.id = b.subject
                    GROUP BY a.id
                    ORDER BY a.code");
    ?>
    
    @if($res)
        <div class="table-responsive col-md-12">
            <table class="table table-bordered">
                    <tr>
                        <th>Code</th>
                        <th>Subject</th>
                        <th>Units</th>
                        <th>Action</th>
                    </tr>
                    @foreach($res as $sub)
                        <?php 
                            $check = DB::table('tbl_studentgrade') ?>
                    @endforeach
            </table>
        </div>
    @endif
    
@endif