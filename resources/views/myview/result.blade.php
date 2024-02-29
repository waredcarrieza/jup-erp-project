@extends('template.main')

@section('container')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>STEP-2</h1>

			<hr />

			<form method="post" action="{{ url('/myresult_2') }}">
				@csrf

				<div class="row mb-3">
					<label class="control-label col-md-2">Nilai X :</label>
					<div class="col-md-3">
						<input type="text" class="form-control form-control-sm" name="var_1" id="var_1" value="{{ $var_1 }}" readonly="" />
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->

				<div class="row mb-3">
					<label class="control-label col-md-2">Nilai Y :</label>
					<div class="col-md-3">
						<input type="text" class="form-control form-control-sm" name="var_2" id="var_2" value="{{ $var_2 }}" readonly="" />
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->

				<hr />

				<p>Field the Matrix</p>

				<?php 
				if($var_1 != '' && $var_2 != ''):
					for($x=0 ; $x<$var_1 ; $x++):
						for($y=0 ; $y<$var_2 ; $y++):
						?>
						<div class="row mb-2">
							<label class="control-label col-md-2">Masukan Nilai untuk matrix ({{ ($x+1) }}, {{ ($y+1) }}) :</label>
							<div class="col-md-3">
								<input type="text" class="form-control form-control-sm" name="var_3[]" id="var_3_{{ $x.'_.$y' }}" />
							</div><!-- /.col-md-6 -->
						</div><!-- /.row -->
						<?php
						endfor;
					endfor;
				endif;
				?>

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