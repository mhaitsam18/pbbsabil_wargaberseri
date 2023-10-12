<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasukan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/WargaModelIuran', 'WargaModel');
		$this->load->model('admin/AspirasiModel', 'AspirasiModel');
		$this->load->model('admin/IuranModel', 'IuranModel');
		$this->load->model('admin/KeuanganModel', 'KeuanganModel');
		$this->load->model('admin/PemasukanIuranModel', 'PemasukanIuranModel');
		$this->load->model('admin/PenggunaanIuranModel', 'PenggunaanIuranModel');
	}

	public function index()
	{
		$data['aspirasi'] = $this->AspirasiModel->getBelumTertangani()->result();
		$data['saldo'] = $this->KeuanganModel->getTotalSaldo()->result();
		$data['pemasukan'] = $this->PemasukanIuranModel->pemasukan_bulanan()->result();
		$data['title'] = 'Pemasukan';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/pemasukan/index', $data);
		$this->load->view('admin/layouts/footer');
		$this->generate_data_iuran();
	}

	public function tampil_bulanan($bulan)
	{
		$data['aspirasi'] = $this->AspirasiModel->getBelumTertangani()->result();
		$data['saldo'] = $this->KeuanganModel->getTotalSaldo()->result();
		$data['pemasukan'] = $this->PemasukanIuranModel->tampilDataPemasukan($bulan)->result();
		$data['title'] = 'Tampil Bulanan';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/pemasukan/pemasukanBulanan', $data);
		$this->load->view('admin/layouts/footer');
		$this->generate_data_iuran();
	}

	public function detail_pemasukan($id_pemasukan)
	{
		$this->generate_data_iuran();
		$data['title'] = 'Detail Pemasukan';
		$data_pemasukan['pemasukan'] = $this->PemasukanIuranModel->get_pemasukan_byID($id_pemasukan)->result();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/pemasukan/bukaPemasukan', $data_pemasukan);
		$this->load->view('admin/layouts/footer');
	}

	public function tambah_pemasukan()
	{
		$this->generate_data_iuran();
		$data['title'] = 'Tambah Pemasukan';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/pemasukan/tambahPemasukan');
		$this->load->view('admin/layouts/footer');
	}


	public function input_data_pemasukan()
	{
		$this->generate_data_iuran();
		$data_form = $this->input->post();
		$total_saldo = $this->KeuanganModel->getTotalSaldo()->result();
		$pemasukan = $total_saldo[0]->total_saldo + $data_form['jumlah_pemasukan'];

		$bulan_convert = strtotime($data_form['tanggal_pemasukan']);
		$bulan = date('M', $bulan_convert);
		$tahun = date('Y', $bulan_convert);

		$check = $this->KeuanganModel->check_bulan_tahun($bulan, $tahun)->result();

		//print_r($check);
		// echo $bulan;

		$config['upload_path'] = './uploads/bukti_pemasukan/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('bukti_pemasukan')) {
			echo "<script>alert('Gagal di tambahkan! Periksa kembali file yang anda masukan');</script>";
		} else {
			$data = array('upload_data'	=>	$this->upload->data());
			$admin = $this->session->all_userdata();
			$data = array(
				'nama_pemasukan' => $data_form['nama_pemasukan'],
				'kategori' => $data_form['kategori'],
				'jumlah_pemasukan' => $data_form['jumlah_pemasukan'],
				'tanggal_pemasukan' => $data_form['tanggal_pemasukan'],
				'bukti_pemasukan'	=> "/uploads/bukti_pemasukan/" . $data['upload_data']['file_name'],
				'keterangan' => $data_form['keterangan'],
				'id_admin' => $admin['id'],
				'bulan_pemasukan' => $bulan,
				'tahun_pemasukan' => $tahun
			);
			$totalsaldo = array('total_saldo' => $pemasukan);
			if (empty($check)) {
				$tagihan_bulanan = date('ym');
				$jumlah_warga = $this->WargaModel->jumlah_rumah()->result();
				$tagihan_lunas_bulanan = $this->IuranModel->data_iuran_lunas_bulanan($bulan, $tahun)->result();
				$jumlah_warga_iuran = count($jumlah_warga);
				$warga_sudah_bayar = count($tagihan_lunas_bulanan);
				$warga_belum_bayar = count($tagihan_bulanan);
				$check_rekap_iuran = $this->IuranModel->check_rekap_iuran_bulanan($bulan, $tahun)->result();
				$data_keuangan = array(
					'bulan'              => $bulan,
					'tahun'              => $tahun,
					'jumlah_warga'       => $jumlah_warga_iuran,
					'jumlah_sudah_bayar' => $warga_sudah_bayar,
					'jumlah_belum_bayar' => $warga_belum_bayar,
					//'saldo'              => $uang_iuran,
					//'tagihan' 			 => $tagihan
				);
				$this->IuranModel->rekap_iuran_bulanan($data_keuangan);
				$this->PemasukanIuranModel->tambahdataPemasukan($data);
				$this->KeuanganModel->updateSaldo($totalsaldo);
				redirect('admin/pemasukan/');
			} else {
				$this->PemasukanIuranModel->tambahdataPemasukan($data);
				$this->KeuanganModel->updateSaldoPem($bulan, $tahun, $totalsaldo);
				$this->KeuanganModel->updateSaldo($totalsaldo);
				redirect('admin/pemasukan/');
			}
		}
		//print_r($check);
	}
	//print_r($check);


	public function edit_data_pemasukan($id)
	{
		$this->generate_data_iuran();
		$data['pemasukan'] = $this->PemasukanIuranModel->get_Pemasukan_byID($id)->result();
		$data['title'] = 'Edit Data Pemasukan';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/pemasukan/editPemasukan', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function update_data_pemasukan($where)
	{
		$this->generate_data_iuran();
		$data_form = $this->input->post();
		$total_saldo = $this->KeuanganModel->getTotalSaldo()->result();
		$saldo_awal = $total_saldo[0]->total_saldo - $data_form['jumlah_pemasukan_awal'];
		$saldo = array('total_saldo' => $saldo_awal);
		$this->KeuanganModel->updateSaldo($saldo);

		$bulan_convert = strtotime($data_form['tanggal_pemasukan']);
		$bulan = date('M', $bulan_convert);
		$tahun = date('Y', $bulan_convert);

		$total_saldo_baru = $this->KeuanganModel->getTotalSaldo()->result();
		$pemasukan = $total_saldo_baru[0]->total_saldo + $data_form['jumlah_pemasukan'];


		if ($pemasukan < 0) {
			$this->session->set_flashdata('error', 'Saldo Tidak Mencukupi');
			redirect('Pemasukan/edit_data_Pemasukan/' . $where);
		} else {
			$admin = $this->session->all_userdata();

			if (empty($_FILES['bukti_pemasukan']['name'])) {

				$data_update = array(
					'nama_pemasukan' 		=> $data_form['nama_pemasukan'],
					'jumlah_pemasukan' 		=> $data_form['jumlah_pemasukan'],
					'tanggal_Pemasukan'		=> $data_form['tanggal_pemasukan'],
					'keterangan'			=> $data_form['keterangan'],
					'id_admin'				=> $admin['id'],
					'bulan_pemasukan' 		=> $bulan,
					'tahun_pemasukan' 		=> $tahun
				);
				$saldo = array('total_saldo' => $pemasukan);
				$this->PemasukanIuranModel->editDataPemasukan($data_update, $where);
				$this->KeuanganModel->updateSaldoPem($bulan, $tahun, $saldo);
				$this->KeuanganModel->updateSaldo($saldo);
				redirect('admin/pemasukan/');
			} else {

				$config['upload_path'] = './uploads/bukti_pemasukan/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '10000';
				$config['max_width'] = '10000';
				$config['max_height'] = '10000';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('bukti_pemasukan')) {
					echo "<script>alert('Gagal di tambahkan! Periksa kembali file yang anda masukan');</script>";
				} else {
					$data = array('upload_data'	=>	$this->upload->data());
					$admin = $this->session->all_userdata();

					$data = array(
						'nama_pemasukan' 	=> $data_form['nama_pemasukan'],
						'jumlah_pemasukan' 	=> $data_form['jumlah_pemasukan'],
						'tanggal_pemasukan' => $data_form['tanggal_pemasukan'],
						'bukti_pemasukan'	=> "/uploads/bukti_pemasukan/" . $data['upload_data']['file_name'],
						'keterangan' 		=> $data_form['keterangan'],
						'id_admin' 			=> $admin['id'],
						'bulan_pemasukan' 	=> $bulan,
						'tahun_pemasukan' 	=> $tahun
					);
					$saldo = array('total_saldo' => $pemasukan);
					$this->PemasukanIuranModel->editDataPemasukan($data, $where);
					$this->KeuanganModel->updateSaldoPem($bulan, $tahun, $saldo);
					$this->KeuanganModel->updateSaldo($saldo);
					redirect('admin/pemasukan/');
				}
			}
		}
	}

	public function hapus_data_pemasukan($id)
	{
		$this->generate_data_iuran();
		$data_Pemasukan = $this->PemasukanIuranModel->get_Pemasukan_byID($id)->result();
		$saldo = $this->KeuanganModel->getTotalSaldo()->result();
		$total_saldo = $saldo[0]->total_saldo - $data_Pemasukan[0]->jumlah_pemasukan;
		$saldo_baru = array('total_saldo' => $total_saldo);
		$this->KeuanganModel->updateSaldo($saldo_baru);
		$this->PemasukanIuranModel->hapusDataPemasukan($id);
		redirect('admin/pemasukan/');
	}


	//==================================== GENERATE IURAN ===========================//


	public function generate_data_iuran()
	{
		$this->generate_iuran();
		$this->generate_rekap_iuran();
		$this->generate_totalsaldo();
	}


	public function generate_iuran()
	{
		$tagihan_bulanan = date('ym');
		$get_rumah = $this->WargaModel->getrumah();
		$get_warga = $this->WargaModel->getwarga();
		for ($i = 0; $i < count($get_rumah); $i++) {
			$check_tagihan_bulanan  = $this->IuranModel->check_data_iuran($tagihan_bulanan, $get_rumah[$i]->id_warga)->result();
			$sw = $this->IuranModel->check_status($get_rumah[$i]->id_warga)->result();
			$get_kepkel = $this->IuranModel->get_kepala_keluarga($get_rumah[$i]->id_warga)->result();
			$stat = $sw[0]->status_rumah;
			// $kepkel = $get_kepkel[0]->nama_warga;

			if (empty($check_tagihan_bulanan)) {
				$notagihan = date('ymhis');
				$nominal = 0;
				if ($stat == "Rumah Tinggal") {
					$nominal = 100000;
				} elseif ($stat == 'Rumah Usaha') {
					$nominal = 200000;
				} elseif ($sw = 'Rumah Pribadi') {
					$nominal = 150000;
				}
				$data_iuran = array(
					'no_tagihan'      => $notagihan + $i,
					'id_warga' => $get_rumah[$i]->id_warga,
					'nama'            => $get_kepkel[0]->nama_warga,
					//'id_detail_warga' => $get_warga[$i]->id_detail_warga,
					'jenis'			  => 'wajib',
					'nominal' 		  => $nominal,
					'bulan_iuran'     => date('M'),
					'tahun_iuran'     => date('Y')
				);
				$this->IuranModel->tambahDataIuran($data_iuran);
				//print_r($data_iuran);
			}
			//print_r($kepkel);
			//print_r($check_tagihan_bulanan);

		}
	}

	public function generate_rekap_iuran()
	{
		$bulan = date('M');
		$tahun = date('Y');
		$tagihan_bulanan = date('ym');
		$jumlah_warga = $this->WargaModel->jumlah_rumah()->result();
		$tagihan_lunas_bulanan = $this->IuranModel->data_iuran_lunas_bulanan($bulan, $tahun)->result();
		$jumlah_warga_iuran = count($jumlah_warga);
		$warga_sudah_bayar = count($tagihan_lunas_bulanan);
		$warga_belum_bayar = $jumlah_warga_iuran - $warga_sudah_bayar;
		//$uang_iuran = count($tagihan_lunas_bulanan) * 100000;
		$saldo = $this->IuranModel->get_nominal_bulanan($bulan, $tahun)->result();
		//$uang_iuran = $saldo[1]->total_nominal;
		//$tagihan = $saldo[0]->total_nominal;
		$check_rekap_iuran = $this->IuranModel->check_rekap_iuran_bulanan($bulan, $tahun)->result();
		$pemasukan[0] = $this->PemasukanIuranModel->pemasukan_bulanan()->result();

		if (count($check_rekap_iuran) == 0) {

			$data_keuangan = array(
				'bulan'              => $bulan,
				'tahun'              => $tahun,
				'jumlah_warga'       => $jumlah_warga_iuran,
				'jumlah_sudah_bayar' => $warga_sudah_bayar,
				'jumlah_belum_bayar' => $warga_belum_bayar,
				// 'saldo'              => $uang_iuran,
				// 'tagihan' 			 => $tagihan,
				//'pemasukan'			 => $pemasukan
			);

			$this->IuranModel->rekap_iuran_bulanan($data_keuangan);
		} else {

			$data_keuangan = array(
				'bulan'         	  => $bulan,
				'tahun'            	  => $tahun,
				'jumlah_warga'        => $jumlah_warga_iuran,
				'jumlah_sudah_bayar'  => $warga_sudah_bayar,
				'jumlah_belum_bayar'  => $warga_belum_bayar,
				// 'saldo'         	  => $uang_iuran,
				// 'tagihan'  			  => $tagihan,
				//'pemasukan'			  => $pemasukan
			);

			$this->IuranModel->update_rekap_iruan_bulanan($bulan, $tahun, $data_keuangan);
		} //print_r($uang_iuran);
	}

	public function generate_totalsaldo()
	{

		$check_totalsaldo = $this->IuranModel->check_totalsaldo()->result();

		if (count($check_totalsaldo) == 0) {
			$total_saldo_iuran = $this->IuranModel->getsaldo()->result();

			$this->IuranModel->tambah_totalsaldo($total_saldo_iuran[0]->total_saldo);
		}
	}
	public function coba()
	{
		$pemasukan = $this->PemasukanIuranModel->pemasukan_bulanan('Mar', '2021')->result();
		print_r($pemasukan);
	}
}
