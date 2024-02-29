<?php
namespace App\Helpers;
 
class Mainhelpers {
	public static function currencyFormat($value){
		$result = $value;
		return 'Rp ' . $result;
	}

    public static function convertDateTime($date, $format){
		$last_format = date_create($date);
		$new_format = date_format($last_format, $format);
		return $new_format;
	}

	public static function document_type()
	{
		$type = [];

		$type[] = ['id' => 1, 'title' => 'Dokumen Pendukung', 'slug' => 'dokumen-pendukung'];
		$type[] = ['id' => 2, 'title' => 'Dokumen Tambahan', 'slug' => 'dokumen-tambahan'];
		$type[] = ['id' => 3, 'title' => 'Dokumen Lainnya', 'slug' => 'dokumen-lainnya'];

		return $type;
	}

	public static function location_type()
	{
		$type = [];

		$type[] = ['id' => 1, 'title' => 'Kantor Operasional', 'slug' => 'kantor-operasional'];
		$type[] = ['id' => 2, 'title' => 'Proyek', 'slug' => 'proyek'];

		return $type;
	}

}