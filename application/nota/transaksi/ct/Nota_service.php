<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nota_service extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/m_service','service');
		$this->load->model('transaksi/m_penjualan','Penjualan');

		$this->load->model('Home/Mod_home','Home');
	}

	public function index()
	{
		$d = array(
					'judul' => 'Master',
					'sub_judul' => 'Transaksi - Nota Service',
					'judul_box' => 'Transaksi - Nota Service',
					'class' => "nota_service",
					'kd_svc' => $this->service->create_kd_service(),
					'kd_service' => $this->service->get(),
					'setting' => $this->Home->get_setting(),
					'content'=> 'nota_service/view',
					);
        $this->load->view('home/v_home',$d);
	}

	function getbarang($kd_brg)
	{
		$barang = $this->Penjualan->get_by_id($kd_brg);
		if ($barang)
			{
			if ($barang->stok_brg == '0')
			{
				$disabled = 'disabled';
				$info_stok = '<span class="help-block badge" id="reset"
					          style="background-color: #d9534f;">
					          stok habis</span>';
			}else{
				$disabled = '';
				$info_stok = '<span class="help-block badge" id="reset"
					          style="background-color: #5cb85c;">stok : '
					          .$barang->stok_brg.'</span>';
			}
			echo '<div class="form-group">
				      <label class="control-label col-md-3"
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset"
				        	name="nama_barang" id="nama_barang"
				        	value="'.$barang->nm_brg.'"
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3"
				      	for="harga_barang">Harga (Rp) :</label>
				      <div class="col-md-3">
				        <input type="text" class="form-control reset" id="harga_barang" name="harga_barang"
				        	value="'.number_format( $barang->harga, 0 ,
				        	 '' , '.' ).'" readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3"
				      	for="qty">Quantity :</label>
				      <div class="col-md-2">
				        <input type="number" class="form-control reset"
				        	name="qty" placeholder="Isi qty..." autocomplete="off"
				        	id="qty" onchange="subTotal(this.value)"
				        	onkeyup="subTotal(this.value)" min="0"  onKeyPress="return checkSubmit(event)"
				        	max="'.$barang->stok_brg.'" '.$disabled.'>
				      </div>'.$info_stok.'
				    </div>';
	    }else{
	    	echo '<div class="form-group">
				      <label class="control-label col-md-3"
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset"
				        	name="nama_barang" id="nama_barang"
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3"
				      	for="harga_barang">Harga (Rp) :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset"
				        	name="harga_barang" id="harga_barang"
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3"
				      	for="qty">Quantity :</label>
				      <div class="col-md-4">
				        <input type="number" class="form-control reset"
				        	autocomplete="off" onchange="subTotal(this.value)"
				        	onkeyup="subTotal(this.value)" onKeyPress="return checkSubmit(event) id="qty" min="0"
				        	name="qty" placeholder="Isi qty...">
				      </div>
				    </div>';
	    }
	}

	function cetak_service()
	{
		$data['kode']='';
		if ($this->uri->segment(4) === FALSE)
		{
			$data['kode']='';
		}
		else
		{
			$data['kode'] = $this->uri->segment(4);
		}
		$d['detail'] = $this->service->gcetak_perbaikan($data['kode']);
		if(count($data['detail']->result())>0)
		{
			$d = array(
						'judul' => 'Master',
						'sub_judul' => 'Transaksi - Nota Penjualan',
						'judul_box' => 'Transaksi - Nota Penjualan',
						'class' => "buat_nota",
						'setting' => $this->Home->get_setting(),
						'barang' => $this->Penjualan->get(),
						'kd_tr' => $this->service->create_kd_service(),
						'kode_trans'=>$this->input->post('kd_transaksi'),
					);
	        $this->load->view('transaksi/nota_service/cetak_service/v_cetak',$d);
		}else {
			echo 'Tidak Ada Data';
		}

	}

	function barcode_cetak_service($kode)
	{
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code39', 'image', array('text'=>$kode), array());
	}
}
