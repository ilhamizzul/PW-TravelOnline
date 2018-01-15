<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_transaksi_model extends CI_Model {

	public function get_riwayat_transaksi()
	{
		$this->db->select('*');
		$this->db->from('riwayat_transaksi');
		$this->db->join('member', 'member.ID_MEMBER = riwayat_transaksi.ID_MEMBER');
		$this->db->join('jadwal_travel', 'jadwal_travel.ID_JADWAL_TRAVEL = riwayat_transaksi.ID_JADWAL_TRAVEL');
		$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL');
		$this->db->join('travel', 'travel.ID_TRAVEL = kendaraan_travel.ID_TRAVEL');
		$this->db->order_by('riwayat_transaksi.STATUS', 'DESC');

		if ($this->session->userdata('LEVEL') != 'ADMIN') {
			$this->db->where('travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}
		return $this->db->get()->result();
	}

	public function ubah_status($id)
	{
		$data = array('ID_RIWAYAT_TRANSAKSI' 		=> $this->input->post('id_riwayat_transaksi'),
						'ID_MEMBER' 				=> $this->input->post('id_member'),
						'ID_JADWAL_TRAVEL' 			=> $this->input->post('id_jadwal_travel'),
						'JAM_PESAN'					=> $this->input->post('jam_pesan'),
						'TANGGAL_PEMESANAN' 		=> $this->input->post('tanggal_pemesanan'),
						'TANGGAL_KEBERANGKATAN' 	=> $this->input->post('tanggal_keberangkatan'),
						'BUKTI_BAYAR' 				=> $this->input->post('bukti_bayar'),
						'ALAMAT_PENJEMPUTAN' 		=> $this->input->post('alamat_penjemputan'),
						'ALAMAT_PENURUNAN' 			=> $this->input->post('alamat_penurunan'),
						'JUMLAH_KURSI' 				=> $this->input->post('jumlah_kursi'),
						'TOTAL_BAYAR' 				=> $this->input->post('total_bayar'),
						'STATUS' 					=> $this->input->post('status')
						);

			$this->db->select('*')
					->from('riwayat_transaksi')
					->where('ID_RIWAYAT_TRANSAKSI', $id)
					->update('riwayat_transaksi', $data);

			if ($this->db->affected_rows() > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
	}


}

/* End of file admin_transaksi_model.php */
/* Location: ./application/models/admin_transaksi_model.php */