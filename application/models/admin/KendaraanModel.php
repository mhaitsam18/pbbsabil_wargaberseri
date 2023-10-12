<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KendaraanModel extends CI_Model
{

	public function id_kendaraan()
	{
		$kendaraan = "K-PBB-";
		$q     = "SELECT MAX(TRIM(REPLACE(id_kendaraan,'K-PBB-', ''))) as nama
             FROM kendaraan WHERE id_kendaraan LIKE '$kendaraan%'";
		$baris = $this->db->query($q);
		$akhir = $baris->row()->nama;
		$akhir++;
		$id    = str_pad($akhir, 3, "0", STR_PAD_LEFT);
		$id    = "K-PBB-" . $id;
		return $id;
	}

	public function get_kendaraan()
	{
		return $this->db->get('kendaraan');
	}

	public function get_all_kendaraan($id_warga)
	{
		return $this->db->get_where('kendaraan', ['id_warga' => $id_warga]);
	}

	public function get_single_kendaraan($id_kendaraan)
	{
		return $this->db->get_where('kendaraan', ['id_kendaraan' => $id_kendaraan]);
	}

	public function tambah_kendaraan($data_kendaraan)
	{
		return $this->db->insert('kendaraan', $data_kendaraan);
	}
	public function get_chart_kendaraan()
	{
		$this->db->select('tipe_kendaraan, COUNT(id_kendaraan) as total');
		$this->db->group_by('tipe_kendaraan');
		$this->db->order_by('total', 'desc');
		return $this->db->get('kendaraan');
	}

	public function hapus_kendaraan($id_kendaraan)
	{
		$this->db->delete('kendaraan', array('id_kendaraan' => $id_kendaraan));
	}

	public function update_kendaraan($id_kendaraan, $data)
	{
		$this->db->where('id_kendaraan', $id_kendaraan);
		return $this->db->update('kendaraan', $data);
	}
}
