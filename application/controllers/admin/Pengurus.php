<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus extends CI_Controller
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
				redirect('admin/Pengurus/pengumuman');
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
			redirect('admin/Pengurus/pengumuman');
		} elseif ($this->form_validation->run() == false) {
			redirect('admin/Pengurus/pengumuman');
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
					redirect('admin/Pengurus/pengumuman');
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
			redirect('admin/Pengurus/pengumuman');
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
			redirect('admin/Pengurus/pengumuman');
		} else {
			$this->db->delete('pengumuman', ['id' => $id]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Pengumuman Berhasil Dihapus!
			</div>');
			redirect('admin/Pengurus/pengumuman');
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
				redirect('admin/Pengurus/berita');
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
			redirect('admin/Pengurus/berita');
		} elseif ($this->form_validation->run() == false) {
			redirect('admin/Pengurus/berita');
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
					redirect('admin/Pengurus/berita');
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
			redirect('admin/Pengurus/berita');
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
			redirect('admin/Pengurus/berita');
		} else {
			$this->db->delete('berita', ['id' => $id]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Berita Berhasil Terhapus!
			</div>');
			redirect('admin/Pengurus/berita');
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
				redirect('admin/Pengurus/peraturan');
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
			redirect('admin/Pengurus/peraturan');
		} elseif ($this->form_validation->run() == false) {
			redirect('admin/Pengurus/peraturan');
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
					redirect('admin/Pengurus/peraturan');
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
			redirect('admin/Pengurus/peraturan');
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
			redirect('admin/Pengurus/peraturan');
		} else {
			$this->db->delete('peraturan', ['id' => $id]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Peraturan Berhasil Dihapus!
			</div>');
			redirect('admin/Pengurus/peraturan');
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
				redirect('admin/Pengurus/notulensi');
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
			redirect('admin/Pengurus/notulensi');
		} elseif ($this->form_validation->run() == false) {
			redirect('admin/Pengurus/notulensi');
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
					redirect('admin/Pengurus/notulensi');
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
			redirect('admin/Pengurus/notulensi');
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
			redirect('admin/Pengurus/notulensi');
		} else {
		$this->db->delete('notulensi', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Notulensi Berhasil Terhapus!
			</div>');
		redirect('admin/Pengurus/notulensi');
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
			redirect('admin/Pengurus/musrembang');
		}
	}

	public function updateMusrembang()
	{
		$this->form_validation->set_rules('program', 'Program', 'trim|required');
		if ($this->form_validation->run() == false) {
			redirect('admin/Pengurus/musrembang');
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
			redirect('admin/Pengurus/musrembang');
		}
	}

	public function deleteMusrembang($id)
	{
		$this->db->delete('musrembang', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Musrembang Berhasil Terhapus!
			</div>');
		redirect('admin/Pengurus/musrembang');
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
}
