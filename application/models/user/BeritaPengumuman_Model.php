<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BeritaPengumuman_Model extends CI_Model
{

	public function getPengumuman($limit, $start)
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get('pengumuman', $limit, $start)->result_array();
	}

	public function countAllPengumuman()
	{
		return $this->db->get('pengumuman')->num_rows();
	}

	public function getBerita($limit, $start)
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get('berita', $limit, $start)->result_array();
	}

	public function countAllBerita()
	{
		return $this->db->get('berita')->num_rows();
	}
	public function getNotulensi($limit, $start)
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get('notulensi', $limit, $start)->result_array();
	}

	public function countAllNotulensi()
	{
		return $this->db->get('notulensi')->num_rows();
	}

	public function getPeraturan($limit, $start)
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get('peraturan', $limit, $start)->result_array();
	}

	public function countALLPeraturan()
	{
		return $this->db->get('peraturan')->num_rows();
	}
}
