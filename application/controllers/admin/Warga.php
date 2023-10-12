<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->email) {
			redirect(base_url('admin'));
		}
		$this->load->helper('tgl_indo');
		$this->load->helper('get_rt_rw_helper');
		$this->load->model('admin/WargaModel', 'WargaModel');
	}

	// ----------------------Start Info Warga----------------------

	public function info_warga()
	{
		$role_id = $this->session->userdata('role_id');
		if ($role_id == 6) {
			$query = $this->WargaModel->get_all_info_warga_by_rt(get_rt()[0], get_rt()[1])->result();
		} elseif ($role_id == 7) {
			$query = $this->WargaModel->get_all_info_warga_by_rw(get_rw())->result();
		} else {
			$query = $this->WargaModel->get_all_info_warga()->result();
		}
		$data['pendataan_warga'] = $query;
		$data['title'] = 'Info Warga';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/warga/info-warga', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function sunting_warga($id_warga)
	{

		$query = $this->WargaModel->get_single_warga($id_warga)->row();
		$data['warga'] = $query;
		$data['title'] = 'Sunting Warga';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/warga/sunting-warga', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function verifikasi_warga_info($id_detail_warga)
	{
		$data = [
			'status_verifikasi' => 2
		];
		$this->WargaModel->update_anggota_warga($id_detail_warga, $data);
		redirect(base_url('admin/warga/info_warga'));
	}

	// ----------------------End Info Warga------------------------

	// ----------------------Start Data Warga----------------------

	public function data_warga()
	{
		$role_id = $this->session->userdata('role_id');
		if ($role_id == 6) {
			$query = $this->WargaModel->get_all_warga_by_rt(get_rt()[0], get_rt()[1])->result();
		} elseif ($role_id == 7) {
			$query = $this->WargaModel->get_all_warga_by_rw(get_rw())->result();
		} else {
			$query = $this->WargaModel->get_all_warga()->result();
		}
		$data['pendataan_warga'] = $query;
		$data['title'] = 'Data Warga';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/warga/data-warga', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function tambah_warga()
	{
		$data['title'] = 'Tambah Data Warga';
		$data['user']  = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/warga/tambah-warga');
		$this->load->view('admin/layouts/footer');
	}

	public function validasi_tambah_warga()
	{
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
		$this->form_validation->set_rules('jumlah_keluarga', 'Jumlah Keluarga', 'required|numeric');
		$this->form_validation->set_rules('rt', 'RT', 'required|numeric');
		$this->form_validation->set_rules('rw', 'RW', 'required|numeric');
		$this->form_validation->set_rules('status_rumah', 'Status Rumah', 'required');
	}

	public function proses_tambah_warga()
	{
		$this->form_validation->set_rules('no_rumah', 'No Rumah', 'required|min_length[2]|alpha_dash|is_unique[warga.no_rumah]');
		$this->form_validation->set_rules('no_kk', 'No Kartu Keluarga', 'required|exact_length[16]|numeric|is_unique[warga.no_kk]');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required|min_length[10]|numeric');
		$this->form_validation->set_rules('nama_warga', 'Nama Pemilik Rumah', 'required');
		$this->validasi_tambah_warga();

		if (empty($_FILES['file_kk']['name'])) {
			$this->form_validation->set_rules('file_kk', 'File Kartu Keluarga', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->tambah_warga();
		} else {
			$id_warga   	         = $this->WargaModel->id_warga();
			$id_detail_warga   	     = $this->WargaModel->id_detail_warga();
			$nama_warga   		     = $this->input->post('nama_warga');
			$no_hp   		         = $this->input->post('no_hp');
			$no_rumah   		     = strtoupper($this->input->post('no_rumah'));
			$no_kk   		         = $this->input->post('no_kk');
			$alamat   		         = $this->input->post('alamat');
			$jumlah_keluarga         = $this->input->post('jumlah_keluarga');
			$status_rumah            = $this->input->post('status_rumah');
			$rt   				     = $this->input->post('rt');
			$rw   				     = $this->input->post('rw');
			$status_rt 	 		     = $this->input->post('status_rumah_tangga');
			if ($status_rt  == NULL) {
				$status_rumah_tangga = "Tidak Mendapat Bantuan";
			} else {
				$status_rumah_tangga = implode(", ", $status_rt);
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

			$config['upload_path']   = './uploads/kk/';
			$config['allowed_types'] = 'pdf|jpeg|jpg|png';
			$config['max_size']      = 4000;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file_kk')) {
				$this->session->set_flashdata('status', 'File gagal diupload.');
				$this->tambah_warga();
			} else {
				$file_kk = $this->upload->data('file_name');
				$data_warga = [
					'id_warga'  		  => $id_warga,
					'no_rumah'   		  => $no_rumah,
					'no_kk'   			  => $no_kk,
					'alamat'   			  => $alamat,
					'jumlah_keluarga'	  => $jumlah_keluarga,
					'status_rumah' 		  => $status_rumah,
					'rt'   				  => $rt,
					'rw'   			      => $rw,
					'status_rumah_tangga' => $status_rumah_tangga,
					'file_kk'			  => $file_kk,
				];
				$data_hunian = [
					'id_warga'  	    => $id_warga,
					'id_detail_warga'   => $id_detail_warga,
					'nama_warga'   	    => $nama_warga,
					'no_hp'      	    => $no_hp,
					'status'   	        => 'Kepala Keluarga',
					'status_verifikasi' => 2,
				];
				$this->WargaModel->tambah_warga($data_warga);
				$this->WargaModel->tambah_anggota_warga($data_hunian);
				$this->session->set_flashdata('flash', 'Ditambah');
				redirect(base_url('admin/warga/data_warga'));
			}
		}
	}

	public function proses_update_warga()
	{
		$id_warga = $this->input->post('id_warga');
		$warga    = $this->WargaModel->get_single_warga($id_warga)->row();

		if ($this->input->post('no_kk') != $warga->no_kk) {
			$is_unique =  '|is_unique[warga.no_kk]';
		} else {
			$is_unique =  '';
		}
		$this->form_validation->set_rules('no_rumah', 'No Rumah', 'required|min_length[2]|alpha_dash');
		$this->form_validation->set_rules('no_kk', 'No Kartu Keluarga', 'required|exact_length[16]|numeric' . $is_unique);
		$this->validasi_tambah_warga();
		if ($this->form_validation->run() == FALSE) {
			$this->sunting_warga($id_warga);
			// echo validation_errors();
		} else {
			$upload_image = $_FILES['file_kk']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['upload_path'] = './uploads/kk';
				$config['max_size']     = '2048';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('file_kk')) {
					$old_image = $warga->file_kk;
					if ($old_image != NULL) {
						unlink(FCPATH . 'uploads/kk/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('file_kk', $new_image);
				} else {
					redirect(base_url('admin/warga/sunting_warga/' . $id_warga));
				}
			}

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
			$query = $this->WargaModel->update_warga($id_warga, $data_warga);
			if ($query) {
				$this->session->set_flashdata('flash', 'Update');
				redirect(base_url('admin/warga/sunting_warga/' . $id_warga));
			}
		}
	}

	public function hapus_warga($id_warga)
	{
		$this->WargaModel->hapus_warga($id_warga);
		$this->session->set_flashdata('flash', 'Hapus');
		redirect(base_url('admin/warga/data_warga'));
	}

	// ----------------------End Data Warga------------------------

	// ----------------------Start Data Hunian Warga----------------------

	public function detail_warga($id_warga)
	{
		$info_hunian = $this->WargaModel->get_single_penduduk($id_warga)->result();
		$jumlah_hunian = $this->WargaModel->get_single_penduduk($id_warga)->num_rows();
		$warga = $this->WargaModel->get_single_warga($id_warga)->row();
		$data['title'] = 'Detail Warga';
		$data['pendataan_warga'] = $info_hunian;
		$data['id_warga'] = $id_warga;
		$data['warga'] = $warga;
		$data['jumlah_hunian'] = $jumlah_hunian;
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/warga/detail-warga', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function detail_hunian($id_detail_warga)
	{
		$hunian         = $this->WargaModel->get_hunian($id_detail_warga)->row();
		$data['title']  = 'Detail Warga';
		$data['hunian'] = $hunian;
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/warga/detail-hunian', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function tambah_hunian($id_warga)
	{
		$data['title'] = 'Tambah Data Warga';
		$data['id_warga'] = $id_warga;
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/warga/tambah-hunian', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function verifikasi_warga()
	{
		$id_warga   	 = $this->input->post('id_warga');
		$id_detail_warga = $this->input->post('id_detail_warga');
		$no_rumah		 = $this->input->post('no_rumah');
		$data = [
			'status_verifikasi' => 2
		];
		$this->WargaModel->update_anggota_warga($id_detail_warga, $data);
		redirect(base_url('admin/warga/detail_warga/' . $id_warga  . '/' . $no_rumah));
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
		$id_warga = $this->input->post('id_warga');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required|min_length[10]|numeric|is_unique[detail_warga.no_hp]');
		$this->form_validation->set_rules('nik', 'NIK', 'required|exact_length[16]|numeric|is_unique[detail_warga.nik]');
		$this->validasi_tambah_hunian();

		if (empty($_FILES['file_ktp']['name'])) {
			$this->form_validation->set_rules('file_ktp', 'File Identitas', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->tambah_hunian($id_warga);
			}
		} else {
			$config['upload_path']          = './uploads/ktp';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 4000;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file_ktp')) {
				$this->session->set_flashdata('status', 'File gagal diupload.');
				$this->tambah_hunian($id_warga);
			} else {
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
				$status  		   = $this->input->post('status', true);
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
					'status'   		    => 'Anggota Keluarga',
					'pekerjaan'   		=> $pekerjaan,
					'pendidikan'        => $pendidikan,
					'status_hunian'     => $status_hunian,
					'status_verifikasi' => 2,
					'file_ktp' 		    => $file_ktp
				];
				$this->WargaModel->tambah_anggota_warga($data);
				$this->session->set_flashdata('flash', 'Ditambah');
				redirect(base_url('admin/warga/detail_warga/' . $id_warga));
			}
		}
	}

	public function proses_update_anggota_warga()
	{
		// Memanggil function untuk validasi
		$id_detail_warga   = $this->input->post('id_detail_warga');
		$original_value = $this->WargaModel->get_hunian($id_detail_warga)->row()->nik;
		if ($this->input->post('nik') != $original_value) {
			$is_unique =  '|is_unique[detail_warga.nik]';
		} else {
			$is_unique =  '';
		}
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required|min_length[10]|numeric');
		$this->form_validation->set_rules('nik', 'NIK', 'required|exact_length[16]|numeric' . $is_unique);
		$this->validasi_tambah_hunian();
		if ($this->form_validation->run() == FALSE) {
			$this->detail_hunian($id_detail_warga);
		} else {
			$nama_warga        = $this->input->post('nama_warga');
			$nik  			   = $this->input->post('nik', true);
			$no_hp  		   = $this->input->post('no_hp', true);
			$tempat_lahir  	   = $this->input->post('tempat_lahir', true);
			$tanggal_lahir     = $this->input->post('tanggal_lahir', true);
			$agama  		   = $this->input->post('agama', true);
			$jenis_kelamin     = $this->input->post('jenis_kelamin', true);
			$status_perkawinan = $this->input->post('status_perkawinan', true);
			$hubungan_keluarga = $this->input->post('hubungan_keluarga', true);
			$status  		   = $this->input->post('status', true);
			$pekerjaan  	   = $this->input->post('pekerjaan', true);
			$pendidikan  	   = $this->input->post('pendidikan', true);
			$status_hunian     = $this->input->post('status_hunian', true);

			$data = [
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
			];
			$this->WargaModel->update_anggota_warga($id_detail_warga, $data);
			$this->session->set_flashdata('flash', 'Update');
			redirect(base_url('admin/warga/detail_hunian/' . $id_detail_warga));
		}
	}

	public function update_profile()
	{
		$upload_profile  = $_FILES['foto_profile']['name'];
		$id_detail_warga = $this->input->post('id_detail_warga');
		if ($upload_profile) {
			$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
			$config['upload_path']   = './uploads/profile';
			$config['max_size']      = '2048';
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
				redirect(base_url('admin/warga/detail_hunian/' . $id_detail_warga));
			} else {
				$this->session->set_flashdata('flash', 'Gagal');
				redirect(base_url('admin/warga/detail_hunian/' . $id_detail_warga));
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
		redirect(base_url('admin/warga/detail_hunian/' . $id_detail_warga));
	}

	public function update_ktp()
	{
		$upload_ktp      = $_FILES['file_ktp']['name'];
		$id_detail_warga = $this->input->post('id_detail_warga');
		if ($upload_ktp) {
			$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
			$config['upload_path']   = './uploads/ktp';
			$config['max_size']      = '2048';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file_ktp')) {
				$old_ktp      = $this->input->post('old_ktp');
				if ($old_ktp != '' || $old_ktp != NULL) {
					unlink(FCPATH . 'uploads/ktp/' . $old_ktp);
				}
				$new_ktp = $this->upload->data('file_name');
				$data    = [
					'file_ktp'   	    => $new_ktp
				];
				$this->WargaModel->update_anggota_warga($id_detail_warga, $data);
				$this->session->set_flashdata('flash', 'Update');
				redirect(base_url('admin/warga/detail_hunian/' . $id_detail_warga));
			} else {
				$this->session->set_flashdata('flash', 'Gagal');
				redirect(base_url('admin/warga/detail_hunian/' . $id_detail_warga));
			}
		}
	}

	public function hapus_ktp($id_detail_warga)
	{
		$old_ktp = $this->uri->segment(5);
		unlink(FCPATH . 'uploads/ktp/' . $old_ktp);
		$data = [
			'file_ktp'   	    => NULL
		];
		$this->WargaModel->update_anggota_warga($id_detail_warga, $data);
		$this->session->set_flashdata('flash', 'Update');
		redirect(base_url('admin/warga/detail_hunian/' . $id_detail_warga));
	}

	public function hapus_hunian($id_hunian)
	{
		$id_warga = $this->uri->segment(5);
		$this->WargaModel->hapus_hunian($id_hunian);
		$this->session->set_flashdata('flash', 'Dihapus');
		return redirect(base_url('admin/warga/detail_warga/' . $id_warga));
	}

	// ----------------------End Data Hunian Warga------------------------
}
