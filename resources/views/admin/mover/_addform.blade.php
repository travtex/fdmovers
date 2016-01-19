<meta name="_token" content="{!! csrf_token() !!}"/>
<div id="moverErrors">
</div>
<form id="addMoverForm" role="form" method="POST">
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" class="form-control" id="first_name" placeholder="First Name">
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" class="form-control" id="last_name" placeholder="Last Name">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" placeholder="Email">
	</div>
	<div class="form-group">
		<label for="hired_at">Hire Date</label>
		<div class="input-group date">
		  <input type="text" class="form-control" id="hired_at"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
		</div>
	</div>
</form>