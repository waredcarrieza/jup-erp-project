@extends('template.main')

@section('container')
<div class="container">
	<div class="row">
		<div class="col-md-4 mt-2">
			<form method="POST" action="{{ url('/user/login') }}">
				@csrf

				<div class="card">
					<div class="card-header">Login With Email</div>
					<div class="card-body">
						<div class="mb-2 row">
						    <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
						    <div class="col-sm-9">
						      <input type="text" readonly class="form-control form-control-sm  @error('email') is-invalid @enderror" id="staticEmail" name="email" value="admin@jup.com">
		                      @error('email')
		                        <div class="alert alert-danger">{{ $message }}</div>
		                      @enderror
						    </div>
						</div>
						<div class="mb-3 row">
						    <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
						    <div class="col-sm-9">
						      <input type="password" class="form-control form-control-sm  @error('password') is-invalid @enderror" id="inputPassword" name="password" value="p@ssw0rd">
		                      @error('password')
		                        <div class="alert alert-danger">{{ $message }}</div>
		                      @enderror
						    </div>
						</div>
						<div class="row">
							<div class="col-sm-9 offset-sm-3">
								<button type="submit" class="btn btn-sm btn-primary">Submit</button>
							</div>
						</div>
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</form>

			<p>&nbsp;</p>

			<ul style="font-size: 12px;">
				<li>Database PostgreSQL version: <strong>13.7</strong></li>
				<li>PHP version: <strong>{{ phpversion() }}</strong></li>
    			<li>Laravel version: <strong>{{ app()->version() }}</strong></li>
				<li>Silahkan gunakan username <b>admin@jup.com</b> dan password <b>p@ssw0rd</b> untuk login atau silahkan klik tombol <b>Submit</b> langsung untuk masuk ke dalam sistem</li>
			</ul>
		</div><!-- /.col-md-1 -->
	</div><!-- /.row -->
</div><!-- /.container -->
@endsection