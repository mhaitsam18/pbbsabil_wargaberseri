<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenggunaanIuranModel extends CI_Model
{
	public function tambahDataPenggunaan($data)
	{
		$this->db->insert('data_penggunaan_iuran', $data);
	}

	// public function tampilDataPenggunaan()
	// {
	// 	return $this->db->get('data_penggunaan_iuran');
	// }

	public function editDataPenggunaan($data, $id)
	{
		$this->db->like('id_penggunaan', $id);
		$this->db->update('data_penggunaan_iuran', $data);
	}

	public function hapusDataPenggunaan($id)
	{
		$this->db->like('id_penggunaan', $id);
		$this->db->delete('data_penggunaan_iuran');
	}

	public function get_penggunaan_byID($id)
	{
		$this->db->where('id_penggunaan', $id);
		return $this->db->get('data_penggunaan_iuran');
	}

	// public function penggunaan_bulanan($bulan, $tahun)
	// {
	// 	$this->db->where('bulan_penggunaan', $bulan);
	// 	$this->db->where('tahun_penggunaan', $tahun);
	// 	return $this->db->get('data_penggunaan_iuran');
	// }

	public function tampilDataPenggunaan($bulan)
	{
		$this->db->where('bulan_penggunaan',$bulan);
		return $this->db->get('data_penggunaan_iuran');
	}

	public function penggunaan_bulanan()
	{
		$this->db->select('bulan_penggunaan ,tahun_penggunaan, SUM(jumlah_pengeluaran) as pengeluaran' );
		$this->db->from('data_penggunaan_iuran');
		$this->db->group_by('bulan_penggunaan');
		return $this->db->get();
	}
}
