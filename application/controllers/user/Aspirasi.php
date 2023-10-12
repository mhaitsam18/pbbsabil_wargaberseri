<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aspirasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->id_warga) {
			redirect('user/auth');
		}
		$this->load->model('user/KeluhanAspirasi_Model', 'KeluhanAspirasi_Model');
		$this->load->model('user/BeritaPengumuman_Model', 'BeritaPengumuman_Model');
	}

	//============================== TIKETING ASPIRASI ========================//

	public function index()
	{
		if ($this->session->id_warga) {
			$data['warga'] = $this->db->get_where('detail_warga', ['id_warga' => $this->session->id_warga])->row();
			$data['aspirasi'] = $this->db->get_where('aspirasi', ['no_wa' => $data['warga']->no_hp, 'aktif' => 1])->result();
			$data['keluhan'] = $this->db->get_where('keluhan', ['no_wa' => $data['warga']->no_hp, 'aktif' => 1])->result();
		}
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/aspirasi/input_aspirasi', $data);
		$this->load->view('user/layouts/footer');
	}

	public function input_data_aspirasi()
	{
		
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('no_wa', 'Nomor Whatsapp', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
		$this->form_validation->set_rules('jenis_pesan', 'Jenis Pesan', 'trim|required');
		$this->form_validation->set_rules('isi', 'Isi', 'trim|required');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data['pengumuman_terkini'] = $this->db->get('pengumuman')->row_array();
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data['berita_terkini'] = $this->db->get('berita')->row_array();
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data['peraturan_terkini'] = $this->db->get('peraturan')->row_array();
		if ($this->form_validation->run() == false) {
			$this->load->view('user/layouts/header');
			if ($this->input->post('site') == 'home') {
				$this->load->view('user/pages/index', $data);
			} else {
				$this->load->view('user/pages/aspirasi/input_aspirasi');
			}
			$this->load->view('user/layouts/footer');
		} else {
			$upload_image = $_FILES['bukti']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
				$config['upload_path'] = './uploads/keluhan-aspirasi';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('bukti')) {
					$new_image = $this->upload->data('file_name');
					if ($this->input->post('jenis') == 'Aspirasi') {
						$data = [
							'nama' => $this->input->post('nama'),
							'no_wa' => $this->input->post('no_wa'),
							'jenis_aspirasi' => $this->input->post('jenis_pesan'),
							'aspirasi' => $this->input->post('isi'),
							'status' => 'Belum diproses',
							'waktu_kirim' => date("Y-m-d H:i:s"),
							'bukti' => $new_image,
							'aktif' => 1
						];
						$this->KeluhanAspirasi_Model->insertAspirasi($data);
					} elseif ($this->input->post('jenis') == 'Keluhan') {
						$data = [
							'nama' => $this->input->post('nama'),
							'no_wa' => $this->input->post('no_wa'),
							'jenis_keluhan' => $this->input->post('jenis_pesan'),
							'keluhan' => $this->input->post('isi'),
							'status' => 'Belum diproses',
							'waktu_kirim' => date("Y-m-d H:i:s"),
							'bukti' => $new_image,
							'aktif' => 1
						];
						$this->KeluhanAspirasi_Model->insertKeluhan($data);
					}
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Pesan Terkirim! </div>');
					if ($this->input->post('site') == 'home') {
						redirect('user');
					} else {
						redirect('user/aspirasi');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				}
				redirect('user/aspirasi');
			}
		}
	}

	public function data_aspirasi_warga()
	{
		$data_warga = $this->session->all_userdata();
		$data_aspirasi['aspirasi'] = $this->AspirasiModel->daftar_aspirasi($data_warga['id_detail_warga'])->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/aspirasi/data_aspirasi', $data_aspirasi);
		$this->load->view('user/layouts/footer');
	}

	public function infoAspirasi($id)
	{
		$data['aspirasi'] = $this->AspirasiModel->infoAspirasi($id)->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/aspirasi/detail_aspirasi', $data);
		$this->load->view('user/layouts/footer');
	}

	public function hapusAspirasi($id)
	{
		$this->AspirasiModel->hapusAspirasi($id);
		redirect('user/aspirasi/data_aspirasi_warga');
	}

	public function bersihkanAspirasi($id = null)
	{
		$this->db->where('id', $id);
		$this->db->update('aspirasi', ['aktif' => 0]);
		redirect('user/aspirasi/');
	}

	public function bersihkanKeluhan($id = null)
	{
		$this->db->where('id', $id);
		$this->db->update('keluhan', ['aktif' => 0]);
		redirect('user/aspirasi/');
	}
	
}
