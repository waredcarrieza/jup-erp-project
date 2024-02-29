@extends('template.main')

@section('container')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>STEP-1y</h1>

			<hr />

			<form method="post" action="{{ url('/myresult') }}">
				@csrf

				<div class="row mb-3">
					<label class="control-label col-md-2">Masukan Nilai X :</label>
					<div class="col-md-3">
						<input type="text" class="form-control form-control-sm" name="var_1" id="var_1" />
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->

				<div class="row mb-3">
					<label class="control-label col-md-2">Masukan Nilai Y :</label>
					<div class="col-md-3">
						<input type="text" class="form-control form-control-sm" name="var_2" id="var_2" />
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->

				<div class="row">
					<div class="col-md-10 offset-md-2">
						<button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
						<button type="reset" name="reset" class="btn btn-warning btn-sm">Reset</button>
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
			</form>
		</div><!-- /.col-md-1 -->
	</div><!-- /.row -->
</div><!-- /.container -->
@endsection