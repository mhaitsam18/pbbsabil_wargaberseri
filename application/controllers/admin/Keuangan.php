<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('tgl_indo');
		$this->load->model('admin/WargaModelIuran', 'WargaModel');
		$this->load->model('admin/AspirasiModel', 'AspirasiModel');
		$this->load->model('admin/IuranModel', 'IuranModel');
		$this->load->model('admin/KeuanganModel', 'KeuanganModel');
	}

	public function index()
	{
		$this->generate_data_iuran();
		$data['title'] = 'Keuangan';
		$data['aspirasi'] = $this->AspirasiModel->getBelumTertangani()->result();
		$data['keuangan'] = $this->KeuanganModel->getKeuangan()->result();
		$data['totalsaldo'] = $this->KeuanganModel->getTotalSaldo()->result();
		//echo "<pre>";
		//	print_r($data['keuangan']);
		// echo "<pre>";	
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/keuangan/index', $data);
		$this->load->view('admin/layouts/footer');
	}
	public function liat()
	{
		$warga[1] = $this->KeuanganModel->getKeuangan()->result();
		print_r($warga);
	}


	public function detail_rekap($bulan, $tahun)
	{
		$this->generate_data_iuran();
		//$data['aspirasi'] = $this->AspirasiModel->getBelumTertangani()->result();
		$rekapIuran['iuran'] = $this->KeuanganModel->get_rekap_info($bulan, $tahun)->result();
		$data['title'] = 'Detail Rekap';

		// var_dump($rekapIuran['iuran']);
		$this->load->view('admin/layouts/header', $data);
		$this->load->view('admin/pages/keuangan/detail_rekap_keuangan', $rekapIuran);
		$this->load->view('admin/layouts/footer');
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
		// $saldo = $this->IuranModel->get_nominal_bulanan($bulan,$tahun)->result();
		// $uang_iuran = $saldo[1]->total_nominal;
		// $tagihan = $saldo[0]->total_nominal;
		$check_rekap_iuran = $this->IuranModel->check_rekap_iuran_bulanan($bulan, $tahun)->result();

		if (count($check_rekap_iuran) == 0) {

			$data_keuangan = array(
				'bulan'              => $bulan,
				'tahun'              => $tahun,
				'jumlah_warga'       => $jumlah_warga_iuran,
				'jumlah_sudah_bayar' => $warga_sudah_bayar,
				'jumlah_belum_bayar' => $warga_belum_bayar,
				// 'saldo'              => $uang_iuran,
				// 'tagihan' => $tagihan
			);

			$this->IuranModel->rekap_iuran_bulanan($data_keuangan);
		} else {

			$data_keuangan = array(
				'bulan'         => $bulan,
				'tahun'         => $tahun,
				'jumlah_warga'      => $jumlah_warga_iuran,
				'jumlah_sudah_bayar'  => $warga_sudah_bayar,
				'jumlah_belum_bayar'  => $warga_belum_bayar,
				// 'saldo'         => $uang_iuran ,
				// 'tagihan' => $tagihan
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
