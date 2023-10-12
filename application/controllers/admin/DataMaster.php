<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMaster extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('admin/DataMaster_model', 'DataMaster_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['title'] = "Data Master";
		$data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 7])->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/data-master/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function agama()
	{
		$data['title'] = "Data Agama";
		$data['agama'] = $this->db->get('agama')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('agama', 'Religion Name', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/data-master/data-agama', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$this->db->insert('agama', [
				'agama' => $this->input->post('agama')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				New Religion Added!
				</div>');
			redirect('admin/DataMaster/agama');
		}
	}

	public function konten()
	{
		$data['title'] = "Data Konten";
		$data['content'] = $this->db->get('content')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('header', 'Header', 'trim|required');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/data-master/data-konten', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$this->db->insert('content', [
				'header' => $this->input->post('header'),
				'content' => $this->input->post('content'),
				'footer' => $this->input->post('footer'),
				'last_updated' => date("Y-m-d h:i:sa")
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				New Content Added!
				</div>');
			redirect('admin/DataMaster/konten');
		}
	}

	public function deleteAgama($id)
	{
		$this->db->delete('agama', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Religion Deleted!
			</div>');
		redirect('admin/DataMaster/agama');
	}

	public function deleteKonten($id)
	{
		$this->db->delete('content', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Content Deleted!
			</div>');
		redirect('admin/DataMaster/konten');
	}

	public function updateAgama()
	{
		$this->form_validation->set_rules('agama', 'Religion Name', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('admin/DataMaster/agama');
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('agama', [
				'agama' => $this->input->post('agama')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Religion Updated!
				</div>');
			redirect('admin/DataMaster/agama');
		}
	}

	public function updateKonten()
	{
		$this->form_validation->set_rules('header', 'Header', 'trim|required');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('admin/DataMaster/konten');
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('content', [
				'header' => $this->input->post('header'),
				'content' => $this->input->post('content'),
				'footer' => $this->input->post('footer'),
				'last_updated' => date("Y-m-d h:i:sa")
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Content Updated!
				</div>');
			redirect('admin/DataMaster/konten');
		}
	}

	public function dashboard()
	{
		$data['title'] = "Edit Dashboard Admin";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dashboard'] = $this->db->get_where('dashboard', ['id' => 1])->row_array();
		$this->form_validation->set_rules('header', 'Header', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('footer', 'Footer', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/data-master/data-dashboard', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			//jika ada gambar
			$upload_image = $_FILES['logo']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/logo';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('logo')) {
					$old_image = $data['dashboard']['logo'];
					if ($old_image != 'pbb.png') {
						unlink(FCPATH . 'uploads/logo/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('logo', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/DataMaster/dashboard');
				}
			}

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('dashboard', [
				'header' => $this->input->post('header'),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'footer' => $this->input->post('footer'),
				'side_logo' => $this->input->post('side_logo'),
				'icon' => $this->input->post('icon')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Content Updated!
				</div>');
			redirect('admin/DataMaster/dashboard');
		}
	}

	public function dashboardUser()
	{
		$data['title'] = "Edit Dashboard User";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dashboard'] = $this->db->get_where('dashboard', ['id' => 2])->row_array();
		$this->form_validation->set_rules('header', 'Header', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('footer', 'Footer', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/data-master/data-dashboard', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			//jika ada gambar
			$upload_image = $_FILES['logo']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/logo';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('logo')) {
					$old_image = $data['dashboard']['logo'];
					if ($old_image != 'pbb.png') {
						unlink(FCPATH . 'uploads/logo/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('logo', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/DataMaster/dashboard');
				}
			}

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('dashboard', [
				'header' => $this->input->post('header'),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'footer' => $this->input->post('footer'),
				'side_logo' => $this->input->post('side_logo'),
				'icon' => $this->input->post('icon')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Content Updated!
				</div>');
			redirect('admin/DataMaster/dashboard');
		}
	}

	public function getUpdateAgama()
	{
		echo json_encode($this->DataMaster_model->getAgamaById($this->input->post('id')));
	}
	public function getUpdateKonten()
	{
		echo json_encode($this->DataMaster_model->getKontenById($this->input->post('id')));
	}

}
