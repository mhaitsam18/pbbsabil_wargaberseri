<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
	public function login($data)
	{
		$this->db->where('username', $data['username']);
		$this->db->where('password', $data['password']);
		return $this->db->get('admin');
	}
}
