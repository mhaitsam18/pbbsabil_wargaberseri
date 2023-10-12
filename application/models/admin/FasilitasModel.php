<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FasilitasModel extends CI_Model
{

	public function get_fasilitas_single($id)
	{
		return $this->db->get_where('data_fasilitas', array('no' => $id));
	}

	//Cara mengambil data C_fasilitas dari database warga_berseri :
	public function get_fasilitas()
	{
		return $this->db->get('data_fasilitas');
	}

	//Cara menambahkan data ke database warga_berseri :
	public function insert_fasilitas($data)
	{
		$this->db->insert('data_fasilitas', $data);

		// $q = $this->db->insert('data_fasilitas',$data);

		// return $q;
	}

	public function delete_fasilitas($id)
	{
		$this->db->where('no', $id);
		$q = $this->db->delete('data_fasilitas');

		return $q;
	}

	public function update_fasilitas($id, $data)
	{
		$this->db->where('no', $id);
		return $this->db->update('data_fasilitas', $data);
	}
}
