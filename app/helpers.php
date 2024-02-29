<?php 
function approval_status()
{
	$type = [];

	$type[] = ['id' => 1, 'title' => 'Wait', 'slug' => 'wait'];
	$type[] = ['id' => 2, 'title' => 'Verification', 'slug' => 'verification'];
	$type[] = ['id' => 3, 'title' => 'Revision', 'slug' => 'revision'];
	$type[] = ['id' => 4, 'title' => 'Approved', 'slug' => 'approved'];
	$type[] = ['id' => 5, 'title' => 'Rejected', 'slug' => 'rejected'];
	$type[] = ['id' => 6, 'title' => 'Completed', 'slug' => 'completed'];

	return $type;
}

function approval_status_icon($status = '')
{
	$result = '';

	if($status == "wait"):
		$result = '<i class="fas fa-clock"></i> <span class="">'. ucfirst($status) .'</span>';
	elseif($status == "verification"):
		$result = '<i class="fas fa-hourglass"></i> <span class="text-warning">'. ucfirst($status) .'</span>';
	elseif($status == "revision"):
		$result = '<i class="fas fa-bullhorn"></i> <span class="text-warning">'. ucfirst($status) .'</span>';
	elseif($status == "approved"):
		$result = '<i class="fas fa-check"></i> <span class="text-success">'. ucfirst($status) .'</span>';
	elseif($status == "rejected"):
		$result = '<i class="fas fa-times"></i> <span class="text-danger">'. ucfirst($status) .'</span>';
	elseif($status == "completed"):
		$result = '<i class="fas fa-check"></i> <span class="text-primary">'. ucfirst($status) .'</span>';
	endif;

	return $result;
}

function authentication_check()
{
    if (Auth::check() !== true) 
    {
        return redirect('/user/signin')->with('status', 'Sesi login Anda telah kadaluarsa, silahkan Login kembali.')->with('status_alert', 'warning'); exit;
    } 
    elseif (Auth::guest() === true) 
    {
        return redirect('/user/signin')->with('status', 'Anda tidak diizinkan untuk mengakses halaman tanpa proses Login.')->with('status_alert', 'danger'); exit;
    }
    else
    {
        return true;
    }
}

function card_type()
{
	$type = [];

	$type[] = ['id' => 1, 'title' => 'Emiten', 'slug' => 'emiten', 'link' => url('/card/emiten'), 'published' => 'yes'];
	$type[] = ['id' => 2, 'title' => 'Bank Kustodian', 'slug' => 'bank-kustodian', 'link' => url('/card/bank_kustodian'), 'published' => 'yes'];
	$type[] = ['id' => 3, 'title' => 'Agen Jaminan', 'slug' => 'agen-jaminan', 'link' => url('/card/agen_jaminan'), 'published' => 'yes'];
	$type[] = ['id' => 4, 'title' => 'Agen Pembayaran', 'slug' => 'agen-pembayaran', 'link' => url('/card/agen_pembayaran'), 'published' => 'yes'];
	$type[] = ['id' => 5, 'title' => 'Lembaga Rating Perusahaan', 'slug' => 'lembaga-rating-perusahaan', 'link' => url('/card/lembaga_rating_perusahaan'), 'published' => 'yes'];
	$type[] = ['id' => 6, 'title' => 'Lembaga Rating Surat Utang', 'slug' => 'lembaga-rating-surat-utang', 'link' => url('/card/lembaga_rating_surat_utang'), 'published' => 'yes'];
	$type[] = ['id' => 7, 'title' => 'Penjamin Pelaksana Emisi', 'slug' => 'penjamin-pelaksana-emisi', 'link' => url('/card/penjamin_pelaksana_emisi'), 'published' => 'yes'];
	$type[] = ['id' => 8, 'title' => 'Konsultan Hukum', 'slug' => 'konsultan-hukum', 'link' => url('/card/konsultan_hukum'), 'published' => 'yes'];
	$type[] = ['id' => 9, 'title' => 'Auditor', 'slug' => 'auditor', 'link' => url('/card/auditor'), 'published' => 'yes'];
	$type[] = ['id' => 10, 'title' => 'Notaris', 'slug' => 'notaris', 'link' => url('/card/notaris'), 'published' => 'yes'];
	$type[] = ['id' => 11, 'title' => 'Bank', 'slug' => 'bank', 'link' => url('/card/bank'), 'published' => 'yes'];

	return $type;
}

function convertDateTime($date, $format){
	$last_format = date_create($date);
	$new_format = date_format($last_format, $format);
	return $new_format;
}

function SetDateFormatFromID($date,$format){
	$x = explode('-',$date);
	$new = date($format,mktime (0,0,0,$x[1],$x[0],$x[2]));
	return $new;
}

function convertFileSizeUnit($file_size = ''){
	$filesize = '';
	
	if($file_size <= 100000):
		$filesize = round( ( $file_size / 1000 ) , 2, PHP_ROUND_HALF_DOWN ).' KB';
	elseif($file_size > 100000):
		$filesize = round( ( $file_size / 1000000 ) , 2, PHP_ROUND_HALF_DOWN ).' MB';
	endif;
	
	return $filesize;
}

function dataTable_rowsOption()
{
	$optionList = [];

	$optionList[] = ['id' => 1, 'value' => '10', 'is_default' => 'yes'];
	$optionList[] = ['id' => 2, 'value' => '25', 'is_default' => 'no'];
	$optionList[] = ['id' => 3, 'value' => '50', 'is_default' => 'no'];
	$optionList[] = ['id' => 4, 'value' => '100', 'is_default' => 'no'];

	return $optionList;
}

function document_type()
{
	$type = [];

	$type[] = ['id' => 1, 'title' => 'Dokumen Pendukung', 'slug' => 'dokumen-pendukung'];
	$type[] = ['id' => 2, 'title' => 'Dokumen Tambahan', 'slug' => 'dokumen-tambahan'];
	$type[] = ['id' => 3, 'title' => 'Dokumen Lainnya', 'slug' => 'dokumen-lainnya'];

	return $type;
}

function dummy_data_lapkeu(){
	$data = [];

	$data[] = [
		'periode'		=> '2022',
		'lapkeu_name'	=> 'Laporan Neraca Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2022'
	];
	$data[] = [
		'periode'		=> '2022',
		'lapkeu_name'	=> 'Laporan Laba Rugi Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2022'
	];
	$data[] = [
		'periode'		=> '2022',
		'lapkeu_name'	=> 'Laporan Laba Ditahan Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2022'
	];
	$data[] = [
		'periode'		=> '2022',
		'lapkeu_name'	=> 'Laporan Arus Kas Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2022'
	];
	$data[] = [
		'periode'		=> '2022',
		'lapkeu_name'	=> 'Laporan atas Catatan Laporan Keuangan Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2022'
	];
	$data[] = [
		'periode'		=> '2021',
		'lapkeu_name'	=> 'Laporan Neraca Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2021'
	];
	$data[] = [
		'periode'		=> '2021',
		'lapkeu_name'	=> 'Laporan Laba Rugi Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2021'
	];
	$data[] = [
		'periode'		=> '2021',
		'lapkeu_name'	=> 'Laporan Laba Ditahan Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2021'
	];
	$data[] = [
		'periode'		=> '2021',
		'lapkeu_name'	=> 'Laporan Arus Kas Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2021'
	];
	$data[] = [
		'periode'		=> '2021',
		'lapkeu_name'	=> 'Laporan atas Catatan Laporan Keuangan Obligasi PT Perusahaan Terbatas 01 Tbk Tahun 2021'
	];

	return $data;
}

function dummy_detail_laporan_keuangan(){
	$data = [];

	$data[] = [
		'coa_name' 					=> 'Penjualan dan Pendapatan Usaha',
		'coa_is_head'				=> 'yes',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'no',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Pendapatan Usaha',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Beban Pokok Penjualan',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'LABA (RUGI) KOTOR',
		'coa_is_head'				=> 'yes',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'yes',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> '',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'yes',
		'is_sum'					=> 'no',
		'is_value'					=> 'no',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'BEBAN USAHA',
		'coa_is_head'				=> 'yes',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Beban Keuangan',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Beban Cadangan Kerugian Penurunan Nilai',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Keuntungan Pembelian Diskon atas Akuisisi Entitas Anak',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Penghasilan (beban) Lain-Lain',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Bagian Laba Entitas Asosiasi dan Ventura Bersama',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Surplus Revaluasi Properti Investasi',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Beban Pajak Penghasilan Final',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'LABA SEBELUM PAJAK PENGHASILAN BEBAN PAJAK PENGHASILAN',
		'coa_is_head'				=> 'yes',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'yes',
		'is_value'					=> 'yes',
		'total_with'				=> 'before'
	];
	$data[] = [
		'coa_name' 					=> '',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'yes',
		'is_sum'					=> 'no',
		'is_value'					=> 'no',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'Beban Pajak Penghasilan Tidak Final',
		'coa_is_head'				=> 'no',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'no',
		'is_value'					=> 'yes',
		'total_with'				=> ''
	];
	$data[] = [
		'coa_name' 					=> 'LABA BERSIH TAHUN BERJALAN',
		'coa_is_head'				=> 'yes',
		'coa_is_row'				=> 'no',
		'is_sum'					=> 'yes',
		'is_value'					=> 'yes',
		'total_with'				=> 'before'
	];

	return $data;
}

function dummy_data_penerbitan()
{
	$data = [];

	$data[] = [
		'emiten' 					=> 'PT Angkasa Pura',
		'emiten_slug'				=> 'pt-angkasa-pura',
		'nominal_penerbitan'		=> '300000000',
		'pembayaran_kupon'			=> '15',
		'nominal_pembayaran_kupon' 	=> '1500000000',
		'jangka_waktu_penerbitan' 	=> '3',
		'keterangan_peringkat'		=> '100',
		'periode_pembayaran'		=> 'Triwulan',
		'denda'						=> '1.5',
		'mtn_name'					=> 'MTN PT Angkasa Pura Tahun 2019',
		'mtn_category'				=> 'MTN',
		'mtn_type'					=>  'Kas dan Setara Kas'
	];
	$data[] = [
		'emiten' 					=> 'PT Krakatau Engineering Corporation',
		'emiten_slug'				=> 'pt-krakatau-engineering-corporation',
		'nominal_penerbitan'		=> '750000000',
		'pembayaran_kupon'			=> '11.5',
		'nominal_pembayaran_kupon' 	=> '3000000000',
		'jangka_waktu_penerbitan' 	=> '3',
		'keterangan_peringkat'		=> '84',
		'periode_pembayaran'		=> 'Semesteran',
		'denda'						=> '1.89',
		'mtn_name'					=> 'Obligasi PT Krakatau Engineering Corporation Tahun 2020',
		'mtn_category'				=> 'Obligasi',
		'mtn_type'					=>  'Piutang'
	];
	$data[] = [
		'emiten' 					=> 'PT Waskita',
		'emiten_slug'				=> 'pt-waskita',
		'nominal_penerbitan'		=> '1000000000',
		'pembayaran_kupon'			=> '10.25',
		'nominal_pembayaran_kupon' 	=> '7000000000',
		'jangka_waktu_penerbitan' 	=> '3',
		'keterangan_peringkat'		=> '90',
		'periode_pembayaran'		=> 'Tahunan',
		'denda'						=> '2.0',
		'mtn_name'					=> 'Sukuk PT Waskita Tahun 2021',
		'mtn_category'				=> 'Sukuk',
		'mtn_type'					=>  'Persediaan'
	];
	$data[] = [
		'emiten' 					=> 'PT Jasa Marga',
		'emiten_slug'				=> 'pt-jasa-marga',
		'nominal_penerbitan'		=> '300000000',
		'pembayaran_kupon'			=> '15',
		'nominal_pembayaran_kupon' 	=> '1500000000',
		'jangka_waktu_penerbitan' 	=> '3',
		'keterangan_peringkat'		=> '100',
		'periode_pembayaran'		=> 'Triwulan',
		'denda'						=> '1.5',
		'mtn_name'					=> 'Obligasi PT Jasa Marga Tahun 2021',
		'mtn_category'				=> 'Obligasi',
		'mtn_type'					=>  'Kas dan Setara Kas'
	];
	$data[] = [
		'emiten' 					=> 'PT Wisma Baja',
		'emiten_slug'				=> 'pt-wisma-baja',
		'nominal_penerbitan'		=> '750000000',
		'pembayaran_kupon'			=> '11.5',
		'nominal_pembayaran_kupon' 	=> '3000000000',
		'jangka_waktu_penerbitan' 	=> '3',
		'keterangan_peringkat'		=> '84',
		'periode_pembayaran'		=> 'Semesteran',
		'denda'						=> '1.89',
		'mtn_name'					=> 'Obligasi PT Wisma Baja Tahun 2022',
		'mtn_category'				=> 'Obligasi',
		'mtn_type'					=>  'Kas dan Setara Kas' 
	];
	$data[] = [
		'emiten' 					=> 'PT Gudang Garam',
		'emiten_slug'				=> 'pt-gudang-garam',
		'nominal_penerbitan'		=> '1000000000',
		'pembayaran_kupon'			=> '10.25',
		'nominal_pembayaran_kupon' 	=> '7000000000',
		'jangka_waktu_penerbitan' 	=> '3',
		'keterangan_peringkat'		=> '90',
		'periode_pembayaran'		=> 'Tahunan',
		'denda'						=> '2.0',
		'mtn_name'					=> 'MTN PT Gudang Garam Tahun 2019',
		'mtn_category'				=> 'MTN',
		'mtn_type'					=>  'Piutang' 
	];
	$data[] = [
		'emiten' 					=> 'PT Telkom Indonesia Tbk',
		'emiten_slug'				=> 'pt-telkom-indonsesia-tbk',
		'nominal_penerbitan'		=> '1200000000',
		'pembayaran_kupon'			=> '11.25',
		'nominal_pembayaran_kupon' 	=> '8500000000',
		'jangka_waktu_penerbitan' 	=> '4',
		'keterangan_peringkat'		=> '92',
		'periode_pembayaran'		=> 'Tahunan',
		'denda'						=> '1.42',
		'mtn_name'					=> 'Obligasi PT Telkom Indonesia Tbk Tahun 2022',
		'mtn_category'				=> 'Obligasi',
		'mtn_type'					=>  'Kas dan Setara Kas' 
	];
	$data[] = [
		'emiten' 					=> 'PT Astra International Tbk',
		'emiten_slug'				=> 'pt-astra-international-tbk',
		'nominal_penerbitan'		=> '1500000000',
		'pembayaran_kupon'			=> '12.5',
		'nominal_pembayaran_kupon' 	=> '5000000000',
		'jangka_waktu_penerbitan' 	=> '5',
		'keterangan_peringkat'		=> '95',
		'periode_pembayaran'		=> 'Tahunan',
		'denda'						=> '1.44',
		'mtn_name'					=> 'MTN PT Astra International Tbk Tahun 2020',
		'mtn_category'				=> 'MTN',
		'mtn_type'					=>  'Kas dan Setara Kas' 
	];
	$data[] = [
		'emiten' 					=> 'PT Chandra Asri Petrochemical Tbk',
		'emiten_slug'				=> 'pt-chandra-asri-petrochemical-tbk',
		'nominal_penerbitan'		=> '300000000',
		'pembayaran_kupon'			=> '15',
		'nominal_pembayaran_kupon' 	=> '1500000000',
		'jangka_waktu_penerbitan' 	=> '3',
		'keterangan_peringkat'		=> '100',
		'periode_pembayaran'		=> 'Triwulan',
		'denda'						=> '1.5',
		'mtn_name'					=> 'MTN Chandra Asri Petrochemical Tbk Tahun 2021',
		'mtn_category'				=> 'MTN',
		'mtn_type'					=>  'Kas dan Setara Kas'  
	];
	$data[] = [
		'emiten' 					=> 'PT Elang Mahkota Teknologi Tbk',
		'emiten_slug'				=> 'pt-elang-mahkota-teknologi-tbk',
		'nominal_penerbitan'		=> '750000000',
		'pembayaran_kupon'			=> '11.5',
		'nominal_pembayaran_kupon' 	=> '3000000000',
		'jangka_waktu_penerbitan' 	=> '3',
		'keterangan_peringkat'		=> '84',
		'periode_pembayaran'		=> 'Semesteran',
		'denda'						=> '1.89',
		'mtn_name'					=> 'Obligasi PT Elang Mahkota Teknologi Tbk Tahun 2019',
		'mtn_category'				=> 'Obligasi',
		'mtn_type'					=>  'Kas dan Setara Kas'  
	];

	return $data;
}

function location_type()
{
	$type = [];

	$type[] = ['id' => 1, 'title' => 'Kantor Operasional', 'slug' => 'kantor-operasional'];
	$type[] = ['id' => 2, 'title' => 'Proyek', 'slug' => 'proyek'];

	return $type;
}

function survey_type()
{
	$type = [];

	$type[] = ['id' => 1, 'title' => 'On Desk', 'slug' => 'desk'];
	$type[] = ['id' => 2, 'title' => 'On Site', 'slug' => 'site'];
	$type[] = ['id' => 3, 'title' => 'Unknown', 'slug' => 'unknown'];

	return $type;
}

function SetDateFormatFromSQL($date,$format){
	$x = explode('-',$date); # Y-m-d
	$new = date($format,mktime (0,0,0,$x[1],$x[2],$x[0]));
	return $new;
}

function setting_find_index($array, $find, $object){
	$key = array_search($find, array_column($array, $object)); 
	return $key;
}

function currencyFormat($value,$dec=0){
	$res = number_format ($value,$dec,",",".");
	return $res;
}

function defaultCurrencyFormat($value,$dec=0, $thousand_sep=".", $decimal_sep=","){
	$res = number_format ($value, $dec, $decimal_sep, $thousand_sep);
	return $res;
}

function SetFormatCurrencyWithPosition($amount, $symbol, $position, $thousand_sep=".", $decimal_sep=","){
	$value = '';
	if($position == 'left'):
		$value = $symbol. defaultCurrencyFormat($amount, 2, $thousand_sep, $decimal_sep);
	elseif($position == 'left_dot'):
		$value = $symbol .'.'. defaultCurrencyFormat($amount, 2, $thousand_sep, $decimal_sep);
	elseif($position == 'right'):
		$value = defaultCurrencyFormat($amount, 2, $thousand_sep, $decimal_sep).$symbol;
	elseif($position == 'left_space'):
		$value = $symbol.'&nbsp;'. defaultCurrencyFormat($amount, 2, $thousand_sep, $decimal_sep);
	elseif($position == 'left_space_dot'):
		$value = $symbol.'.&nbsp;'. defaultCurrencyFormat($amount, 2, $thousand_sep, $decimal_sep);
	else:
		$value = defaultCurrencyFormat($amount, 2, $thousand_sep, $decimal_sep).'&nbsp;'.$symbol;
	endif;
	return $value;
}

function to_text($x) {
	$x = abs($x);
	$angka = array("", "Satu", "Dua", "Tiga", "Empat", "Lima","Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	$temp = "";
	if ($x <12) {
		$temp = " ". $angka[$x];
	} else if ($x <20) {
		$temp = to_text($x - 10). " Belas";
	} else if ($x <100) {
		$temp = to_text($x/10)." Puluh". to_text($x % 10);
	} else if ($x <200) {
		$temp = " Seratus" . to_text($x - 100);
	} else if ($x <1000) {
		$temp = to_text($x/100) . " Ratus" . to_text($x % 100);
	} else if ($x <2000) {
		$temp = " Seribu" . to_text($x - 1000);
	} else if ($x <1000000) {
		$temp = to_text($x/1000) . " Ribu" . to_text($x % 1000);
	} else if ($x <1000000000) {
		$temp = to_text($x/1000000) . " Juta" . to_text($x % 1000000);
	} else if ($x <1000000000000) {
		$temp = to_text($x/1000000000) . " Milyar" . to_text(fmod($x,1000000000));
	} else if ($x <1000000000000000) {
		$temp = to_text($x/1000000000000) . " Trilyun" . to_text(fmod($x,1000000000000));
	}
	return $temp;
}

function calculated_to_text($x, $style=4){
	if($x<0) {
		$hasil = "minus ". trim(to_text($x));
	} else {
		$hasil = trim(to_text($x));
	}
	switch ($style) {
		case 1:
			$hasil = strtoupper($hasil);
			break;
		case 2:
			$hasil = strtolower($hasil);
			break;
		case 3:
			$hasil = ucwords($hasil);
			break;
		default:
			$hasil = ucfirst($hasil);
			break;
	}
	return $hasil;
}

function romawi($n){
	$hasil = "";
	$iromawi = array("","I","II","III","IV","V","VI","VII","VIII","IX","X",20=>"XX",30=>"XXX",40=>"XL",50=>"L",60=>"LX",70=>"LXX",80=>"LXXX",90=>"XC",100=>"C",200=>"CC",300=>"CCC",400=>"CD",500=>"D",600=>"DC",700=>"DCC",800=>"DCCC",900=>"CM",1000=>"M",2000=>"MM",3000=>"MMM");
	if(array_key_exists($n,$iromawi)){
		$hasil = $iromawi[$n];
	}elseif($n >= 11 && $n <= 99){
		$i = $n % 10;
		$hasil = $iromawi[$n-$i] . Romawi($n % 10);
	}elseif($n >= 101 && $n <= 999){
		$i = $n % 100;
		$hasil = $iromawi[$n-$i] . Romawi($n % 100);
	}else{
		$i = $n % 1000;
		$hasil = $iromawi[$n-$i] . Romawi($n % 1000);
	}
	return $hasil;
}

function NamaHariFromEN($id){
	if($id == "Sunday"):
		$hari = "Minggu";
	elseif($id == "Monday"):
		$hari = "Senin";
	elseif($id == "Tuesday"):
		$hari = "Selasa";
	elseif($id == "Wednesday"):
		$hari = "Rabu";
	elseif($id == "Thursday"):
		$hari = "Kamis";
	elseif($id == "Friday"):
		$hari = "Jumat";
	elseif($id == "Saturday"):
		$hari = "Sabtu";
	endif;
	return($hari);
}

function optionMediaType(){
	$data = [
		[
			'id' => '1',
			'title' => 'Dokumen',
			'slug' => 'document',
			'published' => 'yes'
		],
		[
			'id' => '2',
			'title' => 'Dokumen Rating Perusahaan',
			'slug' => 'dokumen-rating-perusahaan',
			'published' => 'yes'
		],
		[
			'id' => '3',
			'title' => 'Dokumen Rating Surat Hutang',
			'slug' => 'dokumen-rating-surat-hutang',
			'published' => 'yes'
		],
		[
			'id' => '4',
			'title' => 'Foto',
			'slug' => 'image',
			'published' => 'yes'
		],
		[
			'id' => '5',
			'title' => 'Lainnya',
			'slug' => 'other',
			'published' => 'yes'
		],
		[
			'id' => '6',
			'title' => 'Compliance',
			'slug' => 'compliance',
			'published' => 'yes'
		],
		[
			'id' => '7',
			'title' => 'Kunjungan',
			'slug' => 'visit',
			'published' => 'yes'
		],
		[
			'id' => '8',
			'title' => 'Dokumen Jaminan',
			'slug' => 'dokumen-jaminan',
			'published' => 'yes'
		]
	];
	return $data; 
}

function optionWeek(){
	$data = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
	return $data; 
}

function multiKeyExists(array $arr, $key) {

    // is in base array?
    if (array_key_exists($key, $arr)) {
        return true;
    }

    // check arrays contained in this array
    foreach ($arr as $element) {
        if (is_array($element)) {
            if (multiKeyExists($element, $key)) {
                return true;
            }
        }

    }

    return false;
}

function convertFileExtentionToIcon($file_ext = '', $icon_size = ''){
	$icon = '';
	
	$file_word 	= array('.doc', '.docx', '.odt', '.rtf', 'tex', '.txt', '.wks', '.wps', '.wpd');
	$file_pdf 	= array('.pdf', '.csv');
	$file_ppt 	= array('.ppt', '.pptx');
	$file_excel = array('.xls', '.xlsx', '.xlr', '.ods');
	$file_image = array('.jpg', '.JPG', '.jpeg', '.JPEG', '.png', '.PNG', '.gif', '.svg', '.ai', '.bmp', '.ico', '.ps', '.psd', '.tif');
	$file_video = array('.mp4', '.mpeg', '.3g2', '.3gp', '.avi', '.flv', '.h264', '.m4v', '.mkv', '.mov', '.mpg', '.rm', '.swf', '.vob', '.wmv');
	$file_audio = array('.aif', '.cda', '.mid', '.mp3', '.mpa', '.ogg', '.wav', '.wma', '.wpl');
	$file_compress 	= array('.7z', '.arj', '.deb', '.pkg', '.rar', '.zip', '.tar.gz', '.z', '.rpm');
	
	if($file_ext != ''):
		if(in_array($file_ext, $file_pdf)):
			$icon = '<span class="fas fa-file-pdf '. ($icon_size == '' ? 'fa-2x' : '') .'" title="PDF"></span>';
		elseif(in_array($file_ext, $file_ppt)):
			$icon = '<span class="fas fa-file-powerpoint '. ($icon_size == '' ? 'fa-2x' : '') .'" title="POWER POINT"></span>';
		elseif(in_array($file_ext, $file_word)):
			$icon = '<span class="fas fa-file-word '. ($icon_size == '' ? 'fa-2x' : '') .'" title="WORD"></span>';
		elseif(in_array($file_ext, $file_excel)):
			$icon = '<span class="fas fa-file-excel '. ($icon_size == '' ? 'fa-2x' : '') .'" title="EXCEL"></span>';
		elseif(in_array($file_ext, $file_image)):
			$icon = '<span class="fas fa-file-image '. ($icon_size == '' ? 'fa-2x' : '') .'" title="IMAGE"></span>';
		elseif(in_array($file_ext, $file_video)):
			$icon = '<span class="fas fa-file-movie '. ($icon_size == '' ? 'fa-2x' : '') .'" title="MOVIE"></span>';
		elseif(in_array($file_ext, $file_audio)):
			$icon = '<span class="fas fa-file-audio '. ($icon_size == '' ? 'fa-2x' : '') .'" title="AUDIO"></span>';
		elseif(in_array($file_ext, $file_compress)):
			$icon = '<span class="fas fa-file-archive '. ($icon_size == '' ? 'fa-2x' : '') .'" title="ARCHIVE"></span>';
		else:
			$icon = '<span class="fas fa-file'. ($icon_size == '' ? 'fa-2x' : '') .'" title="OTHER FILE"></span>';
		endif;
	else:
		$icon = '<span class="fas fa-file'. ($icon_size == '' ? 'fa-2x' : '') .'" title="OTHER FILE"></span>';
	endif;
	
	return $icon;
}

function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function trim_text($input, $length, $ellipses = true, $strip_tag = true,$strip_style = true) {
    //strip tags, if desired
    if ($strip_tag) {
        $input = strip_tags($input);
    }

    //strip tags, if desired
    if ($strip_style) {
        $input = preg_replace('/(<[^>]+) style=".*?"/i', '$1',$input);
    }

    if($length=='full')
    {

        $trimmed_text=$input;

    }
    else
    {
        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
        return $input;
        }

        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        //add ellipses (...)
        if ($ellipses) {
        $trimmed_text .= '...';
        }       
    }

    return $trimmed_text;
}