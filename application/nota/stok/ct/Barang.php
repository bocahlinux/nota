<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('stok/mod_brg','Barang');
		$this->load->model('stok/mod_service','Service');
		$this->load->model('stok/mod_satuan','Satuan');
		$this->load->model('home/mod_home','Home');
	}

	public function index()
	{
		/*
		$d['judul'] = "Master";
		$d['sub_judul'] = "Stok Barang";

		$d['barang'] = $this->Barang->cari_dt_satuan();
		$d['class'] = "barang";
		$d['content']= 'Master/Barang/view';
		http://coretanasha21.blogspot.co.id/2012/07/crud-dengan-codeigniter-ajax-jquery_26.html
		*/

		$d = array(
					'judul' => 'Master',
					'sub_judul' => 'Setting Harga',
					'judul_stok' => 'Stok Barang',
					'judul_satuan' => 'Satuan Barang',
					'judul_service' => 'Biaya Service',
					'kd_service' => $this->Service->create_kd_srv(),
					'kd_brg' => $this->Barang->create_kd_brg(),
					'kd_sat' => $this->Satuan->create_kd_sat(),
					'barang' => $this->Barang->cari_dt_satuan(),
					'setting' => $this->Home->get_setting(),
					'class' => "barang",
					'content'=> 'stok/view',
					);
		//$d['kd_brg'] = $this->Barang->create_kd_brg();
        $this->load->view('home/v_home',$d);
	}

	/*
	===================================================================================================================================

			Controller untuk Barang, gabung sama controller satuan di bawah.
			males bikin controler baru untuk satuannya. :P

	===================================================================================================================================
	*/
	public function get_list_dtBarang()
	{
		$list = $this->Barang->get_dtBarang();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->kd_brg;
			$row[] = $person->nm_brg;
			$row[] = "Rp. ". number_format($person->harga,0,',','.');
			$row[] = $person->stok_brg.' '.$person->ket_satuan;
			$row[] = '
			<center>
				<a style="color:blue" href="javascript:void()" onclick="edit_barang('."'".$person->kd_brg."'".')" >
					<i class="fa fa-search-plus"></i>
				</a>
				&nbsp &nbsp
				<a style="color:red" href="javascript:void()" onclick="delete_barang('."'".$person->kd_brg."'".')">
					<i class="fa fa-trash"></i>
				</a>
			</center>
						';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Barang->hitung_data(),
						"recordsFiltered" => $this->Barang->hitung_filter(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	function cari_barang($kd_brg)
	{
		$data = $this->Barang->get_by_kode($kd_brg);
		echo json_encode($data);
	}

	function tambah_barang()
	{
		$data = $this->Barang->create_kd_brg();
		echo json_encode($data);
	}

	function simpan_data_brg()
	{
		$this->_validate_brg();
		$data = array(
				'kd_brg' => $this->input->post('kd_brg'),
				'nm_brg' => $this->input->post('nm_brg'),
				'stok_brg' => $this->input->post('stok_brg'),
				'harga' => $this->input->post('harga_brg'),
				'kd_satuan' => $this->input->post('cari_satuan'),
			);
		$insert = $this->Barang->save($data);
		echo json_encode(array("status" => TRUE));
	}

	function simpan_edit_brg()
	{
		$this->_validate_brg();
		$data = array(
			'kd_brg' => $this->input->post('kd_brg'),
			'nm_brg' => $this->input->post('nm_brg'),
			'stok_brg' => $this->input->post('stok_brg'),
			'harga' => $this->input->post('harga_brg'),
			'kd_satuan' => $this->input->post('cari_satuan'),
			);
		$this->Barang->update(array('kd_brg' => $this->input->post('kd_brg')), $data);
		echo json_encode(array("status" => TRUE));
	}

	function hapus_barang($kd_brg)
	{
		$this->Barang->delete_by_kode($kd_brg);
		echo json_encode(array("status" => TRUE));
	}

	function _validate_brg()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kd_brg') == '')
		{
			$data['inputerror'][] = 'kd_brg';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nm_brg') == '')
		{
			$data['inputerror'][] = 'nm_brg';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('stok_brg') == '')
		{
			$data['inputerror'][] = 'stok_brg';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('cari_satuan') == '--')
		{
			$data['inputerror'][] = 'cari_satuan';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('harga_brg') == '')
		{
			$data['inputerror'][] = 'harga_brg';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	/*
	===================================================================================================================================

			Controller untuk satuan, lagi males bikin file controler satuan sendiri jadi digabung disini aja

	===================================================================================================================================
	*/

	public function get_list_dtSatuan()
	{
		$list = $this->Satuan->get_dtSatuan();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->kd_satuan;
			$row[] = $person->ket_satuan;
			$row[] = '
			<center>
				<a style="color:green" href="javascript:void()" onclick="edit_satuan('."'".$person->kd_satuan."'".')" >
					<i class="fa fa-search-plus"></i>
				</a>
				&nbsp &nbsp
				<a style="color:red" href="javascript:void()"  onclick="delete_person('."'".$person->kd_satuan."'".')">
					<i class="fa fa-trash"></i>
				</a>
			</center>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Satuan->hitung_data(),
			"recordsFiltered" => $this->Satuan->hitung_filter(),
			"data" => $data,
			);
		//output to json format
		echo json_encode($output);
	}

	function cari_satuan($kd_satuan)
	{
		$data = $this->Satuan->get_by_kode($kd_satuan);
		echo json_encode($data);
	}

	function tambah_satuan()
	{

		$data = $this->Satuan->create_kd_sat();
		echo json_encode($data);
	}

	function simpan_data_sat()
	{
		$this->_validate_sat();
		$data = array(
			'kd_satuan' => $this->input->post('kd_sat'),
			'ket_satuan' => $this->input->post('nm_satuan'),
			);
		$insert = $this->Satuan->save_satuan($data);
		echo json_encode(array("status" => TRUE));
	}

	function simpan_edit_sat()
	{
		$this->_validate_sat();
		$data = array(
			'kd_satuan' => $this->input->post('kd_sat'),
			'ket_satuan' => $this->input->post('nm_satuan'),
			);
		$this->Satuan->update_satuan(array('kd_satuan' => $this->input->post('kd_sat')), $data);
		echo json_encode(array("status" => TRUE));
	}

	function hapus_satuan($kd_satuan)
	{
		$this->Satuan->delete_by_kode($kd_satuan);
		echo json_encode(array("status" => TRUE));
	}

	function _validate_sat()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kd_sat') == '')
		{
			$data['inputerror'][] = 'kd_sat';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nm_satuan') == '')
		{
			$data['inputerror'][] = 'nm_satuan';
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
