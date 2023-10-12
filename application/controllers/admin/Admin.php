<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('admin/Admin_model', 'Admin_model');
		$this->load->model('admin/User_model', 'User_model');
		$this->load->model('admin/DataMaster_model', 'DataMaster_model');
		$this->load->model('admin/Menu_model', 'Menu_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dashboard'] = $this->db->get_where('dashboard', ['id' => 1])->row_array();

		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/admin/index', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function registration()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'this email has already registered!'
		]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
			'is_unique' => 'this Username has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]', [
			'matches' => 'password dont match!',
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('role_id', 'Role', 'required|trim');
		$this->form_validation->set_rules('gender', 'Gander', 'required|trim');
		$this->form_validation->set_rules('place_of_birth', 'Place of Birth', 'required|trim');
		$this->form_validation->set_rules('birthday', 'Birth Day', 'required|trim');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('religion_id', 'Religion', 'required|trim');
		$this->form_validation->set_rules('password2', 'Confrim Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			redirect('admin/admin/dataUser');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'gender' => htmlspecialchars($this->input->post('gender', true)),
				'place_of_birth' => htmlspecialchars($this->input->post('place_of_birth', true)),
				'birthday' => htmlspecialchars($this->input->post('birthday', true)),
				'phone_number' => htmlspecialchars($this->input->post('phone_number', true)),
				'address' => htmlspecialchars($this->input->post('address', true)),
				'religion_id' => htmlspecialchars($this->input->post('religion_id', true)),
				'image' => 'default.svg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => htmlspecialchars($this->input->post('role_id', true)),
				'is_active' => 1,
				'date_created' => date('Y-m-d'),
			];
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $this->input->post('email', true),
				'token' => $token,
				'date_created' => time()
			];
			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			// $this->_sendEmail($token, 'verify');
			$user = $this->db->get_where('user', ['email' => $this->input->post('email', true)])->row_array();

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
	    		Selamat, Akun berhasil dibuat!
	    		</div>');
			redirect('admin/admin/dataUser');
		}
	}

	public function role()
	{
		$data['title'] = "Role Management";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/admin/role', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$this->db->insert('user_role', ['role' => $this->input->post('role')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Role Berhasil Ditambahkan!
				</div>');
			redirect('admin/admin/role');
		}
	}

	public function dataUser()
	{
		$data['title'] = "Data User";
		$data['role'] = $this->db->get('user_role')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['agama'] = $this->db->get('agama')->result_array();
		$this->db->select('*, user_role.id AS rid, user.id AS uid');
		$this->db->from('user');
		$this->db->join('user_role', 'user_role.id = user.role_id');
		$data['user_data'] = $this->db->get()->result_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/admin/data-user', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function deleteDataUser($id)
	{
		$this->db->delete('user', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data User Berhasil Dihapus!
			</div>');
		redirect('admin/admin/dataUser');
	}

	public function setRole()
	{
		$this->db->set('role_id', $this->input->post('role_id'));
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Set User Role Berhasil!
			</div>');
		redirect('admin/admin/dataUser');
	}

	public function roleAccess($role_id)
	{
		$data['title'] = "Role Access";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/admin/role-access', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Access Changed!
			</div>');
	}

	public function getUpdateRole()
	{
		echo json_encode($this->Admin_model->getRoleById($this->input->post('id')));
	}
	public function getUserData()
	{
		echo json_encode($this->Admin_model->getUserById($this->input->post('id')));
	}
	public function updateRole()
	{
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('admin/admin/role');
		} else {
			$data = array('role' => $this->input->post('role'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('user_role', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Role Diperbarui!
				</div>');
			redirect('admin/admin/role');
		}
	}

	public function deleteRole($id)
	{
		$this->db->where('role_id', $id);
		$this->db->delete('user');

		$this->db->where('role_id', $id);
		$this->db->delete('user_access_menu');

		$this->db->where('id', $id);
		$this->db->delete('user_role');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Role Dihapus!
			</div>');
		redirect('admin/admin/role');
	}

	public function strukturOrganisasi()
	{
		$data['title'] = "Struktur Organisasi (Petugas RT)";
		$data['struktur'] = $this->db->get('struktur')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('nama', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('atasan', 'Atasan', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/admin/struktur-organisasi', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/struktur-organisasi';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('struktur', [
						'nama' => $this->input->post('nama'),
						'jabatan' => $this->input->post('jabatan'),
						'parent_id' => $this->input->post('atasan'),
						'foto' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Struktur Berhasil Ditambah!
						</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				}
				redirect('admin/admin/strukturOrganisasi');
			}
		}
	}

	public function updateStruktur()
	{
		$this->form_validation->set_rules('nama', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Position', 'trim|required');
		$this->form_validation->set_rules('atasan', 'Atasan', 'trim|required');
		$struktur = $this->db->get_where('struktur', ['id' => $this->input->post('id')])->row_array();
		if ($this->form_validation->run() == false) {
			redirect('admin/admin/strukturOrganisasi');
		} else {
			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg';
				$config['upload_path'] = './uploads/struktur-organisasi';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')) {
					$old_image = $struktur['foto'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'uploads/struktur-organisasi/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('foto', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/admin/strukturOrganisasi');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('struktur', [
				'nama' => $this->input->post('nama'),
				'jabatan' => $this->input->post('jabatan'),
				'parent_id' => $this->input->post('atasan'),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Struktur Berhasil Diperbarui!
				</div>');
			redirect('admin/admin/strukturOrganisasi');
		}
	}

	public function deleteStruktur($id)
	{
		$this->db->delete('struktur', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Struktur Berhasil Dihapus!
			</div>');
		redirect('admin/admin/strukturOrganisasi');
	}

	public function strukturOrganisasiPetugasKeamanan()
	{
		$data['title'] = "Struktur Organisasi (Petugas Keamanan)";
		$data['petugas_keamanan'] = $this->db->get('petugas_keamanan')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('nama', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('atasan', 'Atasan', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/admin/struktur-organisasi-keamanan', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/struktur-organisasi-keamanan';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('petugas_keamanan', [
						'nama' => $this->input->post('nama'),
						'jabatan' => $this->input->post('jabatan'),
						'parent_id' => $this->input->post('atasan'),
						'foto' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Struktur Petugas Keamanan Berhasil Ditambahkan!
						</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				}
				redirect('admin/admin/strukturOrganisasiPetugasKeamanan');
			}
		}
	}

	public function updateStrukturPetugasKeamanan()
	{
		$this->form_validation->set_rules('nama', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Position', 'trim|required');
		$this->form_validation->set_rules('atasan', 'Atasan', 'trim|required');
		$petugas_keamanan = $this->db->get_where('petugas_keamanan', ['id' => $this->input->post('id')])->row_array();
		if ($this->form_validation->run() == false) {
			redirect('admin/admin/strukturOrganisasiPetugasKeamanan');
		} else {
			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg';
				$config['upload_path'] = './uploads/struktur-organisasi-keamanan';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')) {
					$old_image = $petugas_keamanan['foto'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'uploads/struktur-organisasi-keamanan/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('foto', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/admin/strukturOrganisasiPetugasKeamanan');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('petugas_keamanan', [
				'nama' => $this->input->post('nama'),
				'jabatan' => $this->input->post('jabatan'),
				'parent_id' => $this->input->post('atasan'),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Struktur Petugas Keamanan Berhasil Diperbarui!
				</div>');
			redirect('admin/admin/strukturOrganisasiPetugasKeamanan');
		}
	}

	public function deleteStrukturPetugasKeamanan($id)
	{
		$this->db->delete('petugas_keamanan', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Struktur Petugas Keamanan Berhasil Dihapus!
			</div>');
		redirect('admin/admin/strukturOrganisasiPetugasKeamanan');
	}

	public function strukturOrganisasiPetugasRW()
	{
		$data['title'] = "Struktur Organisasi (Petugas RW)";
		$data['petugas_rw'] = $this->db->get('petugas_rw')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
		$this->form_validation->set_rules('atasan', 'Atasan', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/admin/struktur-organisasi-rw', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/struktur-organisasi-rw';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('petugas_rw', [
						'nama' => $this->input->post('nama'),
						'jabatan' => $this->input->post('jabatan'),
						'parent_id' => $this->input->post('atasan'),
						'foto' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Struktur Petugas RW Berhasil Ditambahkan!
						</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				}
				redirect('admin/admin/strukturOrganisasiPetugasRW');
			}
		}
	}

	public function updateStrukturPetugasRW()
	{
		$this->form_validation->set_rules('nama', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'Position', 'trim|required');
		$this->form_validation->set_rules('atasan', 'Atasan', 'trim|required');
		$petugas_keamanan = $this->db->get_where('petugas_rw', ['id' => $this->input->post('id')])->row_array();
		if ($this->form_validation->run() == false) {
			redirect('admin/admin/strukturOrganisasiPetugasRW');
		} else {
			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg';
				$config['upload_path'] = './uploads/struktur-organisasi-rw';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')) {
					$old_image = $petugas_rw['foto'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'uploads/struktur-organisasi-rw/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('foto', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/admin/strukturOrganisasiPetugasRW');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('petugas_rw', [
				'nama' => $this->input->post('nama'),
				'jabatan' => $this->input->post('jabatan'),
				'parent_id' => $this->input->post('atasan'),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Struktur Petugas RW Berhasil Diperbarui!
				</div>');
			redirect('admin/admin/strukturOrganisasiPetugasRW');
		}
	}

	public function deleteStrukturPetugasRW($id)
	{
		$this->db->delete('petugas_rw', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Struktur Petugas RW Berhasil Dihapus!
			</div>');
		redirect('admin/admin/strukturOrganisasiPetugasRW');
	}

	public function pengumuman()
	{
		$data['title'] = "Pengumuman";
		$data['pengumuman'] = $this->db->get('pengumuman')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('isi', 'Isi', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/admin/pengumuman', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/pengumuman';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('pengumuman', [
						'judul' => $this->input->post('judul'),
						'isi' => $this->input->post('isi'),
						'penulis' => $data['user']['name'],
						'waktu_post' => date("Y-m-d H:i:s"),
						'terakhir_diubah' => date("Y-m-d H:i:s"),
						'thumbnail' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Pengumuman Berhasil Ditambahkan!
						</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				}
				redirect('admin/admin/pengumuman');
			}
		}
	}

	public function updatePengumuman()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('isi', 'Isi', 'trim|required');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$pengumuman = $this->db->get_where('pengumuman', ['id' => $this->input->post('id')])->row_array();
		if ($data['user']['name'] != $this->input->post('penulis')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk menyunting pengumuman ini! karena Anda bukan penulisnya.
			</div>');
			redirect('admin/admin/pengumuman');
		} elseif ($this->form_validation->run() == false) {
			redirect('admin/admin/pengumuman');
		} else {
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/pengumuman';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$old_image = $pengumuman['thumbnail'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'uploads/pengumuman/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('thumbnail', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/admin/pengumuman');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('pengumuman', [
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'terakhir_diubah' => date("Y-m-d H:i:s"),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Pengumuman Berhasil Terperbarui!
				</div>');
			redirect('admin/admin/pengumuman');
		}
	}

	public function deletePengumuman($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$pengumuman = $this->db->get_where('pengumuman', ['id' => $id])->row_array();
		if ($data['user']['name'] != $pengumuman['penulis']) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk hapus pengumuman ini! karena Anda bukan penulisnya.
			</div>');
			redirect('admin/admin/pengumuman');
		} else {
			$this->db->delete('pengumuman', ['id' => $id]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Pengumuman Berhasil Dihapus!
			</div>');
			redirect('admin/admin/pengumuman');
		}
	}

	public function Berita()
	{
		$data['title'] = "Berita";
		$data['berita'] = $this->db->get('berita')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('isi', 'Isi', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/admin/berita', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/berita';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('berita', [
						'judul' => $this->input->post('judul'),
						'isi' => $this->input->post('isi'),
						'penulis' => $data['user']['name'],
						'waktu_post' => date("Y-m-d H:i:s"),
						'terakhir_diubah' => date("Y-m-d H:i:s"),
						'thumbnail' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Berita Berhasil Ditambahkan!
						</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				}
				redirect('admin/admin/berita');
			}
		}
	}

	public function updateBerita()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('isi', 'Isi', 'trim|required');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$berita = $this->db->get_where('berita', ['id' => $this->input->post('id')])->row_array();
		if ($data['user']['name'] != $this->input->post('penulis')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk menyunting berita ini! karena Anda bukan penulisnya.
			</div>');
			redirect('admin/admin/berita');
		} elseif ($this->form_validation->run() == false) {
			redirect('admin/admin/berita');
		} else {
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/berita';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$old_image = $berita['thumbnail'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'uploads/berita/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('thumbnail', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/admin/berita');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('berita', [
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'terakhir_diubah' => date("Y-m-d H:i:s"),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Berita Berhasil Terperbarui!
				</div>');
			redirect('admin/admin/berita');
		}
	}

	public function deleteBerita($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$berita = $this->db->get_where('berita', ['id' => $id])->row_array();
		if ($data['user']['name'] != $berita['penulis']) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk hapus berita ini! karena Anda bukan penulisnya.
			</div>');
			redirect('admin/admin/berita');
		} else {
			$this->db->delete('berita', ['id' => $id]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Berita Berhasil Terhapus!
			</div>');
			redirect('admin/admin/berita');
		}
	}

	public function peraturan()
	{
		$data['title'] = "Peraturan";
		$data['peraturan'] = $this->db->get('peraturan')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('isi', 'Isi', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/admin/peraturan', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/peraturan';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('peraturan', [
						'judul' => $this->input->post('judul'),
						'isi' => $this->input->post('isi'),
						'penulis' => $data['user']['name'],
						'waktu_post' => date("Y-m-d H:i:s"),
						'terakhir_diubah' => date("Y-m-d H:i:s"),
						'thumbnail' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Peraturan Berhasil Ditambah!
						</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				}
				redirect('admin/admin/peraturan');
			}
		}
	}

	public function updatePeraturan()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('isi', 'Isi', 'trim|required');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$peraturan = $this->db->get_where('peraturan', ['id' => $this->input->post('id')])->row_array();
		if ($data['user']['name'] != $this->input->post('penulis')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk menyunting peraturan ini! karena Anda bukan penulisnya.
			</div>');
			redirect('admin/admin/peraturan');
		} elseif ($this->form_validation->run() == false) {
			redirect('admin/admin/peraturan');
		} else {
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/peraturan';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$old_image = $peraturan['thumbnail'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'uploads/peraturan/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('thumbnail', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/admin/peraturan');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('peraturan', [
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'terakhir_diubah' => date("Y-m-d H:i:s"),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Peraturan Berhasil Terperbarui!
				</div>');
			redirect('admin/admin/peraturan');
		}
	}

	public function deletePeraturan($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$peraturan = $this->db->get_where('peraturan', ['id' => $id])->row_array();
		if ($data['user']['name'] != $peraturan['penulis']) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk hapus peraturan ini! karena Anda bukan penulisnya.
			</div>');
			redirect('admin/admin/peraturan');
		} else {
			$this->db->delete('peraturan', ['id' => $id]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Peraturan Berhasil Dihapus!
			</div>');
			redirect('admin/admin/peraturan');
		}
	}

	public function notulensi()
	{
		$data['title'] = "Notulensi";
		$data['notulensi'] = $this->db->get('notulensi')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('isi', 'Isi', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/admin/notulensi', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/notulensi';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$new_image = $this->upload->data('file_name');
					$this->db->insert('notulensi', [
						'judul' => $this->input->post('judul'),
						'isi' => $this->input->post('isi'),
						'penulis' => $data['user']['name'],
						'waktu_post' => date("Y-m-d H:i:s"),
						'terakhir_diubah' => date("Y-m-d H:i:s"),
						'thumbnail' => $new_image
					]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
						Notulensi Berhasil Ditambahkan !
						</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				}
				redirect('admin/admin/notulensi');
			}
		}
	}

	public function updateNotulensi()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('isi', 'Isi', 'trim|required');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$notulensi = $this->db->get_where('notulensi', ['id' => $this->input->post('id')])->row_array();
		if ($data['user']['name'] != $this->input->post('penulis')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk menyunting notulensi ini! karena Anda bukan penulisnya.
			</div>');
			redirect('admin/admin/notulensi');
		} elseif ($this->form_validation->run() == false) {
			redirect('admin/admin/notulensi');
		} else {
			$upload_image = $_FILES['thumbnail']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/notulensi';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('thumbnail')) {
					$old_image = $notulensi['thumbnail'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'uploads/notulensi/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('thumbnail', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('admin/admin/notulensi');
				}
			}
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('notulensi', [
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'terakhir_diubah' => date("Y-m-d H:i:s"),
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Notulensi Berhasil Terperbarui!
				</div>');
			redirect('admin/admin/notulensi');
		}
	}

	public function deleteNotulensi($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$notulensi = $this->db->get_where('notulensi', ['id' => $id])->row_array();
		if ($data['user']['name'] != $notulensi['penulis']) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Anda tidak memiliki hak untuk menghapus notulensi ini! karena Anda bukan penulisnya.
			</div>');
			redirect('admin/admin/notulensi');
		} else {
		$this->db->delete('notulensi', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Notulensi Berhasil Terhapus!
			</div>');
		redirect('admin/admin/notulensi');
		}
	}

	public function musrembang()
	{
		$data['title'] = "Data Musrembang";
		$data['musrembang'] = $this->db->get('musrembang')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('program', 'Program', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('admin/layouts/header', $data);
			$this->load->view('admin/pages/admin/musrembang', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			$this->db->insert('musrembang', [
				'program' => $this->input->post('program'),
				'kegiatan' => $this->input->post('kegiatan'),
				'sasaran' => $this->input->post('sasaran'),
				'volume_lokasi' => $this->input->post('volume_lokasi'),
				'pengusul' => $this->input->post('pengusul'),
				'keterangan' => $this->input->post('keterangan'),
				'status' => $this->input->post('status')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Berhasil Menambah Data Musrembang!
				</div>');
			redirect('admin/admin/musrembang');
		}
	}

	public function updateMusrembang()
	{
		$this->form_validation->set_rules('program', 'Program', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('admin/admin/musrembang');
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('musrembang', [
				'program' => $this->input->post('program'),
				'kegiatan' => $this->input->post('kegiatan'),
				'sasaran' => $this->input->post('sasaran'),
				'volume_lokasi' => $this->input->post('volume_lokasi'),
				'pengusul' => $this->input->post('pengusul'),
				'keterangan' => $this->input->post('keterangan'),
				'status' => $this->input->post('status')
			]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Musrembang Berhasil Diperbarui!
				</div>');
			redirect('admin/admin/musrembang');
		}
	}

	public function deleteMusrembang($id)
	{
		$this->db->delete('musrembang', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Musrembang Berhasil Terhapus!
			</div>');
		redirect('admin/admin/musrembang');
	}

	public function getUpdateMusrembang()
	{
		echo json_encode($this->Admin_model->getMusrembangById($this->input->post('id')));
	}
	public function getUpdatePengumuman()
	{
		echo json_encode($this->Admin_model->getPengumumanById($this->input->post('id')));
	}
	public function getUpdateBerita()
	{
		echo json_encode($this->Admin_model->getBeritaById($this->input->post('id')));
	}
	public function getUpdatePeraturan()
	{
		echo json_encode($this->Admin_model->getPeraturanById($this->input->post('id')));
	}
	public function getUpdateNotulensi()
	{
		echo json_encode($this->Admin_model->getNotulensiById($this->input->post('id')));
	}
	public function getUpdateStruktur($id = null)
	{
		echo json_encode($this->Admin_model->getStrukturById($id));
	}
	public function getUpdateStrukturPetugasKeamanan($id = null)
	{
		echo json_encode($this->Admin_model->getStrukturPetugasKeamananById($id));
	}
	public function getUpdateStrukturPetugasRW($id = null)
	{
		echo json_encode($this->Admin_model->getStrukturPetugasRWById($id));
	}
}
