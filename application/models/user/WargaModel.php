<?php defined('BASEPATH') or exit('No direct script access allowed');

class WargaModel extends CI_Model
{
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

	public function get_warga($id_warga)
	{
		return $this->db->get_where('warga', ['id_warga' => $id_warga]);
	}

	public function get_hunian($id_detail_warga)
	{
		return $this->db->get_where('detail_warga', ['id_detail_warga' => $id_detail_warga]);
	}

	public function get_detail_warga($id_warga)
	{
		return $this->db->get_where('detail_warga', ['id_warga' => $id_warga]);
	}

	public function tambah_warga($data_warga)
	{
		return $this->db->insert('warga', $data_warga);
	}

	public function tambah_anggota_warga($data)
	{
		return $this->db->insert('detail_warga', $data);
	}

	public function update_warga($id_warga, $data)
	{
		$this->db->where('id_warga', $id_warga);
		return $this->db->update('warga', $data);
	}

	// ---------------------------Start update data---------------------------
	public function update_anggota_warga($id_detail_warga, $data)
	{
		$this->db->where('id_detail_warga', $id_detail_warga);
		return $this->db->update('detail_warga', $data);
	}

	public function hapus_hunian($id_hunian)
	{
		$this->db->delete('detail_warga', array('id_detail_warga' => $id_hunian));
	}
	// ---------------------------End update data---------------------------
}
