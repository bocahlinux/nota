<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_service extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Stok/Mod_service','Service');
		$this->load->model('Home/Mod_home','Home');
	}

	public function index()
	{
		/*
		$d['judul'] = "Master";
		$d['sub_judul'] = "Stok Barang";

		$d['barang'] = $this->Service->cari_dt_satuan();
		$d['class'] = "barang";
		$d['content']= 'Master/Barang/view';
		http://coretanasha21.blogspot.co.id/2012/07/crud-dengan-codeigniter-ajax-jquery_26.html
		*/
		
		$d = array(
					'judul' => 'Master',
					'content'=> 'Stok/v_service',
					);
		//$d['kd_brg'] = $this->Service->create_kd_brg();
        $this->load->view('Home/v_home',$d);
	}

	/*
	===================================================================================================================================
	
			Controller untuk Barang, gabung sama controller satuan di bawah.
			males bikin controler baru untuk satuannya. :P

	===================================================================================================================================
	*/
	public function get_list_dtService()
	{
		$list = $this->Service->get_dtService();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->kd_service;
			$row[] = $person->nm_service;
			$row[] = "Rp. ". number_format($person->harga_service,0,',','.');			
			$row[] = '
			<center>
				<a style="color:blue" href="javascript:void()" onclick="edit_service('."'".$person->kd_service."'".')" >
					<i class="fa fa-search-plus"></i>
				</a>
				&nbsp &nbsp
				<a style="color:red" href="javascript:void()" onclick="delete_service('."'".$person->kd_service."'".')">
					<i class="fa fa-trash"></i>
				</a>
			</center>
						';
			$data[] = $row; 
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Service->hitung_data(),
						"recordsFiltered" => $this->Service->hitung_filter(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	function cari_service($kd_service)
	{
		$data = $this->Service->get_by_kode($kd_service);
		echo json_encode($data);
	}

	function tambah_service()
	{
		$data = $this->Service->create_kd_srv();
		echo json_encode($data);
	}

	function simpan_data_srv()
	{
		$this->_validate_srv();
		$data = array(
				'kd_service' => $this->input->post('kd_service'),
				'nm_service' => $this->input->post('jns_service'),
				'harga_service' => $this->input->post('harga_service'),				
			);
		$insert = $this->Service->save_service($data);
		echo json_encode(array("status" => TRUE));
	}

	function simpan_edit_srv()
	{
		$this->_validate_srv();
		$data = array(
			'kd_service' => $this->input->post('kd_service'),
			'nm_service' => $this->input->post('jns_service'),
			'harga_service' => $this->input->post('harga_service'),
			);
		$this->Service->update_service(array('kd_service' => $this->input->post('kd_service')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
	function hapus_srv($kd_service)
	{
		$this->Service->delete_kode_service($kd_service);
		echo json_encode(array("status" => TRUE));
	}

	function _validate_srv()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kd_service') == '')
		{
			$data['inputerror'][] = 'kd_service';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('jns_service') == '')
		{
			$data['inputerror'][] = 'jns_service';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('harga_service') == '')
		{
			$data['inputerror'][] = 'harga_service';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}