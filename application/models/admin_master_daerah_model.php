<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_master_daerah_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getDataProvinsi()
	{
		return $this->db->order_by('NAMA_PROVINSI', 'ASC')->get('provinsi')->result();
	}

	public function getDataKota()
	{
		return $this->db->order_by('NAMA_KOTA', 'ASC')->get('kota')->result();
	}

	public function getDataDesa()
	{
		return $this->db->order_by('NAMA_DESA', 'ASC')->get('desa')->result();
	}

	public function chekDataProvinsi()
	{
		$payload = $this->input->post("Data");
		$nama_provinsi = $payload["NAMA_PROVINSI"];
		$data = $this->db->where('NAMA_PROVINSI', $nama_provinsi)->get('provinsi')->result();

		if (count($data)>0) {
			return 'Provinsi'.$nama_provinsi.' sudah terdaftar';
		} else {
			return "";
		}
		
	}

	public function insertProvinsi($id)
	{
		$payload = $this->input->post("Data");
		$data = array(
			'ID_PROVINSI' => $id,
			'NAMA_PROVINSI'=> $payload['NAMA_PROVINSI']
		);

		$this->db->insert('provinsi', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
		
	}

	public function chekDataKota()
	{
		$payload = $this->input->post("Data");
		$id_provinsi = $payload["ID_PROVINSI"];
		$nama_kota = $payload["NAMA_KOTA"];
		$keterangan = $payload["KETERANGAN"];

		$where = '(ID_PROVINSI="'.$id_provinsi.'" and KETERANGAN="'.$keterangan.'" and NAMA_KOTA="'.$nama_kota.'")';
		$data = $this->db->where($where)->get('kota')->result();

		if (count($data)>0) {
			return 'Kota '.$nama_kota.' sudah terdaftar';
		} else {
			return "";
		}
		
	}

	public function insertKota($id)
	{
		$payload = $this->input->post("Data");
		$data = array(
			'ID_KOTA' => $id,
			'NAMA_KOTA'=> $payload['NAMA_KOTA'],
			'ID_PROVINSI' => $payload['ID_PROVINSI'],
			'KETERANGAN' => $payload['KETERANGAN']
		);

		$this->db->insert('kota', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function chekDataDesa()
	{
		$payload = $this->input->post("Data");
		$id_kota = $payload["ID_KOTA"];
		$nama_desa = $payload["NAMA_DESA"];
		$kode_pos = $payload["KODE_POS"];

		$where = '(ID_KOTA="'.$id_kota.'" and KODE_POS="'.$kode_pos.'" and NAMA_DESA="'.$nama_desa.'")';
		$data = $this->db->where($where)->get('desa')->result();

		if (count($data)>0) {
			return 'Desa '.$nama_desa.' sudah terdaftar';
		} else {
			return "";
		}
		
	}

	public function insertDesa($id)
	{
		$payload = $this->input->post("Data");
		$data = array(
			'ID_DESA' => $id,
			'NAMA_DESA'=> $payload['NAMA_DESA'],
			'ID_KOTA' => $payload['ID_KOTA'],
			'KODE_POS' => $payload['KODE_POS']
		);

		$this->db->insert('desa', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function updateProvinsi()
	{
		$payload = $this->input->post("Data");
		$set = array('NAMA_PROVINSI' => $payload['NAMA_PROVINSI']);

		$this->db->where('ID_PROVINSI', $payload['ID_PROVINSI']);
		$this->db->update('provinsi', $set);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
		
	}

	public function updateKota()
	{
		$payload = $this->input->post("Data");
		$set = array(
			'ID_PROVINSI' => $payload['ID_PROVINSI'],
			'NAMA_KOTA' => $payload['NAMA_KOTA'],
			'KETERANGAN' => $payload['KETERANGAN']
		);

		$this->db->where('ID_KOTA', $payload['ID_KOTA']);
		$this->db->update('kota', $set);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
		
	}

	public function updateDesa()
	{
		$payload = $this->input->post("Data");
		$set = array(
			'ID_KOTA' => $payload['ID_KOTA'],
			'NAMA_DESA' => $payload['NAMA_DESA'],
			'KODE_POS' => $payload['KODE_POS']
		);

		$this->db->where('ID_DESA', $payload['ID_DESA']);
		$this->db->update('desa', $set);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
		
	}

	public function deleteProvinsi($id)
	{
		$this->db->where('ID_PROVINSI', $id);
		$this->db->delete('provinsi');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteKota($id)
	{
		$this->db->where('ID_KOTA', $id);
		$this->db->delete('kota');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteDesa($id)
	{
		$this->db->where('ID_DESA', $id);
		$this->db->delete('desa');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file admin_master_daerah_model.php */
/* Location: ./application/models/admin_master_daerah_model.php */