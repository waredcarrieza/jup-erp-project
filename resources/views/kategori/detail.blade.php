@extends('template.main')

<link href="{{ url('/assets/css/jquery.autocomplete.css') }}" rel="stylesheet">

@section('container')
<div class="container">
	<div class="row mb-2">
		<div class="col-md-12 mt-2">
			<h5>RINCIAN PRODUK KATEGORI</h5>

			<a href="{{ url('/kategori') }}" class="btn btn-sm btn-primary">BACK</a>
		</div><!-- /.col-md-4 -->
	</div><!-- /.row -->

	<div class="card mb-3">
		<div class="card-header text-bg-primary">INFORMASI PRODUK KATEGORI</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">

					<div class="mb-1 row">
					    <label for="no_produk" class="col-sm-3 col-form-label">ID PRODUK</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control form-control-sm " id="no_category" name="no_category" value="{!! $dbrow['no_category'] !!}" readonly="">
					    </div>
					</div>

					<div class="mb-1 row">
					    <label for="nama_produk" class="col-sm-3 col-form-label">NAMA KATEGORI</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control form-control-sm" id="nama_category" name="nama_category" value="{!! $dbrow['nama_category'] !!}" readonly="">
					    </div>
					</div>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.card-body -->
	</div><!-- /.card -->

</div><!-- /.container -->
@endsection

@section('jsmain')
@endsection