<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
	public function login($data)
	{
		$this->db->select('*');
		$this->db->from('warga');
		$this->db->join('detail_warga', 'detail_warga.id_warga=warga.id_warga');
		$this->db->where('no_hp', $data['no_hp']);
		$this->db->where('no_kk', $data['no_kk']);
		return $this->db->get();
	}
}
