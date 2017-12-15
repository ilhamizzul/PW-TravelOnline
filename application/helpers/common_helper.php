<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('squenceSetter'))
{
    function squenceSetter($nama_kolom, $bulan, $tahun)
	{
		$CI = get_instance();
		$CI->load->model('admin_squence_model');

		$result = $CI->admin_squence_model->getLastSquence($nama_kolom, $bulan, $tahun);
			
		// if ($result[1]++ == 0) {
		// 	$CI->admin_squence_model->setNewSquence($nama_kolom, $bulan, $tahun, 1);
		// }else{
		// 	$CI->admin_squence_model->updateSquence($result[0], $result[1]);
		// }

		return $result[1];
	}
}

if (! function_exists('idGenerator')) {
	function idGenerator($nama_kolom,$bulan, $tahun, $digit, $lastNumber)
	{
		$KET = strtoupper(substr($nama_kolom, 0, 3));

		$ZERO = "";
		for ($i=0; $i < $digit; $i++) { 
			$ZERO .= "0";
		}

		// $numb = substr($ZERO.$lastNumber, -$digit);
		$res = substr($ZERO.$lastNumber, -$digit);

		if ($bulan == 0 && $tahun == 0) {
			return $KET.$res;
		}

		return $KET.$bulan.$tahun.$res;
		// return $res;
	}
}

if (! function_exists('setSquenceAndGenerateID')) {
	function setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit)
	{
		$numb = squenceSetter($nama_kolom, $bulan, $tahun);
		$result = idGenerator($nama_kolom,$bulan, $tahun, $digit, $numb );

		return $result;
	}
}

