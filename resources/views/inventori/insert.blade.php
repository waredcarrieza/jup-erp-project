@extends('template.main')

<link href="{{ url('/assets/css/jquery.autocomplete.css') }}" rel="stylesheet">
<link href="{{ url('/assets/select2/css/select2.min.css') }}" rel="stylesheet">

<!-- Bootstrap datetimepicker css -->
<link rel="stylesheet" href="{{ url('/assets/bootstrap-datetimepicker/css/bootstrap-datepicker3.min.css') }}">

<style>
.datepicker>.datepicker-days {
    display: block;
}

ol.linenums {
    margin: 0 0 0 -8px;
}
</style>

@section('container')
<div class="container">
	<div class="row mb-2">
		<div class="col-md-12 mt-2">
			<h5>INPUT BARANG INVENTORY</h5>

			<a href="{{ url('/inventori') }}" class="btn btn-sm btn-primary">BACK</a>
		</div><!-- /.col-md-4 -->
	</div><!-- /.row -->

	<form method="post" action="{{ url('/inventori/insert') }}">
	@csrf

	<div class="card mb-3">
		<div class="card-header text-bg-primary">INFORMASI BARANG INVENTORY</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">

					<div class="mb-1 row">
					    <label for="no_produk" class="col-sm-3 col-form-label">NO INVENTORY</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control form-control-sm " id="no_inventory" name="no_inventory" value="">
					    </div>
					</div>

					<div class="mb-1 row">
					    <label for="no_produk" class="col-sm-3 col-form-label">TANGGAL INVENTORY</label>
					    <div class="col-sm-4">
					      <input type="text" name="tanggal_inventory" id="tanggal_inventory" class="form-control form-control-sm" placeholder="dd-mm-yyyy" value="" autocomplete="off" required="" style="width: 30%;" />
					    </div>
					</div>

					<div class="mb-1 row">
					    <label for="no_produk" class="col-sm-3 col-form-label">NO REFERENSI (OPT)</label>
					    <div class="col-sm-4">
					      <input type="text" class="form-control form-control-sm " id="no_referensi" name="no_referensi" value="">
					    </div>
					</div>

					<div class="mb-1 row">
					    <label for="no_produk" class="col-sm-3 col-form-label">NOTE</label>
					    <div class="col-sm-4">
					      <textarea class="form-control form-control-sm " id="note" name="note" rows="4"></textarea>
					    </div>
					</div>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.card-body -->
	</div><!-- /.card -->

	<div class="card">
		<div class="card-header text-bg-secondary">DAFTAR BARANG INVENTORY</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<table class="table" id="detail_item" style="font-size: 13px;">
						<thead>
							<tr class="table-primary">
								<th></th>
								<th>#</th>
								<th>NO PRODUK</th>
								<th>NAMA PRODUK</th>
								<th width="10%">QTY</th>
							</tr>
							<tr>
								<th colspan="7">
									<button type="button" class="btn btn-outline-primary text-primary btn-sm" id="addNewRow" svn="2">TAMBAH DAFTAR BARANG</button>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr id="row_1">
								<td><a role="button" class="btn btn-sm btn-outline-danger text-danger removeItem removeItem_1" data-id="" data-calcid="1" data-subtotal=""><i class="fas fa-times"></i> </a></td>
								<td>1</td>
								<td><input type="text" class="form-control form-control-sm no_produk calc" name="no_produk[]" id="no_produk_1" svn="1" readonly=""></td>
								<td><input type="text" class="form-control form-control-sm name name_1" name="nama_produk[]" id="nama_produk_1" svn="1">
									<input type="hidden" name="product_id[]" id="product_id_1"></td>
								<td><input type="text" class="form-control form-control-sm text-end qty calc" name="item_qty[]" id="item_qty_1" svn="1"></td>
							</tr>
						</tbody>
					</table>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.card-body -->
	</div><!-- /.card -->

	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12 text-end">
					<input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
					<button type="reset" class="btn btn-sm btn-warning">BATAL</button>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.card-body -->
	</div><!-- /.card -->
	
	</form>

</div><!-- /.container -->
@endsection

@section('jsmain')
<script src="{{ url('/assets/js/jquery.autocomplete.js') }}"></script>
<!-- datepicker js -->
<script src="{{ url('/assets/bootstrap-datetimepicker/js/bootstrap-datepicker.min.js') }}"></script>

<!-- select2 Js -->
<script src="{{ url('/assets/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/assets/js/jquery.blockUI.js?v=') }}<?php echo time(); ?>"></script>
<script src="{{ url('/assets/js/jquery.calculation.js') }}"></script>
<script src="{{ url('/assets/js/jquery.formatCurrency-1.4.0.js') }}"></script>

<SCRIPT LANGUAGE="JavaScript">
$.fn.ForceNumericOnly =
	function(){
		return this.each(function(){
			jQuery(this).keydown(function(e){
				var key = e.charCode || e.keyCode || 0;
				// allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
				return (key == 8 || key == 9 ||	key == 46 || (key >= 37 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
			})
		})
	};
</script>
<script>
$(function(){
	$('input').keypress(function (e) {
		var code = null;
		code = (e.keyCode ? e.keyCode : e.which);
		return (code == 13) ? false : true;
	});

    // $("#start_date").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
    // $("#end_date").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});

    $("#tanggal_inventory").datepicker({
    	format: "dd-mm-yyyy",
	    todayBtn: "linked",
	    clearBtn: true,
	    language: "id",
	    autoclose: true,
	    todayHighlight: true
    });

	$(document).on("click", "#addNewRow", function(){
		var num = $(this).attr("svn");
		$('#detail_item').find('tbody').append(
			'<tr id="row_'+num+'">'+
				'<td><a role="button" class="btn btn-sm btn-outline-danger text-danger removeItem removeItem_'+num+'" data-id="" data-calcid="'+num+'" data-subtotal=""><i class="fas fa-times"></i> </a></td>'+
				'<td>'+num+'</td>'+

				'<td><input type="text" class="form-control form-control-sm no_produk calc" name="no_produk[]" id="no_produk_'+num+'" svn="'+num+'" readonly=""></td>'+
				'<td>\
					<input type="text" class="form-control form-control-sm name name_1" name="nama_produk[]" id="nama_produk_'+num+'" svn="'+num+'">\
					<input type="hidden" name="product_id[]" id="product_id_'+num+'"></td>'+
				'<td><input type="text" class="form-control form-control-sm text-end qty calc" name="item_qty[]" id="item_qty_'+num+'" svn="'+num+'"></td>'+
			'</tr>'
		);
		var next_id = (parseInt(num) + 1);
		$("#addNewRow").attr("svn", next_id);
	});

	var _csrftoken = $("#csrf_token").val();
	$(".name").autocomplete("{{ url('/inventori/getproducts?csrftoken=') }}"+_csrftoken, {
		width: 280,
		multiple: false,
		matchContains: true,
	});

	$('.name').result(function(event, data, formatted) {
		var id = $(this).attr('svn');
		var next_id = (parseInt(id) + 1);
		if(data){
			$(".name_"+id).val(data[0]);
			$("#product_id_"+id).val(data[1]);
			$("#no_produk_"+id).val(data[2]);
		}else{
			$(".name_"+id).val('');
			$("#product_id_"+id).val('');
			$("#no_produk_"+id).val(0);
		}
	});

	$(document).on("keyup", ".name", function(){
		var _csrftoken = $("#csrf_token").val();
		$(this).autocomplete("{{ url('/inventori/getproducts?csrftoken=') }}"+_csrftoken, {
			width: 280,
			multiple: false,
			matchContains: true,
		});

		$(this).result(function(event, data, formatted) {
			var id = $(this).attr('svn');
			var next_id = (parseInt(id) + 1);
			if(data){
				$(".name_"+id).val(data[0]);
				$("#product_id_"+id).val(data[1]);
				$("#no_produk_"+id).val(data[2]);
			}else{
				$(".name_"+id).val('');
				$("#product_id_"+id).val('');
				$("#no_produk_"+id).val(0);
			}
		});
	});

	$(document).on("click", ".removeItem", function(){
        var id = $(this).data("id");
        var subtotal = $(this).attr("data-subtotal");
        var calcid = $(this).attr("data-calcid");
        var total_subtotal = $("#total_subtotal").val();

        $.alerts.okButton = '&nbsp;Ya&nbsp;';
        $.alerts.cancelButton = '&nbsp;Tidak&nbsp;';
        jConfirm('Hapus baris item ini ?','Konfirmasi!',function(r){
            if(r){
            	$.blockUI({ 
	                message: $('<img src="/assets/images/loader/dot-loading-spinner-2.gif" align="absmiddle" style="width: 70px;">'),
	                css: {
	                    border: 'none',
	                    padding: '2px',
	                    backgroundColor: 'none'
	                },
	                overlayCSS: {
	                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
	                    opacity: 1,
	                    cursor: 'wait'
	                }
	            });
	            $.unblockUI();
                $("#row_"+calcid).remove();

                var sum_total = parseFloat(total_subtotal) - parseFloat(subtotal);

                $("#total_subtotal").val(sum_total);

				var freight = $("._freight").val();

				var grand_total = sum_total + parseFloat(freight);
				$("#grand_total").val(grand_total);

				var paid = $("#total_paid").val();

				var change_due = parseFloat(paid) - grand_total;
				$("#change_due").val(change_due);

            }else{
                return false;
            }
        });

        $("#popup_content").addClass("prompt-action");
        $("#popup_message").css("padding-left", "70px");
    });
});
</script>
@endsection