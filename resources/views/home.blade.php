@include('includes.header', ['title' => 'LCIS - Home'])
<body>
    @include('includes.menu')

    <?php $user = App\Party::find(Session::get('uid')) ?>
	<div class="col-md-9 col-md-offset-3">
		<div class="panel panel-success">
			<div class="panel-heading"><h4>Personal Information</h4></div>
			<div class="panel-body">
				<div class="col-md-12 pic-con">
					<a data-toggle="modal" data-target=".modal-pic">
						<img class="profile-main" src="<?php echo asset('assets/images/sample.jpg'); ?>">
					</a><br>
					<h3>{{ $user->firstname.' '.$user->lastname }}  <!-- <small> (<?php //echo $_SESSION['uname']; ?>)</small> --> </h3>
				</div><hr/>
				<div class="col-md-12 det">
    				<div class="col-md-12 pad-bottom-10">
    					<div class="col-md-2">ID</div>
    					<div class="col-md-10 text-main-16">{{ $user->legacyid }}</div>
    				</div>
    				<div class="col-md-12 pad-bottom-10">
    					<div class="col-md-2">Name</div>
    					<div class="col-md-10 text-main-16">{{ $user->firstname.' '.$user->middlename.' '.$user->lastname }}</div>
    				</div>
				</div>
			</div>
		</div>
	</div>

    @include('includes.footer')
</body>
</html>
