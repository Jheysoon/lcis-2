<div class="alert alert-info center-block" style="max-width:400px;text-align:center">

    @if ($system->classallocationstatus == 99)
         Class Allocation program is finished
    @else
        Classallocation is now in step no. {{ $system->classallocationstatus + 1 }}
    @endif

</div>