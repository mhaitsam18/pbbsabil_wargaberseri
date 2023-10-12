<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KeluhanAspirasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('admin/KeluhanAspirasi_Model', 'KeluhanAspirasi_Model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		if ($this->session->userdata('role_id') == 2) {
			redirect('admin/KeluhanAspirasi/kebersihan');
		} elseif ($this->session->userdata('role_id') == 3) {
			redirect('admin/KeluhanAspirasi/kebersihan');
		} elseif ($this->session->userdata('role_id') == 4) {
			redirect('admin/KeluhanAspirasi/fasilitas');
		} elseif ($this->session->userdata('role_id') == 5) {
			redirect('admin/KeluhanAspirasi/olahraga');
		}
		$data['title'] = "Keluhan dan Aspirasi";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['keluhan'] = $this->db->get('keluhan')->result_array();
		$data['aspirasi'] = $this->db->get('aspirasi')->result_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/admin/keluhan-aspirasi', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function kebersihan()
	{
		$data['title'] = "Keluhan dan Aspirasi";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['keluhan'] = $this->db->get_where('keluhan', ['jenis_keluhan' => 'kebersihan'])->result_array();
		$data['aspirasi'] = $this->db->get_where('aspirasi', ['jenis_aspirasi' => 'kebersihan'])->result_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/keluhan-aspirasi/index', $data);
		$this->load->view('admin/layouts/footer');
	}
	public function keamanan()
	{
		$data['title'] = "Keluhan dan Aspirasi";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['keluhan'] = $this->db->get_where('keluhan', ['jenis_keluhan' => 'keamanan'])->result_array();
		$data['aspirasi'] = $this->db->get_where('aspirasi', ['jenis_aspirasi' => 'keamanan'])->result_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/keluhan-aspirasi/index', $data);
		$this->load->view('admin/layouts/footer');
	}
	public function fasilitas()
	{
		$data['title'] = "Keluhan dan Aspirasi";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['keluhan'] = $this->db->get_where('keluhan', ['jenis_keluhan' => 'fasilitas'])->result_array();
		$data['aspirasi'] = $this->db->get_where('aspirasi', ['jenis_aspirasi' => 'fasilitas'])->result_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/keluhan-aspirasi/index', $data);
		$this->load->view('admin/layouts/footer');
	}
	public function olahraga()
	{
		$data['title'] = "Keluhan dan Aspirasi";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['keluhan'] = $this->db->get_where('keluhan', ['jenis_keluhan' => 'olahraga'])->result_array();
		$data['aspirasi'] = $this->db->get_where('aspirasi', ['jenis_aspirasi' => 'olahraga'])->result_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/keluhan-aspirasi/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function clearKeluhan()
	{
		$this->db->truncate('keluhan');
		$this->session->set_flashdata('messageKeluhan', '<div class="alert alert-success" role="alert">
			Complaints Cleared!
			</div>');
		redirect('admin/KeluhanAspirasi');
	}

	public function clearAspirasi()
	{
		$this->db->truncate('aspirasi');
		$this->session->set_flashdata('messageAspirasi', '<div class="alert alert-success" role="alert">
			Aspirations Cleared!
			</div>');
		redirect('admin/KeluhanAspirasi');
	}

	public function deleteKeluhan($id)
	{
		$this->db->delete('keluhan', ['id' => $id]);
		$this->session->set_flashdata('messageKeluhan', '<div class="alert alert-success" role="alert">
			Complain Deleted!
			</div>');
		redirect('admin/KeluhanAspirasi');
	}

	public function deleteAspirasi($id)
	{
		$this->db->delete('aspirasi', ['id' => $id]);
		$this->session->set_flashdata('messageAspirasi', '<div class="alert alert-success" role="alert">
			Aspiration Deleted!
			</div>');
		redirect('admin/KeluhanAspirasi');
	}

	public function updateKeluhan()
	{
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('admin/KeluhanAspirasi/');
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('keluhan', [
				'status' => $this->input->post('status')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Complaint\'s Status Updated!
				</div>');
			redirect('admin/KeluhanAspirasi');
		}
	}

	public function updateAspirasi()
	{
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('admin/KeluhanAspirasi/');
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('aspirasi', [
				'status' => $this->input->post('status')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Aspiration\'s Status Updated!
				</div>');
			redirect('admin/KeluhanAspirasi');
		}
	}

	public function getUpdateKeluhan()
	{
		echo json_encode($this->KeluhanAspirasi_Model->getKeluhanById($this->input->post('id')));
	}
	public function getUpdateAspirasi()
	{
		echo json_encode($this->KeluhanAspirasi_Model->getAspirasiById($this->input->post('id')));
	}
}
