<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak_Nota extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_nota','cetak_nota');
		$this->load->model('Home/Mod_home','Home');
	}

	public function index()
	{
		$d = array(
					'judul' => 'Transaksi',
					'sub_judul' => 'Cetak Nota',
					'class' => "cetak_nota",
					'setting' => $this->Home->get_setting(),
					'content'=> 'cetak_nota/view',
					);
        $this->load->view('home/v_home',$d);
	}

	//get nota penjualan
	public function get_list_Penjualan()
	{
		$list = $this->cetak_nota->get_dtBarang();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->kd_transaksi;
			$row[] = $person->tgl_transaksi;
			$row[] = "Rp. ". number_format($person->total,0,',','.');
			$row[] = "Rp. ". number_format($person->bayar,0,',','.');
			$row[] = $person->ket_transaksi;
			$row[] = '
			<center>
				<a style="color:blue" href="javascript:void()" onclick="edit_barang('."'".$person->kd_transaksi."'".')" >
					<i class="fa fa-search-plus"></i>
				</a>
				&nbsp &nbsp
				<a style="color:red" href="javascript:void()" onclick="delete_barang('."'".$person->kd_transaksi."'".')">
					<i class="fa fa-trash"></i>
				</a>
			</center>
						';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cetak_nota->hitung_data(),
						"recordsFiltered" => $this->cetak_nota->hitung_filter(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	function cari_barang($kd_brg)
	{
		$data = $this->cetak_nota->get_by_kode($kd_brg);
		echo json_encode($data);
	}
}
