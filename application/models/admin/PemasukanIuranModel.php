<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PemasukanIuranModel extends CI_Model
{
	public function tambahDataPemasukan($data)
	{
		$this->db->insert('data_pemasukan_iuran', $data);
	}

	public function tampilDataPemasukan($bulan)
	{
		$this->db->where('bulan_pemasukan',$bulan);
		return $this->db->get('data_pemasukan_iuran');
	}

	public function editDataPemasukan($data, $id)
	{
		$this->db->like('id_pemasukan', $id);
		$this->db->update('data_pemasukan_iuran', $data);
	}

	public function hapusDataPemasukan($id)
	{
		$this->db->like('id_pemasukan', $id);
		$this->db->delete('data_pemasukan_iuran');
	}

	public function get_Pemasukan_byID($id)
	{
		$this->db->where('id_pemasukan', $id);
		return $this->db->get('data_pemasukan_iuran');

	}

	public function pemasukan_bulanan()
	{
		$this->db->select('bulan_pemasukan , tahun_pemasukan,SUM(jumlah_pemasukan) as pemasukan' );
		$this->db->from('data_pemasukan_iuran');
		$this->db->group_by('bulan_pemasukan');
		return $this->db->get();
	}


}
