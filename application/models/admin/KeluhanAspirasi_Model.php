<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KeluhanAspirasi_model extends CI_Model {

	public function getKeluhanById($id)
	{
		return $this->db->get_where('keluhan', ['id' => $id])->row_array();
	}
	public function getAspirasiById($id)
	{
		return $this->db->get_where('aspirasi', ['id' => $id])->row_array();
	}
	
}