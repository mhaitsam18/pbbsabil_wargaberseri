<?php defined('BASEPATH') or exit('No direct script access allowed');

class SuratModel extends CI_Model
{
	public function id_pengajuan_surat()
	{
		$pengajuan = "SURAT-";
		$q     = "SELECT MAX(TRIM(REPLACE(id_pengajuan_surat,'SURAT-', ''))) as nama
             FROM pengajuan_surat WHERE id_pengajuan_surat LIKE '$pengajuan%'";
		$baris = $this->db->query($q);
		$akhir = $baris->row()->nama;
		$akhir++;
		$id    = str_pad($akhir, 3, "0", STR_PAD_LEFT);
		$id    = "SURAT-" . $id;
		return $id;
	}

	public function get_nama_warga()
	{
		$id_warga = $this->session->id_warga;
		$this->db->select('nama_warga,id_detail_warga');
		$this->db->from('detail_warga');
		$this->db->where('detail_warga.id_warga', $id_warga);
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$query = $this->db->get();
		return $query;
	}

	public function get_hunian()
	{
		$this->db->select('detail_warga.*');
		$this->db->from('detail_warga');
		$this->db->where('detail_warga.id_detail_warga', $this->session->id_detail_warga);
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$query = $this->db->get();
		return $query;
	}

	public function get_all_template()
	{
		return $this->db->get('surat');
	}

	public function get_pengajuan_surat()
	{
		$id_warga = $this->session->id_warga;
		$this->db->select('id_pengajuan_surat,pengajuan,tanggal_pengajuan,pengajuan_surat.verifikasi_rt,pengajuan_surat.verifikasi_rw,nama_warga');
		$this->db->from('pengajuan_surat');
		$this->db->where('detail_warga.id_warga', $id_warga);
		$this->db->join('detail_warga', 'detail_warga.id_detail_warga = pengajuan_surat.id_detail_warga');
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$query = $this->db->get();
		return $query;
	}

	public function tambah_pengajuan_surat($data)
	{
		$query = $this->db->insert('pengajuan_surat', $data);
		return $query;
	}

	public function download_surat($id_pengajuan_surat)
	{
		$id_detail_warga = $this->session->id_detail_warga;
		$this->db->select('id_pengajuan_surat,nama_warga,pengajuan_surat.rt,pengajuan_surat.rw,no_surat,alamat,
		tempat_lahir,tanggal_lahir,pekerjaan,agama,status_perkawinan,nik,pengajuan,tanggal_pengajuan,tanggal_disetujui,nama_rt,nama_rw');
		$this->db->from('pengajuan_surat');
		$this->db->where('detail_warga.id_detail_warga', $id_detail_warga);
		$this->db->where('id_pengajuan_surat', $id_pengajuan_surat);
		$this->db->join('detail_warga', 'detail_warga.id_detail_warga = pengajuan_surat.id_detail_warga');
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$query = $this->db->get();
		return $query;
	}

	public function get_template_surat($id_template)
	{
		$this->db->select('file_surat');
		$this->db->from('surat');
		$this->db->where('id_surat', $id_template);
		$query = $this->db->get();
		return $query;
	}

	public function hapus_pengajuan_surat($id_pengajuan_surat)
	{
		$this->db->delete('pengajuan_surat', array('id_pengajuan_surat' => $id_pengajuan_surat));
	}
}
