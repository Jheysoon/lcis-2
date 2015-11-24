<div class="card-block">
    <div class="col-md-4 col-md-offset-8">
        <form action="{{ url('search_student') }}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="redirect" value="{{ $redirect }}">
            <input type="text" style="width:250px;" class="form-control" name="student" placeholder="Search for students" value="">
            <input type="submit" class="btn btn-primary btn-sm pull-right" name="name" value="Search">
        </form>
    </div>
</div>