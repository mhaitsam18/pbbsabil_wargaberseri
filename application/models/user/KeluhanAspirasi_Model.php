<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KeluhanAspirasi_Model extends CI_Model {

	public function getKeluhanById($id)
	{
		return $this->db->get_where('keluhan', ['id' => $id])->row_array();
	}
	public function getAspirasiById($id)
	{
		return $this->db->get_where('aspirasi', ['id' => $id])->row_array();
	}

	public function insertKeluhan($data)
	{
		$this->db->insert('keluhan', $data);
	}
	public function insertAspirasi($data)
	{
		$this->db->insert('aspirasi', $data);
	}
	
}