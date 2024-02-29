@extends('template.main')

<link href="{{ url('/assets/css/jquery.autocomplete.css') }}" rel="stylesheet">

@section('container')
<div class="container">
	<div class="row mb-2">
		<div class="col-md-12 mt-2">
			<h5>EDIT PRODUK ITEM</h5>

			<a href="{{ url('/produk') }}" class="btn btn-sm btn-primary">BACK</a>
		</div><!-- /.col-md-4 -->
	</div><!-- /.row -->

	<form method="post" action="{{ url('/produk/update') }}">
	@csrf

	<div class="card mb-3">
		<div class="card-header text-bg-primary">INFORMASI PRODUK ITEM</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">

					<div class="mb-1 row">
					    <label for="no_produk" class="col-sm-3 col-form-label">ID PRODUK</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control form-control-sm " id="no_produk" name="no_produk" value="{!! $dbrow['no_produk'] !!}">
					    </div>
					</div>

					<div class="mb-1 row">
					    <label for="category_id" class="col-sm-3 col-form-label">KATEGORI PRODUK</label>
					    <div class="col-sm-8">
					      <select name="category_id" id="category_id" class="form-select form-select-sm ft-13" required>
				          	<option value="">-- PILIH KATEGORI PRODUK --</option>
				          	<?php 
				          	if(count($option_category) > 0):
								foreach($option_category as $row):
								?>
								<option value="{!! $row->id !!}" {!! ($row->id == $dbrow['category_id'] ? 'selected="selected"' : '') !!}>{!! $row->no_category .' | '. $row->nama_category !!}</option>
								<?php
								endforeach;
							endif;
							?>
				          </select>
				          @error('is_available')
				            <div class="alert alert-danger">{{ $message }}</div>
				          @enderror
					    </div>
					</div>

					<div class="mb-1 row">
					    <label for="nama_produk" class="col-sm-3 col-form-label">NAMA PRODUK</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control form-control-sm" id="nama_produk" name="nama_produk" value="{!! $dbrow['nama_produk'] !!}">
					    </div>
					</div>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.card-body -->
	</div><!-- /.card -->

	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12 text-end">
					<input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
					<input type="hidden" id="inputId" name="inputId" value="{!! $dbrow['id'] !!}">
					<button type="submit" class="btn btn-sm btn-primary">EDIT</button>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.card-body -->
	</div><!-- /.card -->
	
	</form>

</div><!-- /.container -->
@endsection

@section('jsmain')
@endsection