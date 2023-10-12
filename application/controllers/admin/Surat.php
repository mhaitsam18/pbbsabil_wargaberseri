<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->email) {
			redirect(base_url('admin'));
		}
		$this->load->helper('get_rt_rw_helper');
		$this->load->helper('tgl_indo');
		$this->load->helper('text');
		$this->load->model('admin/SuratModel', 'SuratModel');
		$this->load->model('admin/WargaModel', 'WargaModel');
	}

	// ----------------------Start Pengajuan Surat----------------------

	public function index()
	{
		$role_id = $this->session->role_id;
		if ($role_id == 6) {
			$pengajuan_surat = $this->SuratModel->get_pengajuan_by_rt(get_rt()[0], get_rt()[1])->result();
		} elseif ($role_id == 7) {
			$pengajuan_surat = $this->SuratModel->get_pengajuan_by_rw(get_rw())->result();
		} else {
			$pengajuan_surat = $this->SuratModel->get_pengajuan()->result();
		}
		$data['pengajuan_surat'] = $pengajuan_surat;
		$data['title'] = 'Pengajuan Surat';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/surat/pengajuan-surat', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function verifikasi_surat_rt()
	{
		$rt 				= $this->input->post('rt');
		$nama_rt 			= $this->session->name;
		$id_pengajuan_surat = $this->input->post('id_pengajuan_surat');
		$data = [
			'rt'            => $rt,
			'nama_rt'       => $nama_rt,
			'verifikasi_rt' => "Disetujui"
		];
		$this->SuratModel->update_verifikasi_surat($id_pengajuan_surat, $data);
		redirect(base_url('admin/surat'));
	}

	public function verifikasi_surat_rw()
	{
		$id_pengajuan_surat = $this->input->post('id_pengajuan_surat');
		$rw 				= $this->input->post('rw');
		$nama_rw 			= $this->session->name;
		$tanggal_disetujui  = date("Y-m-d");

		$data = [
			'tanggal_disetujui' => $tanggal_disetujui,
			'kode_surat'        => "091201212",
			'no_surat'          => "121 / 213 / 5541XII",
			'rw' 		        => $rw,
			'nama_rw'           => $nama_rw,
			'verifikasi_rw'     => "Disetujui"
		];
		$this->SuratModel->update_verifikasi_surat($id_pengajuan_surat, $data);
		redirect(base_url('admin/surat'));
	}

	// ------------------------End Pengajuan Surat------------------------


	public function template_surat()
	{
		$data['title'] = 'Template Surat';
		$template_surat = $this->SuratModel->get_all_template_surat()->result();
		$data['template_surat'] = $template_surat;
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/surat/template-surat', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function view_tambah_template_surat()
	{
		$data['title'] = 'Tambah Penyediaan Surat';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/surat/tambah-template-surat', $data);
		$this->load->view('admin/layouts/footer');
	}



	public function tambah_template_surat()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('keterangan_surat', 'Keterangan Surat', 'required');
		if (empty($_FILES['file_surat']['name'])) {
			$this->form_validation->set_rules('file_surat', 'File Penyediaan Surat', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->view_tambah_template_surat();
			}
		} else {
			$config['upload_path']    = './uploads/template_surat/';
			$config['allowed_types']  = 'pdf|docx|doc';
			$config['max_size']       = 5000;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file_surat')) {
				$this->session->set_flashdata('status', 'File gagal diupload.');
				redirect(base_url('admin/surat/template_surat'));
			} else {
				$id_admin         = $this->session->id;
				$id_template 	  = $this->SuratModel->id_template_surat();
				$judul            = $this->input->post('judul');
				$keterangan_surat = $this->input->post('keterangan_surat');
				$file_surat       = $this->upload->data('file_name');

				$data = array(
					'id_admin' => $id_admin,
					'id_surat' => $id_template,
					'judul'            => $judul,
					'keterangan_surat' => $keterangan_surat,
					'file_surat'       => $file_surat
				);
				$this->SuratModel->tambah_template_surat($data);
				$this->session->set_flashdata('flash', 'File berhasil diupload');
				redirect(base_url('admin/surat/template_surat'));
			}
		}
	}

	public function view_edit_template_surat($id_surat)
	{
		$data['title'] = 'Edit Penyediaan Surat';
		$data['surat'] = $this->SuratModel->get_single_surat($id_surat)->row();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/surat/edit-template-surat', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function sunting_template_surat($id_surat)
	{
		$surat = $this->SuratModel->get_single_surat($id_surat)->row();
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('keterangan_surat', 'Keterangan Surat', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->view_edit_template_surat($id_surat);
		} else {
			$upload_image = $_FILES['file_surat']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'docx|pdf|doc';
				$config['upload_path'] = './uploads/template_surat';
				$config['max_size']     = '4048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('file_surat')) {
					$old_image = $surat->file_surat;
					if ($old_image != NULL) {
						unlink(FCPATH . 'uploads/template_surat/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('file_surat', $new_image);
				} else {
					redirect(base_url('admin/surat/view_edit_template_surat/' . $id_surat));
				}
			}
			$judul = $this->input->post('judul');
			$keterangan_surat = $this->input->post('keterangan_surat');
			$data = [
				'judul' => $judul,
				'keterangan_surat' => $keterangan_surat
			];
			$query = $this->SuratModel->update_template_surat($id_surat, $data);
			if ($query) {
				$this->session->set_flashdata('flash', 'Update');
				redirect(base_url('admin/surat/view_edit_template_surat/' . $id_surat));
			}
		}
	}



	public function download_template_surat($id_surat)
	{
		$this->load->helper('download');
		$fileinfo = $this->SuratModel->get_template_surat($id_surat)->row();
		$file = 'uploads/template_surat/' . $fileinfo->file_surat;
		force_download($file, NULL);
	}

	public function hapus_template_surat($id_template_surat)
	{
		$id_surat = $this->SuratModel->get_single_surat($id_template_surat)->row();
		unlink(FCPATH . 'uploads/template_surat/' . $id_surat->file_surat);
		$this->SuratModel->hapus_template_surat($id_template_surat);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect(base_url('admin/surat/template_surat'));
	}
}
