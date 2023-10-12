<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iuran extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/PenggunaanIuranModel', 'PenggunaanIuranModel');
		$this->load->model('user/IuranModel', 'IuranModel');
		$this->load->model('user/WargaModelIuran', 'WargaModel');
		$this->load->model('admin/KeuanganModel', 'KeuanganModel');
	}

	public function index()
	{
		if ($this->session->no_hp) {
			//$this->generate_data_iuran();
			$warga = $this->session->all_userdata();
			$data_iuran['iuran'] = $this->IuranModel->get_IuranWarga($warga['id_warga'])->result();
			if (!empty($data_iuran['iuran'])) {
				$data_iuran['nominal'] = $this->IuranModel->nominal_tagihan_iuran($data_iuran['iuran'][0]->id_warga)->result();	
			}
			$this->load->view('user/layouts/header');
			$this->load->view('user/pages/iuran/dataIuranWarga', $data_iuran);
			$this->load->view('user/layouts/footer');
		} else {
			redirect('user/auth');
		}
	}

	//==================Penggunaan Iuran=====================//
	public function data_penggunaan()
	{
		if ($this->session->no_hp) {
			//$this->generate_data_iuran();
			$dataKeuangan['keuangan'] = $this->PenggunaanIuranModel->getKeuangan()->result();
			$dataKeuangan['totalsaldo'] = $this->KeuanganModel->getTotalSaldo()->result();
			$this->load->view('user/layouts/header');
			$this->load->view('user/pages/iuran/dataPenggunaan', $dataKeuangan);
			$this->load->view('user/layouts/footer');
		} else {
			redirect('user/auth');
		}
	}

	public function infoPenggunaanIuran($bulan)
	{
		$data['totalsaldo'] = $this->KeuanganModel->getTotalSaldo()->result();
		$data['pemasukan'] = $this->PenggunaanIuranModel->tampilDataPemasukan($bulan)->result();
		$data['penggunaan'] = $this->PenggunaanIuranModel->tampilDataPenggunaan($bulan)->result();
		$data['keuangan'] = $this->PenggunaanIuranModel->getPemasukanPengeluaran($bulan)->result();
		$this->load->view('user/layouts/header', $data);
		$this->load->view('user/pages/iuran/infoPenggunaan', $data);
		$this->load->view('user/layouts/footer');
		//$this->generate_data_iuran();
	}

	public function riwayat_iuran()
	{
		if ($this->session->no_hp) {
			//$this->generate_data_iuran();
			$warga = $this->session->all_userdata();
			$riwayatIuran['iuran'] = $this->IuranModel->get_IuranWarga_lunas($warga['id_warga'])->result();
			$this->load->view('user/layouts/header');
			$this->load->view('user/pages/iuran/riwayatIuran', $riwayatIuran);
			$this->load->view('user/layouts/footer');
		} else {
			redirect('user/auth');
		}
	}

	public function tambah_data_pembayaran($id)
	{
		//$this->generate_data_iuran();
		$data_iuran['iuran'] = $this->IuranModel->get_tagihanIuran($id)->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/pages/iuran/inputIuran', $data_iuran);
		$this->load->view('user/layouts/footer');
	}

	public function input_data_pembayaran()
	{
		//$this->generate_data_iuran();
		$nama_warga = $this->input->post('nama_warga');
		$tgl     	= $this->input->post('tanggal_pembayaran');
		$pem 		= $this->input->post('pembayaran');
		$id 		= $this->input->post('id_detail_warga');
		$no_tagihan = $this->input->post('no_tagihan');
		$nominal = $this->input->post('nominal');


		$config['upload_path'] = './uploads/bukti_pembayaran_iuran/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('bukti_pembayaran')) {
			echo "<script>alert('Gagal di tambahkan! Periksa kembali file yang anda masukan');history.go(-1);</script>";
		} else {
			$data = array('upload_data'	=>	$this->upload->data());
			$data_iuran = array(
				'tanggal_pembayaran' => $tgl,
				'bukti_pembayaran'	=> "/uploads/bukti_pembayaran_iuran/" . $data['upload_data']['file_name'],
				'status_iuran' => 'Belum Diverifikasi'
			);
			//var_dump($data_iuran);
			$this->IuranModel->tambahDataPembayaran($data_iuran, $no_tagihan);
			//$saldo = $this->KeuanganModel->getTotalSaldo()->result();
			//$total_saldo = $saldo[0]->total_saldo + $nominal;
			//$data_saldo = array('total_saldo' => $total_saldo);
			//$this->KeuanganModel->updateSaldo($data_saldo);
			redirect('user/iuran');
		}
	}
	public function edit_data_penggunaan($id)
	{
		//$this->generate_data_iuran();

		$data_penggunaan['data_penggunaan'] = $this->PenggunaanIuranModel->cari_id_penggunaan($id)->result();

		$this->load->view('theme/atas');
		$this->load->view('AdminIuran/editdataPenggunaan', $data_penggunaan);
		$this->load->view('layouts/footer');
	}

	public function update_data_penggunaan($id)
	{
		//$this->generate_data_iuran();
		$nama = $this->input->post('nama_kebutuhan');
		$jml = $this->input->post('jumlah_pengeluaran');
		$tgl = $this->input->post('tanggal_penggunaan');

		$ket = $this->input->post('keterangan');

		$data = array(
			'nama_kebutuhan' => $nama,
			'jumlah_pengeluaran' => $jml,
			'tanggal_penggunaan' => $tgl,
			'keterangan' => $ket
		);

		$this->PenggunaanIuranModel->editdataPenggunaan($data, $id);
		redirect('AdminIuranController/data_penggunaan');
	}
	public function hapus_data_penggunaan($id)
	{

		$this->PenggunaanIuranModel->hapusdataPenggunaan($id);
		redirect('AdminIuranController/data_penggunaan');
	}
	//===============Data Iuran==================//

	public function view_upload()
	{
		$this->load->view('upload');
	}

	public function upload_bukti_pembayaran()
	{
		$this->generate_data_iuran();

		$config['upload_path'] = './bukti_pembayaran_iuran/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('bukti_pembayaran')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$data = array('upload_data'	=>	$this->upload->data());
			echo $data['upload_data']['file_name'];
		}
	}
	public function download_bukti_pembayaran($no_tagihan)
	{
		$downloadIuran['iuran'] = $this->IuranModel->get_Iuran($no_tagihan)->result();
		$this->load->view('user/pages/iuran/downloadIuran',$downloadIuran);
		
	}

	/// ============================ REKAP IURAN =====================//

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
				$kepkel = $get_kepkel[0]->nama_warga;
					
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
			 		'nama'            => $kepkel,
			 		//'id_detail_warga' => $get_warga[$i]->id_detail_warga,
			 		'jenis'			  => 'wajib',
			 		'nominal' 		  => $nominal ,
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
		$check_rekap_iuran = $this->IuranModel->check_rekap_iuran_bulanan($bulan, $tahun)->result();

		if (count($check_rekap_iuran) == 0) {

			$data_keuangan = array(
				'bulan'              => $bulan,
				'tahun'              => $tahun,
				'jumlah_warga'       => $jumlah_warga_iuran,
				'jumlah_sudah_bayar' => $warga_sudah_bayar,
				'jumlah_belum_bayar' => $warga_belum_bayar,
				
			);

			$this->IuranModel->rekap_iuran_bulanan($data_keuangan);
		} else {

			$data_keuangan = array(
				'bulan'         => $bulan,
				'tahun'         => $tahun,
				'jumlah_warga'      => $jumlah_warga_iuran,
				'jumlah_sudah_bayar'  => $warga_sudah_bayar,
				'jumlah_belum_bayar'  => $warga_belum_bayar,
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
}
