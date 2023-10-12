<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('admin/User_model', 'User_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['title'] = "My Profile";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/user/index', $data);
		$this->load->view('admin/layouts/footer');
	}


	public function edit()
	{
		$data['title'] = "Edit Profile";
		$this->db->join('agama', 'agama.id = user.religion_id');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$data['agama'] = $this->db->get('agama')->result_array();
		if ($this->form_validation->run() ==  false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/user/edit', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			//jika ada gambar
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg';
				$config['upload_path'] = './uploads/profile';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if ($old_image != 'default.jpg' || $old_image != 'default.svg') {
						unlink(FCPATH . 'uploads/profile/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('user');
				}
			}

			$data = [
				'name' => $this->input->post('name'),
				'gender' => $this->input->post('gender'),
				'place_of_birth' => $this->input->post('place_of_birth'),
				'birthday' => $this->input->post('birthday'),
				'phone_number' => $this->input->post('phone_number'),
				'religion_id' => $this->input->post('religion_id'),
				'address' => $this->input->post('address'),
				'rt' => $this->input->post('rt'),
				'rw' => $this->input->post('rw')
			];
			$this->db->where('email', $email);
			$this->db->update('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Congratulation! Your profile has been updated!
				</div>');
			redirect('admin/user');
		}
	}

	public function delete()
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() ==  false) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				The Password is required.
				</div>');
			redirect('admin/user/edit');
		} else {
			$email = $this->session->userdata('email');
			$password = $this->input->post('password');

			$user = $this->db->get_where('user', ['email' => $email])->row_array();
			$id = $user['id'];

			if (password_verify($password, $user['password'])) {
				$this->db->delete('user', ['id' => $id]);
				redirect('admin/auth/logout');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Wrong Password!
					</div>');
				redirect('admin/user/edit');
			}
		}
	}

	public function changePassword()
	{

		$data['title'] = "Change Password";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_password1', 'New Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('new_password2', 'Repeat New Password', 'trim|required|matches[new_password1]');
		if ($this->form_validation->run() ==  false) {

			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/user/change_password', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password1 = $this->input->post('new_password1');
			$new_password2 = $this->input->post('new_password2');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
				redirect('user/changePassword');
			} else {
				if ($current_password == $new_password1) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
					redirect('user/changePassword');
				} else {
					$password_hash = password_hash($new_password1, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">password changed!</div>');
					redirect('user/changePassword');
				}
			}
		}
	}
}
