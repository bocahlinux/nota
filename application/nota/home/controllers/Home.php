<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Stok/Mod_brg','Barang');
		$this->load->model('Stok/Mod_satuan','Satuan');
		$this->load->model('Home/Mod_home','Home');
	}

	public function index()
	{
		$d['judul'] = "Halaman Utama";
		$d['sub_judul'] = "";

		$d['stok_brg'] = $this->Barang->hitung_data();
		$d['sat_brg'] = $this->Satuan->hitung_data();
		$d['setting'] = $this->Home->get_setting();

		$d['class'] = "home";
		$d['content']= 'home/v_isi';
        $this->load->view('home/v_home',$d);
	}
}
