<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function getRoleById($id)
	{
		return $this->db->get_where('user_role', ['id' => $id])->row_array();
	}
	public function getUserById($id)
	{
		return $this->db->get_where('user', ['id' => $id])->row_array();
	}
	public function getPengumumanById($id)
	{
		return $this->db->get_where('pengumuman', ['id' => $id])->row_array();
	}
	public function getBeritaById($id)
	{
		return $this->db->get_where('berita', ['id' => $id])->row_array();
	}
	public function getPeraturanById($id)
	{
		return $this->db->get_where('peraturan', ['id' => $id])->row_array();
	}
	public function getStrukturById($id)
	{
		return $this->db->get_where('struktur', ['id' => $id])->row_array();
	}
	public function getStrukturPetugasKeamananById($id)
	{
		return $this->db->get_where('petugas_keamanan', ['id' => $id])->row_array();
	}
	public function getStrukturPetugasRWById($id)
	{
		return $this->db->get_where('petugas_rw', ['id' => $id])->row_array();
	}
	public function getNotulensiById($id)
	{
		return $this->db->get_where('notulensi', ['id' => $id])->row_array();
	}
	public function getMusrembangById($id)
	{
		return $this->db->get_where('musrembang', ['id' => $id])->row_array();
	}
	
}