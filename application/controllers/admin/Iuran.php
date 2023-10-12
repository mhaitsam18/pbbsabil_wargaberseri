<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iuran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('tgl_indo');
		$this->load->model('admin/WargaModelIuran', 'WargaModel');
		$this->load->model('admin/AspirasiModel', 'AspirasiModel');
		$this->load->model('admin/IuranModel', 'IuranModel');
		$this->load->model('admin/KeuanganModel', 'KeuanganModel');
		$this->load->model('admin/PemasukanIuranModel', 'PemasukanIuranModel');
	}

	public function index()
	{
		$this->generate_data_iuran();
		redirect('dashboard/');
	}

	//==================Penggunaan Iuran=====================//

	public function data_penggunaan_iuran()
	{
		$this->generate_data_iuran();
		$data['title'] = 'Iuran';
		$dataPenggunaan['penggunaan'] = $this->PenggunaanIuranModel->tampilDataPenggunaan()->result();
		$data['aspirasi'] = $this->AspirasiModel->getBelumTertangani()->result();
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('penggunaan/dataPenggunaan', $dataPenggunaan);
		$this->load->view('admin/layouts/footer');
	}


	public function tambah_penggunaan()
	{
		$this->generate_data_iuran();
		$data['title'] = 'Tambah Penggunaan';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('penggunaan/tambahPenggunaan');
		$this->load->view('admin/layouts/footer');
	}
	public function input_data_penggunaan()
	{
		$this->generate_data_iuran();
		$data_form = $this->input->post();



		$config['upload_path'] = './bukti_pengeluaran_penggunaan/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('bukti_penggunaan')) {
			echo "<script>alert('Gagal di tambahkan! Periksa kembali file yang anda masukan');history.go(-1);</script>";
		} else {
			$data = array('upload_data'	=>	$this->upload->data());
			$admin = $this->session->all_userdata();

			$data = array(
				'nama_kebutuhan' => $data_form['nama_kebutuhan'],
				'jumlah_pengeluaran' => $data_form['jumlah_pengeluaran'],
				'tanggal_penggunaan' => $data_form['tanggal_penggunaan'],
				'bukti_pengeluaran'	=> "/admin/bukti_pengeluaran_penggunaan/" . $data['upload_data']['file_name'],
				'keterangan' => $data_form['keterangan'],
				'id_admin' => $admin['id_admin']
			);

			$this->PenggunaanIuranModel->tambahdataPenggunaan($data);
			redirect('IuranController/data_penggunaan_iuran');
		}
	}
	public function edit_data_penggunaan($id)
	{
		$this->generate_data_iuran();

		$data_penggunaan['data_penggunaan'] = $this->PenggunaanIuranModel->cari_id_penggunaan($id)->result();
		$data['title'] = 'Edit Data Penggunaan';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('penggunaan/editPenggunaan', $data_penggunaan);
		$this->load->view('admin/layouts/footer');
	}

	public function update_data_penggunaan($id)
	{
		$this->generate_data_iuran();
		$data_edit = $this->input->post();

		$data = array(
			'nama_kebutuhan' => $data_edit['nama_kebutuhan'],
			'jumlah_pengeluaran' => $data_edit['jumlah_pengeluaran'],
			'tanggal_penggunaan' => $data_edit['tanggal_penggunaan'],
			'keterangan' => $data_edit['keterangan']
		);

		$this->PenggunaanIuranModel->editdataPenggunaan($data, $id);
		redirect('IuranController/data_penggunaan_iuran');
	}
	public function hapus_data_penggunaan($id)
	{
		$this->PenggunaanIuranModel->hapusdataPenggunaan($id);
		redirect('IuranController/data_penggunaan_iuran');
	}
	//===============Data Iuran==================//

	public function view_dataIuran()
	{
		$dataIuran['aspirasi'] = $this->AspirasiModel->getBelumTertangani()->result();
		$this->generate_data_iuran();
		$dataIuran['iuran'] = $this->IuranModel->tampilDataPembayaran()->result();
		$dataIuran['title'] = 'Keuangan';
		$this->load->view('admin/layouts/header', $dataIuran);
		$this->load->view('admin/pages/iuran/dataIuran', $dataIuran);
		$this->load->view('admin/layouts/footer');
	}

	public function riwayat_iuran()
	{
		$this->generate_data_iuran();
		$dataRiwayat['iuran'] = $this->IuranModel->tampilRiwayatPembayaran()->result();
		$data['title'] = 'Riwayat Iuran';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/iuran/riwayatIuran', $dataRiwayat);
		$this->load->view('admin/layouts/footer');
	}

	public function bayar_iuran_langsung($id)
	{
		$this->generate_data_iuran();
		//$data['aspirasi'] = $this->AspirasiModel->getBelumTertangani()->result();
		$data['iuran'] = $this->IuranModel->get_iuran_bytagihan($id)->result();
		$data['title'] = 'Bayar Iuran';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/iuran/bayarLangsung', $data);
		$this->load->view('admin/layouts/footer');
	}


	public function tambah_iuran()
	{
		$this->generate_data_iuran();
		$data['warga'] = $this->WargaModel->getrumah();
		$data['title'] = 'Tambah Iuran';
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/iuran/tambahIuran', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function iuran_tambahan()
	{
		$this->generate_iuran_tambahan();
		$data['warga'] = $this->WargaModel->getrumah();
		redirect('admin/iuran/view_dataIuran');
		// $this->load->view('admin/layouts/header');
		// $this->load->view('admin/pages/iuran/tambahIuran', $data);
		// $this->load->view('admin/layouts/footer');
	}



	public function input_data_iuran()
	{
		$this->generate_data_iuran();
		$data_form = $this->input->post();
		$data_warga = $this->WargaModel->get_tagihan($data_form['id_warga']);

		$config['upload_path'] = './uploads/bukti_iuran_warga/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$data = array('upload_data'	=>	$this->upload->data());

		$data_pembayaran = array(
			'tanggal_pembayaran' 	=> $data_form['tanggal_pembayaran'],
			'bukti_pembayaran' 		=> 'Pembayaran Tunai', //'/admin/bukti_iuran_warga/'.$data['upload_data']['file_name'],
			'status_iuran'			=> 'Lunas'
		);

		$this->IuranModel->tambahDataPembayaran($data_pembayaran, $data_form['no_tagihan']);
		$nominal = $data_form['nominal'];
		$saldo = $this->KeuanganModel->getTotalSaldo()->result();
		$total_saldo = $saldo[0]->total_saldo + $nominal;
		$data_saldo = array('total_saldo' => $total_saldo);
		$this->KeuanganModel->updateSaldo($data_saldo);
		redirect('admin/iuran/view_dataIuran');
	}


	public function verifikasi_iuran($tagihan)
	{
		$this->generate_data_iuran();
		$saldo = $this->KeuanganModel->getTotalSaldo()->result();
		$nominal = $this->IuranModel->nominal_tagihan($tagihan)->result();
		$nom = $nominal[0]->nominal;
		$total_saldo = $saldo[0]->total_saldo;
		$jumlah = $nom + $total_saldo;
		$data_saldo = array('total_saldo' => $jumlah);
		$this->KeuanganModel->updateSaldo($data_saldo);
		$this->IuranModel->verifikasi_iuran($tagihan);
		//print_r($jumlah);
		redirect('admin/iuran/view_dataIuran');
	}
	public function tolak_verifikasi($tagihan)
	{
		$data_iuran = $this->IuranModel->tolak_verifikasi($tagihan);
		//print_r($data_iuran);
		redirect('admin/iuran/view_dataIuran');
	}


	//===============Upload==================//
	public function view_upload()
	{
		$this->load->view('upload');
	}

	public function upload_bukti_pengeluaran()
	{

		$config['upload_path'] = './bukti_pengeluaran_penggunaan/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('bukti_penggunaan')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$data = array('upload_data'	=>	$this->upload->data());
			echo $data['upload_data']['file_name'];
		}
	}

	// ================================ GENERATE ===============// 

	public function generate_data_iuran()
	{
		$this->generate_iuran();
		$this->generate_rekap_iuran();
		$this->generate_totalsaldo();
	}
	public function generate_iuran_tambahan()
	{
		$data_form = $this->input->post();
		$tagihan_bulanan = date('ym');
		$get_rumah = $this->WargaModel->getrumah();
		$get_warga = $this->WargaModel->getwarga();
		for ($i = 0; $i < count($get_rumah); $i++) {
			$sw = $this->IuranModel->check_status($get_rumah[$i]->id_warga)->result();
			$get_kepkel = $this->IuranModel->get_kepala_keluarga($get_rumah[$i]->id_warga)->result();
			$stat = $sw[0]->status_rumah;
			$kepkel = $get_kepkel[0]->nama_warga;

			$notagihan = date('ymhis');
			$nominal = 0;
			$data_iuran = array(
				'no_tagihan'      => $notagihan + $i,
				'id_warga' => $get_rumah[$i]->id_warga,
				'nama'            => $kepkel,
				//'id_detail_warga' => $get_warga[$i]->id_detail_warga,
				'jenis'			  => 'tambahan',
				'nominal' 		  => $data_form['nominal'],
				'bulan_iuran'     => date('M'),
				'tahun_iuran'     => date('Y')
			);
			$this->IuranModel->tambahDataIuran($data_iuran);
			//print_r($data_iuran);

			//print_r($kepkel);

		}
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
		//$saldo = $this->IuranModel->get_nominal_bulanan($bulan,$tahun)->result();
		//$uang_iuran = $saldo[1]->total_nominal;
		//$tagihan = $saldo[0]->total_nominal;
		$check_rekap_iuran = $this->IuranModel->check_rekap_iuran_bulanan($bulan, $tahun)->result();

		if (count($check_rekap_iuran) == 0) {

			$data_keuangan = array(
				'bulan'              => $bulan,
				'tahun'              => $tahun,
				'jumlah_warga'       => $jumlah_warga_iuran,
				'jumlah_sudah_bayar' => $warga_sudah_bayar,
				'jumlah_belum_bayar' => $warga_belum_bayar,
				//'saldo'              => $uang_iuran,
				//'tagihan' => $tagihan
			);

			$this->IuranModel->rekap_iuran_bulanan($data_keuangan);
		} else {

			$data_keuangan = array(
				'bulan'         => $bulan,
				'tahun'         => $tahun,
				'jumlah_warga'      => $jumlah_warga_iuran,
				'jumlah_sudah_bayar'  => $warga_sudah_bayar,
				'jumlah_belum_bayar'  => $warga_belum_bayar,
				//'saldo'         => $uang_iuran,
				//'tagihan' => $tagihan
			);

			$this->IuranModel->update_rekap_iruan_bulanan($bulan, $tahun, $data_keuangan);
		} //print_r($saldo);
	}

	public function generate_totalsaldo()
	{

		$check_totalsaldo = $this->IuranModel->check_totalsaldo()->result();

		if (count($check_totalsaldo) == 0) {
			$total_saldo_iuran = $this->IuranModel->getsaldo()->result();

			$this->IuranModel->tambah_totalsaldo($total_saldo_iuran[0]->total_saldo);
		}
	}

	public function contoh()
	{
		$bulan = date('M');
		$tahun = date('Y');
		$saldo = $this->IuranModel->get_nominal_bulanan($bulan, $tahun)->result();
		echo $saldo[0]->total_nominal;
	}
}
