<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WargaModel extends CI_Model
{

	// ---------------------------Start add id warga & hunian---------------------------
	public function id_warga()
	{
		$warga = "W-PBB-";
		$q     = "SELECT MAX(TRIM(REPLACE(id_warga,'W-PBB-', ''))) as nama
             FROM warga WHERE id_warga LIKE '$warga%'";
		$baris = $this->db->query($q);
		$akhir = $baris->row()->nama;
		$akhir++;
		$id    = str_pad($akhir, 3, "0", STR_PAD_LEFT);
		$id    = "W-PBB-" . $id;
		return $id;
	}

	public function id_detail_warga()
	{
		$warga = "W-";
		$q     = "SELECT MAX(TRIM(REPLACE(id_detail_warga,'W-', ''))) as nama
             FROM detail_warga WHERE id_detail_warga LIKE '$warga%'";
		$baris = $this->db->query($q);
		$akhir = $baris->row()->nama;
		$akhir++;
		$id    = str_pad($akhir, 3, "0", STR_PAD_LEFT);
		$id    = "W-" . $id;
		return $id;
	}
	// ---------------------------End add id warga & hunian---------------------------

	// ---------------------------Start get data---------------------------

	public function get_all_warga()
	{
		$this->db->select('warga.*, nama_warga');
		$this->db->from('warga');
		$this->db->join('detail_warga', 'warga.id_warga = detail_warga.id_warga');
		$this->db->where('status', 'Kepala Keluarga');
		return $this->db->get();
	}

	public function get_all_warga_by_rw($rw)
	{
		$this->db->select('warga.*, nama_warga');
		$this->db->from('warga');
		$this->db->join('detail_warga', 'warga.id_warga = detail_warga.id_warga');
		$this->db->where('status', 'Kepala Keluarga');
		$this->db->where('rw', $rw);
		return $this->db->get();
	}

	public function get_all_warga_by_rt($rt, $rw)
	{
		$this->db->select('warga.*, nama_warga');
		$this->db->from('warga');
		$this->db->join('detail_warga', 'warga.id_warga = detail_warga.id_warga');
		$this->db->where('status', 'Kepala Keluarga');
		$this->db->where('rt', $rt);
		$this->db->where('rw', $rw);
		return $this->db->get();
	}

	public function get_single_warga($id_warga)
	{
		return $this->db->get_where('warga', ['id_warga' => $id_warga]);
	}

	public function get_all_info_warga()
	{
		$this->db->select('*');
		$this->db->from('detail_warga');
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$query = $this->db->get();
		return $query;
	}
	public function get_all_info_warga_by_rt($rt, $rw)
	{
		$this->db->select('*');
		$this->db->from('detail_warga');
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$this->db->where('rt', $rt);
		$this->db->where('rw', $rw);
		$query = $this->db->get();
		return $query;
	}
	public function get_all_info_warga_by_rw($rw)
	{
		$this->db->select('*');
		$this->db->from('detail_warga');
		$this->db->join('warga', 'warga.id_warga = detail_warga.id_warga');
		$this->db->where('rw', $rw);
		$query = $this->db->get();
		return $query;
	}

	public function get_all_penduduk()
	{
		return $this->db->get('detail_warga');
	}

	public function get_single_penduduk($id)
	{
		return $this->db->get_where('detail_warga', ['id_warga' => $id]);
	}

	public function get_hunian($id_detail_warga)
	{
		return $this->db->get_where('detail_warga', ['id_detail_warga' => $id_detail_warga]);
	}

	// ---------------------------End get data----------------------------


	// ---------------------------Start Add data---------------------------
	public function tambah_warga($data_warga)
	{
		return $this->db->insert('warga', $data_warga);
	}
	public function tambah_anggota_warga($data_hunian)
	{
		return $this->db->insert('detail_warga', $data_hunian);
	}
	// ---------------------------End Add data-----------------------------


	// ---------------------------Start update data---------------------------
	public function update_anggota_warga($id_detail_warga, $data)
	{
		$this->db->where('id_detail_warga', $id_detail_warga);
		return $this->db->update('detail_warga', $data);
	}

	public function update_warga($id_warga, $data)
	{
		$this->db->where('id_warga', $id_warga);
		return $this->db->update('warga', $data);
	}
	// ---------------------------End update data---------------------------


	// ---------------------------Start get chart---------------------------
	public function get_chart_pendidikan()
	{
		$this->db->select('pendidikan, COUNT(id_detail_warga) as total');
		$this->db->group_by('pendidikan');
		$this->db->order_by('total', 'desc');
		return $this->db->get('detail_warga');
	}
	public function get_chart_hunian()
	{
		$this->db->select('status_hunian, COUNT(id_detail_warga) as total');
		$this->db->group_by('status_hunian');
		$this->db->order_by('total', 'desc');
		return $this->db->get('detail_warga');
	}
	public function get_chart_desil()
	{
		$this->db->select('status_rumah_tangga, COUNT(id_warga) as total');
		$this->db->group_by('status_rumah_tangga');
		$this->db->order_by('total', 'desc');
		return $this->db->get('warga');
	}
	// ---------------------------End get chart-------------------------------

	// ---------------------------Start delete data---------------------------
	public function hapus_hunian($id_hunian)
	{
		$this->db->delete('detail_warga', array('id_detail_warga' => $id_hunian));
	}

	public function hapus_warga($id_warga)
	{
		$this->db->delete('warga', array('id_warga' => $id_warga));
	}

	// ---------------------------End delete data-----------------------------


}
