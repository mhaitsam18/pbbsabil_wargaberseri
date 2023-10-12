<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/WargaModel', 'WargaModel');
		$this->load->model('admin/KendaraanModel', 'KendaraanModel');
		$this->load->model('admin/SuratModel', 'SuratModel');
		$this->load->model('admin/AspirasiModel', 'AspirasiModel');
		$this->load->model('admin/FasilitasModel', 'Fasilitas_Model');
	}
	public function index()
	{

		if ($this->session->email) {
			$role = $this->session->userdata('role_id');
			$data['aspirasi'] = $this->AspirasiModel->getBelumTertangani()->result();
			if ($role == 1 || $role == 6 || $role == 7) {
				$chart_pendidikan = $this->WargaModel->get_chart_pendidikan()->result();
				$data['chart_pendidikan'] = $chart_pendidikan;
				$chart_hunian = $this->WargaModel->get_chart_hunian()->result();
				$data['chart_hunian'] = $chart_hunian;
				$chart_kendaraan = $this->KendaraanModel->get_chart_kendaraan()->result();
				$data['chart_kendaraan'] = $chart_kendaraan;
				$chart_desil = $this->WargaModel->get_chart_desil()->result();
				$data['chart_desil'] = $chart_desil;

				$total_warga = $this->WargaModel->get_all_warga()->num_rows();
				$data['total_warga'] = $total_warga;

				$total_hunian = $this->WargaModel->get_all_penduduk()->num_rows();
				$data['total_hunian'] = $total_hunian;

				$total_kendaraan = $this->KendaraanModel->get_kendaraan()->num_rows();
				$data['total_kendaraan'] = $total_kendaraan;

				$total_pengajuan = $this->SuratModel->get_all_pengajuan()->num_rows();
				$data['total_pengajuan'] = $total_pengajuan;
				$data['title'] = 'Dashboard';

				$this->load->view('admin/layouts/header', $data);
				$this->load->view('admin/pages/dashboard/index', $data);
				$this->load->view('admin/layouts/footer');
			} else {
				redirect(base_url('admin/user'));
			}
		} else {
			redirect(base_url('admin/auth'));
		}
	}

	public function fasilitas()
	{
		$query = $this->Fasilitas_Model->get_fasilitas()->result();
		$data['data_fasilitas'] = $query;
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Data Fasilitas';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/dashboard/V_fasilitas', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function create()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Tambah Data';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/dashboard/V_tambahdata', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function insert()
	{
		$nama_lokasi = $this->input->post('nama_lokasi');
		$fasilitas_lokasi = $this->input->post('fasilitas_lokasi');
		$alamat_lokasi = $this->input->post('alamat_lokasi');
		$foto_lokasi = $this->input->post('foto_lokasi');

		//get lat long
		$prepAddr = rawurlencode($alamat_lokasi);
		$geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false&key=AIzaSyDcdCIn09zTQi2T21FOiGgTFNkZUoz2hqU');
		$output = json_decode($geocode);
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;

		$config['upload_path'] = './uploads/foto_lokasi/';
		$config['allowed_types'] = 'jpeg|png|jpg';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto_lokasi')) {
			$error = array('error' => $this->upload->display_errors());
			redirect(base_url('admin/dashboard/get'));
		} else {
			$data = $this->upload->data();
			$foto_lokasi = base_url('uploads/foto_lokasi/') . $data['file_name'];
			$data = array(
				'nama_lokasi' => $nama_lokasi,
				'fasilitas_lokasi' => $fasilitas_lokasi,
				'alamat_lokasi' => $alamat_lokasi,
				'foto_lokasi' => $foto_lokasi,
				'lat' => $latitude,
				'long' => $longitude,
			);
			$this->Fasilitas_Model->insert_fasilitas($data);
			redirect(base_url('admin/dashboard/get'));
		}
	}

	public function get()
	{
		$q = $this->Fasilitas_Model->get_fasilitas()->result();
		$data['data_fasilitas'] = $q;
		$data['title'] = 'Data Fasilitas';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/dashboard/V_fasilitas', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function delete($id)
	{
		$q = $this->Fasilitas_Model->delete_fasilitas($id);

		if ($q) {
			return redirect(base_url('admin/dashboard/get'));
		}
		echo "Gagal";
	}

	public function edit($id)
	{
		$q = $this->Fasilitas_Model->get_fasilitas_single($id)->row();
		$data['data_fasilitas'] = $q;
		$data['title'] = 'Edit Data';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/dashboard/V_editdata', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function update($id)
	{
		$nama_lokasi = $this->input->post('nama_lokasi');
		$fasilitas_lokasi = $this->input->post('fasilitas_lokasi');
		$alamat_lokasi = $this->input->post('alamat_lokasi');
		$foto_lokasi = $this->input->post('foto_lokasi');

		$config['upload_path'] = './uploads/foto_lokasi/';
		$config['allowed_types'] = 'jpeg|png|jpg';
		$config['max_size'] = '99999999999';
		$config['max_width'] = '99999999999';
		$config['max_height'] = '99999999999';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto_lokasi')) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$foto = $this->upload->data();
			$foto_lokasi = base_url('uploads/foto_lokasi/') . $foto['file_name'];
			$data = array(
				'nama_lokasi' => $nama_lokasi,
				'fasilitas_lokasi' => $fasilitas_lokasi,
				'alamat_lokasi' => $alamat_lokasi,
				'foto_lokasi' => $foto_lokasi
			);
			$q = $this->Fasilitas_Model->update_fasilitas($id, $data);
			if ($q) {
				return redirect(base_url('admin/Dashboard/get'));
			}
			echo "Gagal";
		}
	}

	public function detail($id)
	{
		$q = $this->Fasilitas_Model->get_fasilitas_single($id)->result();
		$data['data_fasilitas'] = $q;
		$data['title'] = 'Lihat Data';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/dashboard/V_detaildata', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function data_warga($rw = null, $rt =null)
	{
		$data['title'] = 'Data Warga';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			
		$this->db->distinct();
		$this->db->select('rw');
		$data['rw'] = $this->db->get('warga')->result();

		$this->db->join('warga', 'warga.id_warga=detail_warga.id_warga');
		$data['detail_warga'] = $this->db->get('detail_warga');

		if ($rw) {
			$this->db->distinct();
			$this->db->select('rt');
			$data['rt'] = $this->db->get_where('warga', ['rw' => $rw])->result();
			$this->db->join('warga', 'warga.id_warga=detail_warga.id_warga');
			$data['detail_warga'] = $this->db->get_where('detail_warga', ['rw' => $rw]);
		}

		if ($rt) {
			$this->db->join('warga', 'warga.id_warga=detail_warga.id_warga');
			$data['detail_warga'] = $this->db->get_where('detail_warga', ['rw' => $rw, 'rt' => $rt]);
		}

		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/dashboard/data-warga', $data);
		$this->load->view('admin/layouts/footer');
	}
}
