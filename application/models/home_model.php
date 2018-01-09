<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {


	public function total_record_travel()
	{
		return $this->db->from('jadwal_travel', 'kendaraan_travel', 'travel', 'jenis_kendaraan')
						->count_all_results();
	}

	public function get_data_travel($limit, $offset)
	{
		$this->db->select('*')->from('jadwal_travel')
							  ->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL=jadwal_travel.ID_KENDARAAN_TRAVEL')
							  ->join('travel', 'travel.ID_TRAVEL=kendaraan_travel.ID_TRAVEL')
							  // ->join('detail_desa_travel', 'detail_desa_travel.ID_TRAVEL=travel.ID_TRAVEL')
							  ->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN=kendaraan_travel.ID_JENIS_KENDARAAN')
							  ;

		// $query = $this->db->get($limit, $offset);
		// return $query->result();

		$this->db->order_by('ID_JADWAL_TRAVEL','ASC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get()->result();
		return $query;
		/*return $this->db->order_by('ID_JADWAL_TRAVEL', 'ASC')
						->get('jadwal_travel')
						->result();*/
	}

	public function getSisaKursi($asal,$tujuan,$tanggal_berangkat)
	{
		$this->db->select('
						riwayat_transaksi.ID_JADWAL_TRAVEL,
						riwayat_transaksi.TANGGAL_KEBERANGKATAN,
						jadwal_travel.KOTAT_ASAL, 
						jadwal_travel.KOTA_TUJUAN,
						SUM(riwayat_transaksi.JUMLAH_KURSI) as KURSI_TERBOOKING');

		$this->db->join('jadwal_travel', 'jadwal_travel.ID_JADWAL_TRAVEL = riwayat_transaksi.ID_JADWAL_TRAVEL');
		if ($tanggal_berangkat == "") {
			$this->db->where('TANGGAL_KEBERANGKATAN = DATE( SYSDATE( ) )');
		}else{
			$this->db->where('TANGGAL_KEBERANGKATAN', $tanggal_berangkat);
		}
		if ($tujuan != "") {
			$this->db->where('KOTA_TUJUAN', $tujuan);
		}
		if ($asal != "") {
			$this->db->where('KOTAT_ASAL', $asal);
		}
		$this->db->group_by('riwayat_transaksi.ID_JADWAL_TRAVEL');
		
		return $this->db->get('riwayat_transaksi')->result();
	}

	


	public function get_id_detail_desa_travel()
	{		

	}

	public function get_id_kota_jemput($id)
	{
		return $this->db->select('*')->from('desa')->where('ID_KOTA',$id)->get()->result();
	}

	public function get_id_kota_tujuan()
	{
		$this->db->from('desa NATURAL JOIN detail_desa_travel');
	}

	public function getDetailDesa($id, $asal, $tujuan)
	{
		$this->db->select('*')
		->from('detail_desa_travel')
		->join('desa', 'desa.ID_DESA = detail_desa_travel.ID_DESA')
		->join('kota', 'kota.ID_KOTA = desa.ID_KOTA')
		->join('kendaraan_travel', 'kendaraan_travel.ID_TRAVEL ='.$id)
		->where('ID_TRAVEL', $id);

		$desaasal = $this->db->where('ID_KOTA', $asal)->get()->result();
		$desatujuan = $this->db->where('ID_KOTA', $tujuan)->get()->result();

		return [$desaasal, $desatujuan];
	}

	public function GetAllKotaDesa()
	{
		$this->db->select('*')
				 ->from('detail_desa_travel')
				 ->join('desa', 'desa.ID_DESA = detail_desa_travel.ID_DESA')
				 ->join('kota', 'kota.ID_KOTA = desa.ID_KOTA');

		return $this->db->get()->result();
	}
}

/* End of file home_model.php */
/* Location: ./application/models/home_model.php */