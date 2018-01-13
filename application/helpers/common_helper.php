<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('squenceSetter'))
{
    function squenceSetter($nama_kolom, $bulan, $tahun)
	{
		$CI = get_instance();
		$CI->load->model('admin_squence_model');

		$result = $CI->admin_squence_model->getLastSquence($nama_kolom, $bulan, $tahun);
			
		if ($result[1]++ == 0) {
			$CI->admin_squence_model->setNewSquence($nama_kolom, $bulan, $tahun, 1);
		}else{
			$CI->admin_squence_model->updateSquence($result[0], $result[1]);
		}

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

if (! function_exists('setResultInfo')) {
	function setResultInfo($isError,$message, $data)
	{
		$result = (object) ['isError' => $isError, 'message' => $message, 'data' => $data];

		return $result;
	}
}

if (! function_exists('SetRealDataTravel')) {
	function SetRealDataTravel($globaldata,$filterdata,$minimumsheat)
	{
		foreach ($globaldata as $global => $value) {
            foreach ($filterdata as $filter) {
                if ($value->ID_JADWAL_TRAVEL == $filter->ID_JADWAL_TRAVEL) {
                    $value->JML_KURSI -= $filter->KURSI_TERBOOKING;
                }
            }

            if ($value->JML_KURSI < $minimumsheat) {
                unset($globaldata[$global]);
            }
        }

		return $globaldata;
	}
}

if (! function_exists('SetDateTomorrow')) {
	function SetDateTomorrow()
	{
		$date = date_create();
		date_add($date, date_interval_create_from_date_string('1 days'));
		

		return date_format($date, 'Y-m-d');
	}
}

if (! function_exists('getDifferentTime')) {
	function getDifferentTime($date, $time)
	{
		//Our dates and times.
		$then = $date." ".$time;
		$now = time();
		 
		//convert $then into a timestamp.
		$thenTimestamp = strtotime($then);
		 
		//Get the difference in seconds.
		return $difference = $now - $thenTimestamp;
	}
}


