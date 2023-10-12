<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kendaraan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/KendaraanModel', 'KendaraanModel');
	}

	public function tambah_kendaraan()
	{
		$data['title'] = 'Tambah Kendaraan';
		$this->load->view('user/layouts/header', $data);
		$this->load->view('user/pages/tambah-kendaraan');
		$this->load->view('user/layouts/footer');
	}

	public function validasi_kendaraan()
	{
		$this->form_validation->set_rules('tipe_kendaraan', 'Tipe Kendaraan', 'required');
		$this->form_validation->set_rules('merk_kendaraan', 'Merk Kendaraan', 'required');
		$this->form_validation->set_rules('nama_stnk', 'Nama Pemilik STNK', 'required');
		$this->form_validation->set_rules('nopol_1', 'Nomor Polisi', 'required');
		$this->form_validation->set_rules('nopol_2', 'Nomor Polisi', 'required|max_length[4]');
		$this->form_validation->set_rules('nopol_3', 'Nomor Polisi', 'required');
	}

	public function proses_tambah_kendaraan()
	{
		$id_warga = $this->session->id_warga;
		$this->validasi_kendaraan();
		if (empty($_FILES['foto_kendaraan']['name'])) {
			$this->form_validation->set_rules('foto_kendaraan', 'Foto Kendaraan', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->tambah_kendaraan();
		} else {
			$config['upload_path']          = './uploads/kendaraan/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 4000;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('foto_kendaraan')) {
				$this->tambah_kendaraan();
			} else {
				$foto_kendaraan  = $this->upload->data('file_name');
				$id_kendaraan 	 = $this->KendaraanModel->id_kendaraan();
				$tipe_kendaraan  = $this->input->post('tipe_kendaraan');
				$merk_kendaraan  = $this->input->post('merk_kendaraan');
				$nama_stnk       = $this->input->post('nama_stnk');
				$nopol_1  	 	 = strtoupper($this->input->post('nopol_1'));
				$nopol_2  	 	 = $this->input->post('nopol_2');
				$nopol_3 	 	 = strtoupper($this->input->post('nopol_3'));
				$no_polisi  	 = $nopol_1 . ' ' . $nopol_2 . ' ' . $nopol_3;
				$data_kendaraan = [
					'id_kendaraan'   => $id_kendaraan,
					'id_warga'       => $id_warga,
					'tipe_kendaraan' => $tipe_kendaraan,
					'merk_kendaraan' => $merk_kendaraan,
					'nama_stnk'      => $nama_stnk,
					'no_polisi'      => $no_polisi,
					'foto_kendaraan' => $foto_kendaraan,
				];
				$this->KendaraanModel->tambah_kendaraan($data_kendaraan);
				$this->session->set_flashdata('flash', 'Ditambah');
				redirect(base_url('user/warga'));
			}
		}
	}

	public function edit_kendaraan($id_kendaraan)
	{
		$data['title'] = 'Sunting Kendaraan';
		$data['kendaraan'] = $this->KendaraanModel->get_kendaraan($id_kendaraan)->row();
		$this->load->view('user/layouts/header', $data);
		$this->load->view('user/pages/edit-kendaraan');
		$this->load->view('user/layouts/footer');
	}

	public function proses_sunting_kendaraan($id_kendaraan)
	{
		// Memanggil function untuk validasi
		$this->validasi_kendaraan();
		if ($this->form_validation->run() == FALSE) {
			$this->edit_kendaraan($id_kendaraan);
		} else {
			$kendaraan = $this->KendaraanModel->get_kendaraan($id_kendaraan)->row();
			$upload_image = $_FILES['foto_kendaraan']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['upload_path'] = './uploads/kendaraan';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto_kendaraan')) {
					$old_image = $kendaraan->foto_kendaraan;
					if ($old_image != NULL) {
						unlink(FCPATH . 'uploads/kendaraan/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('foto_kendaraan', $new_image);
				} else {
					redirect(base_url('user/kendaraan/edit_kendaraan/' . $id_kendaraan));
				}
			}
			$tipe_kendaraan  = $this->input->post('tipe_kendaraan');
			$merk_kendaraan  = $this->input->post('merk_kendaraan');
			$nama_stnk       = $this->input->post('nama_stnk');
			$nopol_1  	 	 = strtoupper($this->input->post('nopol_1'));
			$nopol_2  	 	 = $this->input->post('nopol_2');
			$nopol_3 	 	 = strtoupper($this->input->post('nopol_3'));
			$no_polisi  	 = $nopol_1 . ' ' . $nopol_2 . ' ' . $nopol_3;
			$data_kendaraan = [
				'tipe_kendaraan' => $tipe_kendaraan,
				'merk_kendaraan' => $merk_kendaraan,
				'nama_stnk'      => $nama_stnk,
				'no_polisi'      => $no_polisi,
			];
			$this->KendaraanModel->update_kendaraan($id_kendaraan, $data_kendaraan);
			$this->session->set_flashdata('flashKendaraan', 'Data kendaraan berhasil diperbarui!');
			redirect(base_url('user/kendaraan/edit_kendaraan/' . $id_kendaraan));
		}
	}

	public function hapus_kendaraan($id_kendaraan)
	{
		$this->KendaraanModel->hapus_kendaraan($id_kendaraan);
		$this->session->set_flashdata('flash', 'Data kendaraan berhasil dihapus!');
		redirect(base_url('user/warga'));
	}
}
