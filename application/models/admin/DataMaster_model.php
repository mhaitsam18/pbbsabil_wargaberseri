<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataMaster_model extends CI_Model {

	public function getAgamaById($id)
	{
		return $this->db->get_where('agama', ['id' => $id])->row_array();
	}
	public function getKontenById($id)
	{
		return $this->db->get_where('content', ['id' => $id])->row_array();
	}
	public function getkurirById($id)
	{
		return $this->db->get_where('kurir', ['id' => $id])->row_array();
	}
	public function getKategoriById($id)
	{
		return $this->db->get_where('kategori', ['id' => $id])->row_array();
	}
	
}