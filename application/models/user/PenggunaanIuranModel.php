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

	public function cari_id_penggunaan($data)
	{
		$this->db->like('id_penggunaan', $data);
		return $this->db->get('data_penggunaan_iuran');
	}
	public function getKeuangan()
	{
		
		$this->db->select('bulan, tahun ,cek_pengeluaran(bulan,tahun) as pengeluaran,cek_pemasukan(bulan,tahun) as pemasukan,total_saldo');
		//$this->db->order_by('bulan  asc');
		$this->db->from('data_keuangan_iuran');
		$this->db->where_not_in('tahun', '0000');
		return $this->db->get();
	}
	public function getTotalSaldo()
	{
		$this->db->select('total_saldo');
		$this->db->from('data_keuangan_iuran');
		$this->db->where('tahun', '0000');
		return $this->db->get();
	}
	public function tampilDataPemasukan($bulan)
	{
		$this->db->where('bulan_pemasukan',$bulan);
		return $this->db->get('data_pemasukan_iuran');
	}
	public function tampilDataPenggunaan($bulan)
	{
		$this->db->where('bulan_penggunaan',$bulan);
		return $this->db->get('data_penggunaan_iuran');
	}
	public function getPemasukanPengeluaran($bulan){
		$this->db->select('cek_pengeluaran(bulan,tahun) as pengeluaran,cek_pemasukan(bulan,tahun) as pemasukan,total_saldo');
		//$this->db->order_by('bulan  asc');
		$this->db->from('data_keuangan_iuran');
		$this->db->where('bulan', $bulan);
		return $this->db->get();
	}
}
