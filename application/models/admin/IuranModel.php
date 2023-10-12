<?php
defined('BASEPATH') or exit('No direct script access allowed');


class IuranModel extends CI_Model
{
	//==============Warga==============//
	public function tambahDataPembayaran($data, $no_tagihan)
	{
		$this->db->where('no_tagihan', $no_tagihan);
		$this->db->update('data_iuran_warga', $data);
	}

	//==============Pengurus==============//
	public function tampilDataPembayaran()
	{	
		$this->db->where_not_in('status_iuran', 'Lunas');
		return $this->db->get('data_iuran_warga');
	}

	public function tampilRiwayatPembayaran()
	{
		$this->db->where('status_iuran', 'Lunas');
		$this->db->order_by('tanggal_pembayaran', 'DESC');
		return $this->db->get('data_iuran_warga');
	}

	public function tambahDataIuran($data)
	{
		$this->db->insert('data_iuran_warga', $data);
	}

	public function check_data_iuran($where, $id_warga)
	{
		$this->db->like('no_tagihan', $where);
		$this->db->like('id_warga', $id_warga);
		return $this->db->get('data_iuran_warga');
	}

	public function check_status($where)
	{
		$this->db->where('id_warga',$where);
		$this->db->select('status_rumah');
		$this->db->from('warga');
		return $this->db->get();
	}
	public function get_kepala_keluarga($where){
		$this->db->where('id_warga', $where);
		$this->db->where('status', 'Kepala Keluarga');
		return $this->db->get('detail_warga');
	}

	public function get_iuran_bytagihan($id)
	{
		$this->db->where('no_tagihan', $id);
		return $this->db->get('data_iuran_warga');
	}

	public function check_data_iuran_bulanan($bulan, $tahun)
	{
		$this->db->where('bulan_iuran', $bulan);
		$this->db->where('tahun_iuran', $tahun);
		return $this->db->get('data_iuran_warga');
	}

	public function data_iuran_lunas_bulanan($bulan, $tahun)
	{
		$this->db->where('bulan_iuran', $bulan);
		$this->db->where('tahun_iuran', $tahun);
		$this->db->where('status_iuran', 'Lunas');
		$this->db->where('jenis', 'wajib');
		return $this->db->get('data_iuran_warga');
	}

	public function getsaldo()
	{
		$this->db->select('total_saldo');
		$this->db->from('data_keuangan_iuran');
		return $this->db->get();
	}

	public function tambah_totalsaldo($data)
	{
		$data_rekap = array('total_saldo' => $data);
		$this->db->insert('data_keuangan_iuran', $data_rekap);
	}


	public function check_totalsaldo()
	{
		$this->db->where('tahun', 0000);
		return $this->db->get('data_keuangan_iuran');
	}

	public function update_totalsaldo($data)
	{
		$data_update = array('total_saldo' => $data);
		// $this->db->where('tahun', 0000);
		$this->db->update('data_keuangan_iuran', $data_update);
	}

	public function check_rekap_iuran_bulanan($bulan, $tahun)
	{
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		return $this->db->get('data_keuangan_iuran');
	}

	public function rekap_iuran_bulanan($data)
	{
		$this->db->update('data_keuangan_iuran', $data);
	}

	public function update_rekap_iruan_bulanan($bulan, $tahun, $data)
	{
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		$this->db->update('data_keuangan_iuran', $data);
	}

	public function editDataPembayaran($data, $id)
	{
		$this->db->like('no_tagihan', $id);
		$this->db->update('data_iuran_warga', $data);
	}

	public function hapusDataPembayaran($id)
	{
		$this->db->like('no_tagihan', $id);
		$this->db->delete('data_iuran_warga');
	}

	public function cari_no_tagihan($data)
	{
		$this->db->like('no_tagihan', $data);
		return $this->db->get('data_iuran_warga');
	}

	public function verifikasi_iuran($no_tagihan)
	{
		$data_iuran = array('status_iuran' => "Lunas");
		$this->db->where('no_tagihan', $no_tagihan);
		$this->db->update('data_iuran_warga', $data_iuran);
	}

	public function tolak_verifikasi($no_tagihan)
	{
		$data_iuran = array('tanggal_pembayaran' => '',
							'bukti_pembayaran' => '',
							'status_iuran'=>'Ditolak');			
		$this->db->where('no_tagihan',$no_tagihan);
		$this->db->update('data_iuran_warga', $data_iuran);

	}

	// public function saldoIuran()
	// {
	// 	$this->db->where('saldo', 0);
	// 	return $this->db->get('data_keuangan_iuran');
	// }

	public function dataIuran($id_warga)
	{
		$this->db->where('id_warga', $id_warga);
		return $this->db->get('data_iuran_warga');
	}



	public function get_IuranWarga_lunas($id)
	{
		$this->db->where('id_warga', $id);
		$this->db->where('status_iuran', 'Lunas');
		return $this->db->get('data_iuran_warga');
	}

	public function get_IuranWarga($id)
	{
		$this->db->where('id_warga', $id);
		$this->db->where_not_in('status_iuran', 'Lunas');
		return $this->db->get('data_iuran_warga');
	}



	public function get_tagihanIuran($id)
	{
		$this->db->where('no_tagihan', $id);
		$this->db->where_not_in('status_iuran', 'Lunas');
		return $this->db->get('data_iuran_warga');
	}

	public function get_nominal_bulanan($bulan,$tahun){
		$this->db->where('bulan_iuran',$bulan);
		$this->db->where('tahun_iuran',$tahun);
		//$this->db->where('status_iuran', 'Lunas');
		$this->db->group_by('status_iuran');
		$this->db->select('SUM(nominal) as total_nominal');
		$this->db->from('data_iuran_warga');
		return $this->db->get();
	}

	public function get_nominal($bulan,$tahun){
		$this->db->where('bulan_iuran',$bulan);
		$this->db->where('tahun_iuran',$tahun);
		$this->db->select('SUM(nominal) as total_nominal');
		$this->db->from('data_iuran_warga');
		return $this->db->get();
	}
	public function nominal($id)
	{
		$this->db->where('id_warga',$id);
		$this->db->select('nominal');
		$this->db->from('data_iuran_warga');
		return $this->db->get();
	}
	public function nominal_tagihan($no_tagihan)
	{
		$this->db->where('no_tagihan',$no_tagihan);
		$this->db->select('nominal');
		$this->db->from('data_iuran_warga');
		return $this->db->get();
		
	}

	public function getBulanBelomLunas($id_warga)
	{
		$this->db->where('id_warga', $id_warga);
		$this->db->where('status_iuran', 'Belum Lunas');
		return $this->db->get('data_iuran_warga');
	}

	public function getBulanWarga($id_warga)
	{
		$this->db->where('id_warga', $id_warga);
		return $this->db->get('data_iuran_warga')->result();
	}

	public function get_nama_admin($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('user');
	}
}
