<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AspirasiModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		//Codeigniter : Write Less Do More
	}

	public function getBelumTertangani()
	{
		$this->db->select('COUNT(no_tiket) as jumlah ');
		$this->db->from('data_aspirasi_warga');
		$this->db->where('status_aspirasi', 'BELUM TERTANGANI');
		return $this->db->get();
	}

	public function aspirasi_masuk()
	{
		$this->db->select('no_tiket,data_aspirasi_warga.id_detail_warga,nama_warga,tanggal_aspirasi,jenis_aspirasi,aspirasi,status_aspirasi');
		$this->db->from('data_aspirasi_warga');
		$this->db->join('detail_warga', 'data_aspirasi_warga.id_detail_warga = detail_warga.id_detail_warga');
		$this->db->where('status_aspirasi', 'BELUM TERTANGANI');
		return $this->db->get();
	}

	public function update_aspirasi($notiket, $data)
	{
		$this->db->where('no_tiket', $notiket);
		$this->db->update('data_aspirasi_warga', $data);
	}

	public function dataAspirasi()
	{
		$this->db->where_not_in('status_aspirasi', 'ASPIRASI DITERIMA');
		$this->db->where_not_in('status_aspirasi', 'ASPIRASI DITOLAK');
		return $this->db->get('data_aspirasi_warga');
	}

	public function detail_aspirasi($notiket)
	{
		$this->db->where('no_tiket', $notiket);
		return  $this->db->get('data_aspirasi_warga');
	}
}
