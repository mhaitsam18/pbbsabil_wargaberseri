<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/AuthModel', 'AuthModel');
	}
	public function index()
	{
		$data['title'] = "Login User";
		$this->load->view('user/pages/login', $data);
	}
	public function proses_login()
	{
		$no_hp = $this->input->POST('no_hp');
		$no_kk = $this->input->POST('no_kk');
		$data = array(
			'no_hp' => $no_hp,
			'no_kk' => $no_kk,
		);
		$cek_user = $this->AuthModel->login($data);
		if ($cek_user->num_rows() > 0) {
			$this->session->set_userdata($cek_user->row_array());
			$this->session->set_flashdata('flash', 'berhasil');
			redirect(base_url('user'));
		} else {
			$this->session->set_flashdata('status', 'No Telepon atau No KK salah');
			redirect(base_url('user/auth'));
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('user'));
	}
}
