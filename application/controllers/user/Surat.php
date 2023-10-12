<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->id_warga) {
			redirect('user/auth');
		}
		$this->load->helper('tgl_indo');
		$this->load->model('user/SuratModel', 'SuratModel');
	}

	public function index()
	{
		$hunian = $this->SuratModel->get_hunian()->row();
		$hunianCount = count(get_object_vars($hunian));
		$hunianCheck = [];
		foreach ($hunian as $data_hunian) {
			if ($data_hunian != NULL) {
				array_push($hunianCheck, $data_hunian);
			}
		}
		if ($hunian->foto_profile == NULL && count($hunianCheck) < $hunianCount - 1) {
			$this->session->set_flashdata('profile', 'Lengkapi terlebih dahulu data hunian anda!');
			redirect(base_url('user/warga/info_hunian/' . $hunian->id_detail_warga));
		} else if ($hunian->foto_profile != NULL && count($hunianCheck) <= $hunianCount - 1) {
			$this->session->set_flashdata('profile', 'Lengkapi terlebih dahulu data hunian anda!');
			redirect(base_url('user/warga/info_hunian/' . $hunian->id_detail_warga));
		} else {
			$nama = $this->SuratModel->get_nama_warga()->result();
			$pengajuan = $this->SuratModel->get_pengajuan_surat()->result();
			$data['nama']  = $nama;
			$data['pengajuan']  = $pengajuan;
			$this->load->view('user/layouts/header');
			$this->load->view('user/pages/pengajuan-surat', $data);
			$this->load->view('user/layouts/footer');
		}
	}

	function alpha_dash_space($str)
	{
		if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
			$this->form_validation->set_message(__FUNCTION__, 'Pastikan {field} harus diisi dan tidak mengandung angka');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function tambah_pengajuan()
	{
		$this->form_validation->set_rules('pengajuan', 'keperluan surat', 'required|min_length[10]|callback_alpha_dash_space');
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$id_pengajuan_surat = $this->SuratModel->id_pengajuan_surat();
			$id_detail_warga    = $this->input->post('id_detail_warga');
			$pengajuan    		= $this->input->post('pengajuan', true);
			$tanggal_pengajuan  = date("Y-m-d");

			$data = [
				'id_pengajuan_surat' => $id_pengajuan_surat,
				'id_detail_warga'    => $id_detail_warga,
				'pengajuan'    	 	 => $pengajuan,
				'tanggal_pengajuan'  => $tanggal_pengajuan,
				'verifikasi_rt'  => "Diproses",
				'verifikasi_rw'  => "Diproses",
			];
			$this->SuratModel->tambah_pengajuan_surat($data);
			$this->session->set_flashdata('flash', 'Pengajuan Surat Berhasil Ditambah');
			redirect(base_url('user/surat'));
		}
	}

	public function download_surat($id_pengajuan_surat)
	{
		$data_surat = $this->SuratModel->download_surat($id_pengajuan_surat)->row();
		$data['data']  = $data_surat;
		$this->load->view('user/pages/download-surat', $data);
	}

	public function download_template($id_surat)
	{
		$this->load->helper('download');
		$fileinfo = $this->SuratModel->get_template_surat($id_surat)->row();
		$file = 'uploads/template_surat/' . $fileinfo->file_surat;
		force_download($file, NULL);
	}

	public function template_surat()
	{
		$template_surat = $this->SuratModel->get_all_template()->result();
		$data['template_surat']  = $template_surat;
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/template-surat', $data);
		$this->load->view('user/layouts/footer');
	}

	public function hapus_surat($id_pengajuan_surat)
	{
		$this->SuratModel->hapus_pengajuan_surat($id_pengajuan_surat);
		$this->session->set_flashdata('flash', 'Pengajuan Surat Berhasil Dihapus');
		redirect('user/surat');
	}
}
