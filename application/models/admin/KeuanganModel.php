
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KeuanganModel extends CI_Model
{

	public function getKeuangan()
	{
		
		$this->db->select('bulan, tahun,jumlah_warga, jumlah_sudah_bayar, 
 						jumlah_belum_bayar,cek_iuran(bulan,tahun) as saldo,cek_pengeluaran(bulan,tahun) as pengeluaran,cek_pemasukan(bulan,tahun) as pemasukan,total_saldo,cek_tagihan(bulan,tahun) as tagihan');
		//$this->db->order_by('bulan  asc');
		$this->db->from('data_keuangan_iuran');
		$this->db->where_not_in('tahun', '0000');
		return $this->db->get();
	}
	// public function getKeuangan()
	// {
	// 	$this->db->select('bulan, tahun,jumlah_warga, jumlah_sudah_bayar, 
 // 						jumlah_belum_bayar,cek_iuran(bulan,tahun) as saldo,cek_pengeluaran(bulan,tahun) as pengeluaran,cek_pemasukan(bulan,tahun) as pemasukan,total_saldo,cek_tagihan(bulan,tahun) as tagihan, (cek_iuran(bulan,tahun)+cek_pemasukan) as iuran');
	// 	//$this->db->order_by('bulan  asc');
	// 	$this->db->from('data_keuangan_iuran');
	// 	$this->db->where_not_in('tahun', '0000');
	// 	return $this->db->get();
	// }

	public function getTotalSaldo()
	{
		$this->db->select('total_saldo');
		$this->db->from('data_keuangan_iuran');
		$this->db->where('tahun', '0000');
		return $this->db->get();
	}

	public function get_rekap_info($bulan, $tahun)
	{
		$this->db->where('bulan_iuran', $bulan);
		$this->db->where('tahun_iuran', $tahun);
		return $this->db->get('data_iuran_warga');
	}

	public function updateSaldoPem($bulan,$tahun,$data)
	{
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$this->db->update('data_keuangan_iuran', $data);
	}
	public function updateSaldoPeng($bulan,$tahun,$data)
	{
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$this->db->update('data_keuangan_iuran', $data);
	}
	public function updateSaldo($data)
	{
		$this->db->where('tahun','0000');
		$this->db->update('data_keuangan_iuran', $data);
	}

	public function check_bulan_tahun($bulan,$tahun)
	{
		$this->db->select('bulan , tahun');
		$this->db->from('data_keuangan_iuran');
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		return $this->db->get();
	}
}
