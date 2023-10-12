<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratModel extends CI_Model
{

	public function id_template_surat()
	{
		$template = "S-PBB-";
		$q     = "SELECT MAX(TRIM(REPLACE(id_surat,'S-PBB-', ''))) as nama
             FROM surat WHERE id_surat LIKE '$template%'";
		$baris = $this->db->query($q);
		$akhir = $baris->row()->nama;
		$akhir++;
		$id    = str_pad($akhir, 3, "0", STR_PAD_LEFT);
		$id    = "S-PBB-" . $id;
		return $id;
	}

	public function get_all_pengajuan()
	{
		return  $this->db->get('pengajuan_surat');
	}

	public function get_pengajuan()
	{
		$this->db->select('id_pengajuan_surat,pengajuan,tanggal_pengajuan,pengajuan_surat.verifikasi_rw,
		pengajuan_surat.verifikasi_rt,nama_warga,no_rumah,warga.rt,warga.rw');
		$this->db->from('pengajuan_surat');
		$this->db->join('detail_warga', 'detail_warga.id_detail_warga = pengajuan_surat.id_detail_warga');
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$query = $this->db->get();
		return $query;
	}

	public function get_pengajuan_by_rt($rt, $rw)
	{
		$this->db->select('id_pengajuan_surat,pengajuan,tanggal_pengajuan,pengajuan_surat.verifikasi_rw,
		pengajuan_surat.verifikasi_rt,nama_warga,no_rumah,warga.rt,warga.rw');
		$this->db->from('pengajuan_surat');
		$this->db->join('detail_warga', 'detail_warga.id_detail_warga = pengajuan_surat.id_detail_warga');
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$this->db->where('warga.rt', $rt);
		$this->db->where('warga.rw', $rw);
		$query = $this->db->get();
		return $query;
	}

	public function get_pengajuan_by_rw($rw)
	{
		$this->db->select('id_pengajuan_surat,pengajuan,tanggal_pengajuan,pengajuan_surat.verifikasi_rw,
		pengajuan_surat.verifikasi_rt,nama_warga,no_rumah,warga.rt,warga.rw');
		$this->db->from('pengajuan_surat');
		$this->db->join('detail_warga', 'detail_warga.id_detail_warga = pengajuan_surat.id_detail_warga');
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$this->db->where('warga.rw', $rw);
		$query = $this->db->get();
		return $query;
	}

	public function tambah_surat($id_pengajuan_surat, $data)
	{
		$this->db->where('id_pengajuan_surat', $id_pengajuan_surat);
		return $this->db->update('pengajuan_surat', $data);
	}

	public function update_verifikasi_surat($id_pengajuan_surat, $data)
	{
		$this->db->where('id_pengajuan_surat', $id_pengajuan_surat);
		return $this->db->update('pengajuan_surat', $data);
	}

	public function get_all_template_surat()
	{
		return  $this->db->get('surat');
	}

	public function update_template_surat($id_surat, $data)
	{
		$this->db->where('id_surat', $id_surat);
		return $this->db->update('surat', $data);
	}

	public function get_single_surat($id_template_surat)
	{
		return $this->db->get_where('surat', ['id_surat' => $id_template_surat]);
	}

	public function tambah_template_surat($data)
	{
		return $this->db->insert('surat', $data);
	}

	public function hapus_template_surat($id_template_surat)
	{
		$this->db->delete('surat', ['id_surat' => $id_template_surat]);
	}

	public function get_template_surat($id_template)
	{
		$this->db->select('file_surat');
		$this->db->from('surat');
		$this->db->where('id_surat', $id_template);
		$query = $this->db->get();
		return $query;
	}
}
