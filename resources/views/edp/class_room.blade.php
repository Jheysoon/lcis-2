@extends('master')

@section('title', 'Rooms')

@section('body')
	<div class="col-md-3"></div>
	<div class="col-md-9 body-container">
		<br/>
		<div class="mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title text-center mdl-color--green-700">
                <h1 class="mdl-card__title-text text-center" style="color:#fff">Classrooms</h1>
            </div>
            <div class="mdl-card__supporting-text" style="width:100%">
                <div class="col-md-6">		
					<h4>Class Allocation For The SY:
					{{ $acam->systart.' - '.$acam->syend.' Term:'.$acam->term }}
					</h4>		
				</div>
				<div class="col-md-6">
					<form class="navbar-form navbar-right" action="index.php" method="post" role="search">
				        <div class="form-group">
				          <input type="hidden" name="page" value="search">
				          <input type="text" name="search" class="form-control" placeholder="Search">
				        </div>
				        <button type="submit" class="btn btn-warning">
				        <span class="glyphicon glyphicon-search"></span>
				        </button>
				     </form>
				</div>
				<div class="col-md-12">
					<a href="/add_room" class="btn btn-success btn-sm pull-right">Add Room</a>
					<span class="clearfix"></span>
					<br/>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<tr>
								<th>Room No.</th>
								<th>Campus</th>
								<th>Min. Capacity</th>
								<th>Max. Capacity</th>
								<th>Status</th>
								<th style="width:15%;">Action</th>
							</tr>

							@foreach ($rooms as $room)
								<tr>
									<td> {{ $room->legacycode }} </td>
									<td> {{ $room->location }} </td>
									<td> {{ $room->mincapacity }} </td>
									<td> {{ $room->maxcapacity }} </td>
									<td> {{ $room->status }} </td>
									<td>
										<a class="btn btn-success btn-xs btn-block" href="/room_sched/{{ $room->id }}">View Schedule</a>
									</td>
								</tr>
							@endforeach
							
						</table>
						{!! $rooms->render() !!}
					</div>
				</div>
            </div>
        </div>
	</div>
@endsection