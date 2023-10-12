<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/KeluhanAspirasi_Model', 'KeluhanAspirasi_Model');
		$this->load->model('user/BeritaPengumuman_Model', 'BeritaPengumuman_Model');
		$this->load->model('user/FasilitasModel', 'FasilitasModel');
		$this->load->library('pagination');
	}
	public function index()
	{
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data['pengumuman_terkini'] = $this->db->get('pengumuman')->row_array();
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data['berita_terkini'] = $this->db->get('berita')->row_array();
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data['peraturan_terkini'] = $this->db->get('peraturan')->row_array();
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$data['notulensi_terkini'] = $this->db->get('notulensi')->row_array();
		$data['musrembang'] = $this->db->get('musrembang')->result_array();
		$data['fasilitas'] = $this->db->get('data_fasilitas')->result_array();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/index', $data);
		$this->load->view('user/layouts/footer');
	}


	public function strukturOrganisasi()
	{
		$data['struktur'] = $this->db->get('struktur')->result_array();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/struktur-organisasi', $data);
		$this->load->view('user/layouts/footer');
	}

	public function strukturOrganisasiKeamanan()
	{
		$data['petugas_keamanan'] = $this->db->get('petugas_keamanan')->result_array();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/struktur-organisasi-keamanan', $data);
		$this->load->view('user/layouts/footer_keamanan');
	}

	public function strukturOrganisasiRW()
	{
		$data['petugas_rw'] = $this->db->get('petugas_rw')->result_array();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/struktur-organisasi-rw', $data);
		$this->load->view('user/layouts/footer_rw');
	}

	public function berita()
	{
		$data['all_berita'] = $this->db->get('berita')->result_array();
		$config['base_url'] = 'http://localhost/warga_berseri/user/dashboard/berita';
		$config['total_rows'] = $this->BeritaPengumuman_Model->countAllBerita();
		$config['per_page'] = 3;
		$config['num_links'] = 2;

		//styling
		$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</nav></ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		if ($config['total_rows'] > 18) {
			$config['next_link'] = '&raquo';
		} else {
			$config['next_link'] = 'Next';
		}
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		if ($config['total_rows'] > 18) {
			$config['prev_link'] = '&laquo';
		} else {
			$config['prev_link'] = 'Next';
		}
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);


		$data['start'] = $this->uri->segment(4);
		$data['berita'] = $this->BeritaPengumuman_Model->getBerita($config['per_page'], $data['start']);
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/berita', $data);
		$this->load->view('user/layouts/footer');
	}

	public function peraturan()
	{
		$data['all_peraturan'] = $this->db->get('peraturan')->result_array();
		$config['base_url'] = 'http://localhost/warga_berseri/user/dashboard/peraturan';
		$config['total_rows'] = $this->BeritaPengumuman_Model->countAllPeraturan();
		$config['per_page'] = 3;
		$config['num_links'] = 2;

		//styling
		$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</nav></ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		if ($config['total_rows'] > 18) {
			$config['next_link'] = '&raquo';
		} else {
			$config['next_link'] = 'Next';
		}
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		if ($config['total_rows'] > 18) {
			$config['prev_link'] = '&laquo';
		} else {
			$config['prev_link'] = 'Next';
		}
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		// $config['display_pages'] = TRUE;
		// $config['attributes']['rel'] = FALSE;
		$this->pagination->initialize($config);


		$data['start'] = $this->uri->segment(4);
		$data['peraturan'] = $this->BeritaPengumuman_Model->getPeraturan($config['per_page'], $data['start']);
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/peraturan', $data);
		$this->load->view('user/layouts/footer');
	}

	public function notulensi()
	{
		if (!$this->session->userdata('id_warga')) {
			redirect('user/auth/');
		}
		$data['all_notulensi'] = $this->db->get('notulensi')->result_array();
		$config['base_url'] = 'http://localhost/warga_berseri/user/dashboard/notulensi';
		$config['total_rows'] = $this->BeritaPengumuman_Model->countAllNotulensi();
		$config['per_page'] = 3;
		$config['num_links'] = 2;

		//styling
		$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</nav></ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		if ($config['total_rows'] > 18) {
			$config['next_link'] = '&raquo';
		} else {
			$config['next_link'] = 'Next';
		}
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		if ($config['total_rows'] > 18) {
			$config['prev_link'] = '&laquo';
		} else {
			$config['prev_link'] = 'Next';
		}
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		// $config['display_pages'] = TRUE;
		// $config['attributes']['rel'] = FALSE;
		$this->pagination->initialize($config);


		$data['start'] = $this->uri->segment(4);
		$data['notulensi'] = $this->BeritaPengumuman_Model->getNotulensi($config['per_page'], $data['start']);
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/notulensi', $data);
		$this->load->view('user/layouts/footer');
	}

	public function informasi()
	{
		$data['all_pengumuman'] = $this->db->get('pengumuman')->result_array();
		$config['base_url'] = 'http://localhost/warga_berseri/user/dashboard/informasi';
		$config['total_rows'] = $this->BeritaPengumuman_Model->countAllPengumuman();
		$config['per_page'] = 3;
		$config['num_links'] = 2;

		//styling
		$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</nav></ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		if ($config['total_rows'] > 18) {
			$config['next_link'] = '&raquo';
		} else {
			$config['next_link'] = 'Next';
		}
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		if ($config['total_rows'] > 18) {
			$config['prev_link'] = '&laquo';
		} else {
			$config['prev_link'] = 'Next';
		}
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		// $config['display_pages'] = TRUE;
		// $config['attributes']['rel'] = FALSE;
		$this->pagination->initialize($config);


		$data['start'] = $this->uri->segment(4);
		$data['pengumuman'] = $this->BeritaPengumuman_Model->getPengumuman($config['per_page'], $data['start']);
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/informasi', $data);
		$this->load->view('user/layouts/footer');
	}

	public function detailInformasi($id = 1)
	{
		$data['pengumuman'] = $this->db->get_where('pengumuman', ['id' => $id])->row_array();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/detail-informasi', $data);
		$this->load->view('user/layouts/footer');
	}
	public function detailBerita($id = 1)
	{
		$data['berita'] = $this->db->get_where('berita', ['id' => $id])->row_array();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/detail-berita', $data);
		$this->load->view('user/layouts/footer');
	}
	public function detailPeraturan($id = 1)
	{
		$data['peraturan'] = $this->db->get_where('peraturan', ['id' => $id])->row_array();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/detail-peraturan', $data);
		$this->load->view('user/layouts/footer');
	}

	public function detailNotulensi($id = 1)
	{
		if (!$this->session->userdata('id_warga')) {
			redirect('user/auth');
		}
		$data['notulensi'] = $this->db->get_where('notulensi', ['id' => $id])->row_array();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/detail-notulensi', $data);
		$this->load->view('user/layouts/footer');
	}

	public function view_fasilitas()
	{
		$query = $this->FasilitasModel->get_fasilitas()->result();
		$data['data_fasilitas'] = $query;

		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/dashboard/V_fasilitas', $data);
		$this->load->view('user/layouts/footer');
	}
}
