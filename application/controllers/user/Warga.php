<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('tgl_indo');
		$this->load->model('user/WargaModel', 'WargaModel');
		$this->load->model('user/SuratModel', 'SuratModel');
		$this->load->model('user/KendaraanModel', 'KendaraanModel');
	}
	public function index()
	{
		if ($this->session->id_warga) {
			$id_warga = $this->session->id_warga;
			$detail_warga = $this->WargaModel->get_warga($id_warga)->row();
			$pendataan_warga = $this->WargaModel->get_detail_warga($id_warga)->result();
			$kendaraan = $this->KendaraanModel->get_all_kendaraan($id_warga)->result();
			$jumlah_hunian = $this->WargaModel->get_detail_warga($id_warga)->num_rows();
			$data['info_kendaraan']  = $kendaraan;
			$data['pendataan_warga']  = $pendataan_warga;
			$data['warga']  = $detail_warga;
			$data['jumlah_hunian']  = $jumlah_hunian;
			$this->load->view('user/layouts/header');
			$this->load->view('user/pages/warga/pendataan-warga', $data);
			$this->load->view('user/layouts/footer');
		} else {
			redirect('user/auth');
		}
	}

	public function info_hunian($id_detail_warga)
	{
		if ($this->session->id_warga) {
			$hunian         = $this->WargaModel->get_hunian($id_detail_warga)->row();
			$data['title']  = 'Detail Hunian';
			$data['hunian'] = $hunian;
			$this->load->view('user/layouts/header', $data);
			$this->load->view('user/pages/warga/info-hunian', $data);
			$this->load->view('user/layouts/footer');
		} else {
			redirect('user/auth');
		}
	}

	public function detail_hunian($id_detail_warga)
	{
		if ($this->session->id_warga) {
			$hunian         = $this->WargaModel->get_hunian($id_detail_warga)->row();
			$data['title']  = 'Detail Hunian';
			$data['hunian'] = $hunian;
			$this->load->view('user/layouts/header', $data);
			$this->load->view('user/pages/warga/detail-hunian', $data);
			$this->load->view('user/layouts/footer');
		} else {
			redirect('user/auth');
		}
	}

	public function tambah_hunian()
	{
		if ($this->session->id_warga) {
			$data['title'] = 'Tambah hunian';
			$this->load->view('user/layouts/header', $data);
			$this->load->view('user/pages/warga/tambah-hunian');
			$this->load->view('user/layouts/footer');
		} else {
			redirect('user/auth');
		}
	}

	public function validasi_tambah_hunian()
	{
		$this->form_validation->set_rules('nama_warga', 'Nama Warga', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('agama', 'Agama', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|alpha');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
		$this->form_validation->set_rules('hubungan_keluarga', 'Hubungan Keluarga', 'required');
		$this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'required');
		$this->form_validation->set_rules('status_hunian', 'Status Hunian', 'required');
	}

	public function proses_tambah_anggota_warga()
	{
		// Memanggil function untuk validasi
		$this->form_validation->set_rules('nik', 'NIK', 'required|exact_length[16]|numeric|is_unique[detail_warga.nik]');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required|min_length[10]|numeric');
		$this->validasi_tambah_hunian();

		if (empty($_FILES['file_ktp']['name'])) {
			$this->form_validation->set_rules('file_ktp', 'File Identitas', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->tambah_hunian();
			}
		} else {
			$config['upload_path']          = './uploads/ktp/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 4000;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file_ktp')) {
				$this->session->set_flashdata('statusFile', 'File gagal diupload.');
				$this->index();
			} else {
				$id_warga          = $this->session->id_warga;
				$id_detail_warga   = $this->WargaModel->id_detail_warga();
				$nama_warga        = $this->input->post('nama_warga');
				$nik  			   = $this->input->post('nik', true);
				$no_hp  		   = $this->input->post('no_hp', true);
				$tempat_lahir  	   = $this->input->post('tempat_lahir', true);
				$tanggal_lahir     = $this->input->post('tanggal_lahir', true);
				$agama  		   = $this->input->post('agama', true);
				$jenis_kelamin     = $this->input->post('jenis_kelamin', true);
				$status_perkawinan = $this->input->post('status_perkawinan', true);
				$hubungan_keluarga = $this->input->post('hubungan_keluarga', true);
				$status  		   = "Anggota Keluarga";
				$pekerjaan  	   = $this->input->post('pekerjaan', true);
				$pendidikan  	   = $this->input->post('pendidikan', true);
				$status_hunian     = $this->input->post('status_hunian', true);
				$file_ktp    	   = $this->upload->data('file_name');

				$data = [
					'id_warga'  	    => $id_warga,
					'id_detail_warga'   => $id_detail_warga,
					'nama_warga'   	    => $nama_warga,
					'nik'   		    => $nik,
					'no_hp'   		    => $no_hp,
					'tempat_lahir'      => $tempat_lahir,
					'tanggal_lahir'     => $tanggal_lahir,
					'agama'   			=> $agama,
					'status_perkawinan' => $status_perkawinan,
					'jenis_kelamin'     => $jenis_kelamin,
					'hubungan_keluarga' => $hubungan_keluarga,
					'status'   		    => $status,
					'pekerjaan'   		=> $pekerjaan,
					'pendidikan'        => $pendidikan,
					'status_hunian'     => $status_hunian,
					'status_verifikasi' => 1,
					'file_ktp' 		    => $file_ktp
				];
				$this->WargaModel->tambah_anggota_warga($data);
				$this->session->set_flashdata('flash', 'Data hunian berhasil ditambah!');
				redirect(base_url('user/warga'));
			}
		}
	}

	public function proses_update_anggota_warga()
	{
		// Memanggil function untuk validasi
		$id_detail_warga = $this->input->post('id_detail_warga');
		$original_value = $this->WargaModel->get_hunian($id_detail_warga)->row()->nik;
		if ($this->input->post('nik') != $original_value) {
			$is_unique =  '|is_unique[detail_warga.nik]';
		} else {
			$is_unique =  '';
		}
		$this->form_validation->set_rules('nik', 'NIK', 'required|exact_length[16]|numeric' . $is_unique);
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required|min_length[10]|numeric');
		$this->validasi_tambah_hunian();
		if ($this->form_validation->run() == FALSE) {
			$this->info_hunian($id_detail_warga);
		} else {
			$hunian = $this->WargaModel->get_hunian($id_detail_warga)->row();
			$upload_image = $_FILES['file_ktp']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['upload_path'] = './uploads/ktp';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('file_ktp')) {
					$old_image = $hunian->file_ktp;
					if ($old_image != NULL) {
						unlink(FCPATH . 'uploads/ktp/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('file_ktp', $new_image);
				} else {
					echo ("File gaga");
					redirect(base_url('admin/warga/sunting_warga/' . $id_detail_warga));
				}
			}

			$nama_warga          = $this->input->post('nama_warga');
			$nik  			     = $this->input->post('nik', true);
			$no_hp  		     = $this->input->post('no_hp', true);
			$tempat_lahir  	     = $this->input->post('tempat_lahir', true);
			$tanggal_lahir       = $this->input->post('tanggal_lahir', true);
			$agama  		     = $this->input->post('agama', true);
			$jenis_kelamin       = $this->input->post('jenis_kelamin', true);
			$status_perkawinan   = $this->input->post('status_perkawinan', true);
			$hubungan_keluarga   = $this->input->post('hubungan_keluarga', true);
			$status  		     = $this->input->post('status', true);
			$pekerjaan  	     = $this->input->post('pekerjaan', true);
			$pendidikan  	     = $this->input->post('pendidikan', true);
			$status_hunian       = $this->input->post('status_hunian', true);
			$data = [
				'nama_warga'   	       => $nama_warga,
				'nik'   		       => $nik,
				'no_hp'   		       => $no_hp,
				'tempat_lahir'         => $tempat_lahir,
				'tanggal_lahir'        => $tanggal_lahir,
				'agama'   			   => $agama,
				'status_perkawinan'    => $status_perkawinan,
				'jenis_kelamin'        => $jenis_kelamin,
				'hubungan_keluarga'    => $hubungan_keluarga,
				'status'   		       => $status,
				'pekerjaan'   		   => $pekerjaan,
				'pendidikan'           => $pendidikan,
				'status_hunian'        => $status_hunian,
			];
			$this->WargaModel->update_anggota_warga($id_detail_warga, $data);
			$this->session->set_flashdata('flash', 'Update');
			redirect(base_url('user/warga/info_hunian/' . $id_detail_warga));
		}
	}

	public function update_profile()
	{
		$upload_profile  = "profile_" . time();
		$id_detail_warga = $this->input->post('id_detail_warga');
		if ($upload_profile) {
			$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
			$config['upload_path']   = './uploads/profile';
			$config['max_size']      = '2048';
			$config['file_name']     = $upload_profile;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('foto_profile')) {
				$old_profile      = $this->input->post('old_profile');
				if ($old_profile != '' || $old_profile != NULL) {
					unlink(FCPATH . 'uploads/profile/' . $old_profile);
				}
				$new_profile = $this->upload->data('file_name');
				$data = [
					'foto_profile'   	    => $new_profile
				];
				$this->WargaModel->update_anggota_warga($id_detail_warga, $data);
				$this->session->set_flashdata('flash', 'Update');
				redirect(base_url('user/warga/info_hunian/' . $id_detail_warga));
			} else {
				$this->session->set_flashdata('upload', 'Gagal');
				redirect(base_url('user/warga/info_hunian/' . $id_detail_warga));
			}
		}
	}

	public function hapus_profile($id_detail_warga)
	{
		$old_profile = $this->uri->segment(5);
		unlink(FCPATH . 'uploads/profile/' . $old_profile);
		$data = [
			'foto_profile'   	    => NULL
		];
		$this->WargaModel->update_anggota_warga($id_detail_warga, $data);
		$this->session->set_flashdata('flash', 'Update');
		redirect(base_url('user/warga/info_hunian/' . $id_detail_warga));
	}

	public function hapus_hunian($id_detail_warga)
	{
		$this->WargaModel->hapus_hunian($id_detail_warga);
		$this->session->set_flashdata('flash', 'Data hunian berhasil dihapus!');
		redirect(base_url('user/warga'));
	}

	// ----------------------End Data Hunian Warga------------------------

	public function update_kk()
	{
		$upload_kk  = "kk_" . time();
		$id_warga = $this->input->post('id_warga');
		if ($upload_kk) {
			$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
			$config['upload_path']   = './uploads/kk';
			$config['max_size']      = '4048';
			$config['file_name']     = $upload_kk;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file_kk')) {
				$old_kk      = $this->input->post('old_kk');
				if ($old_kk != '' || $old_kk != NULL) {
					unlink(FCPATH . 'uploads/kk/' . $old_kk);
				}
				$new_kk = $this->upload->data('file_name');
				$data = [
					'file_kk'   	    => $new_kk
				];
				$this->WargaModel->update_warga($id_warga, $data);
				$this->session->set_flashdata('flash', 'Update');
				redirect(base_url('user/warga/info_warga/' . $id_warga));
			} else {
				redirect(base_url('user/warga/info_warga/' . $id_warga));
			}
		}
	}

	public function validasi_tambah_warga()
	{
		$this->form_validation->set_rules('no_rumah', 'No Rumah', 'required|min_length[2]|alpha_dash');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
		$this->form_validation->set_rules('jumlah_keluarga', 'Jumlah Keluarga', 'required|numeric');
		$this->form_validation->set_rules('rt', 'RT', 'required|numeric');
		$this->form_validation->set_rules('rw', 'RW', 'required|numeric');
		$this->form_validation->set_rules('status_rumah', 'Status Rumah', 'required');
	}

	public function info_warga($id_warga)
	{
		if ($this->session->id_warga) {
			$warga         = $this->WargaModel->get_warga($id_warga)->row();
			$data['title'] = 'Detail Warga';
			$data['warga'] = $warga;
			$this->load->view('user/layouts/header', $data);
			$this->load->view('user/pages/warga/info-warga', $data);
			$this->load->view('user/layouts/footer');
		} else {
			redirect('user/auth');
		}
	}

	public function proses_update_warga()
	{
		$id_warga = $this->session->id_warga;
		$original_value = $this->WargaModel->get_warga($id_warga)->row()->no_kk;
		if ($this->input->post('no_kk') != $original_value) {
			$is_unique =  '|is_unique[warga.no_kk]';
		} else {
			$is_unique =  '';
		}
		// Memanggil function untuk validasi
		$this->validasi_tambah_warga();
		$this->form_validation->set_rules('no_kk', 'No Kartu Keluarga', 'required|exact_length[16]|numeric' . $is_unique);
		if ($this->form_validation->run() == FALSE) {
			$this->info_warga($id_warga);
		} else {
			$no_rumah   		     = strtoupper($this->input->post('no_rumah'));
			$no_kk   		         = $this->input->post('no_kk');
			$alamat   		         = $this->input->post('alamat');
			$jumlah_keluarga         = $this->input->post('jumlah_keluarga');
			$status_rumah            = $this->input->post('status_rumah');
			$rt   				     = $this->input->post('rt');
			$rw   				     = $this->input->post('rw');
			$status_rt 	 		 	 = $this->input->post('status_rumah_tangga');

			if ($status_rt == NULL) {
				$status_rumah_tangga = 	"Tidak Mendapat Bantuan";
			} else {
				$status_rumah_tangga 	 = implode(", ", $status_rt);
				if ($status_rumah_tangga == "KIS") {
					$status_rumah_tangga = "Rentan Miskin";
				} else if ($status_rumah_tangga == "KIS, RASKIN") {
					$status_rumah_tangga = "Hampir Miskin";
				} else if ($status_rumah_tangga == "KIS, RASKIN, KIP") {
					$status_rumah_tangga = "Miskin";
				} else if ($status_rumah_tangga == "KIS, RASKIN, KIP, PKH") {
					$status_rumah_tangga = "Sangat Miskin";
				}
			}
			$data_warga = [
				'no_rumah'   		  => $no_rumah,
				'no_kk'   			  => $no_kk,
				'alamat'   			  => $alamat,
				'jumlah_keluarga'	  => $jumlah_keluarga,
				'status_rumah' 		  => $status_rumah,
				'status_rumah_tangga' => $status_rumah_tangga,
				'rt'   				  => $rt,
				'rw'   			      => $rw,
			];
			$this->WargaModel->update_warga($id_warga, $data_warga);
			$this->session->set_flashdata('flash', 'Update');
			redirect(base_url('user/warga/info_warga/' . $id_warga));
		}
	}
}
