<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nota_penjualan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('html','text_helper','url','form'));
		$this->load->library(array('form_validation'));
		$this->load->model('transaksi/m_penjualan','Penjualan');
		$this->load->model('home/mod_home','Home');

	}

	function index()
	{
		$d = array(
					'judul' => 'Master',
					'sub_judul' => 'Transaksi - Nota Penjualan',
					'judul_box' => 'Transaksi - Nota Penjualan',
					'class' => "buat_nota",
					'setting' => $this->Home->get_setting(),
					'barang' => $this->Penjualan->get(),
					'kd_tr' => $this->Penjualan->create_kd_penjualan(),
					'content'=> 'nota_penjualan/view',
					);
        $this->load->view('home/v_home',$d);
	}

	function getKode(){
		$d['kd_tr'] = $this->Penjualan->create_kd_penjualan();
		echo json_encode($d);
	}
	function getbarang($kd_brg)
	{
		$barang = $this->Penjualan->get_by_id($kd_brg);
		if ($barang)
			{
			if ($barang->stok_brg == '0')
			{
				$disabled = 'disabled';
				$info_stok = '<span class="help-block badge" id="stok_angka" name="stok_angka"
					          style="background-color: #d9534f;">
					          stok habis</span>';
			}else{
				$disabled = '';
				$info_stok = '<span class="help-block badge" id="stok_angka" name="stok_angka"
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

	function ajax_list_transaksi()
	{
		$data = array();
		$no = 1;
        foreach ($this->cart->contents() as $items){

			$row = array();
			$row[] = $no;
			$row[] = $items["id"];
			$row[] = $items["name"];
			$row[] = 'Rp. ' . number_format( $items['price'],
                    0 , '' , '.' ) . ',-';
			$row[] = $items["qty"];
			$row[] = 'Rp. ' . number_format( $items['subtotal'],
					0 , '' , '.' ) . ',-';

			//add html for action
			$row[] = '<a
				href="javascript:void()" style="color:rgb(255,128,128);
				text-decoration:none" onclick="deletebarang('
					."'".$items["rowid"]."'".','."'".$items['subtotal'].
					"'".')">

						<button type="button" class="btn btn-xs btn-danger">
						      		  <i class="fa fa-close"></i> Delete</button>
					</a>';
			$data[] = $row;
			$no++;
        }

		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	function addbarang()
	{
		$data = array(
				'id' => $this->input->post('kd_brg'),
				'name' => $this->input->post('nama_barang'),
				'price' => str_replace('.', '', $this->input->post('harga_barang')),
				'qty' => $this->input->post('qty')
			);
		$insert = $this->cart->insert($data);
		echo json_encode(array("status" => TRUE));
	}

	function deletebarang($rowid)
	{
		$this->cart->update(array(
				'rowid'=>$rowid,
				'qty'=>0,));
		echo json_encode(array("status" => TRUE));
	}

	function simpan_dt_penjualan()
	{

		$d = array(
					'judul' => 'Master',
					'sub_judul' => 'Transaksi - Nota Penjualan',
					'judul_box' => 'Transaksi - Nota Penjualan',
					'class' => "buat_nota",
					'setting' => $this->Home->get_setting(),
					'barang' => $this->Penjualan->get(),
					'kd_tr' => $this->Penjualan->create_kd_penjualan(),
					'content'=> 'nota_penjualan/view',
					'kd_tr2' => $this->input->post('hid_kd_transaksi'),
					);
					$pecah_total		=		explode(".",$this->input->post('total'));
					$pecah_bayar		=		explode(".",$this->input->post('bayar'));

					$kode_trans			=		$this->input->post('hid_kd_transaksi');
					$kd_pelanggan 	=		'-';
					$total					=		implode("",$pecah_total);
					$bayar					=		implode("",$pecah_bayar);
					$kembali				=		$this->input->post('kembali');

					$pecah_kbl1			=		explode(".",$kembali);
					$gbg_kbl1				=		implode("",$pecah_kbl1);
					$pecah_kbl2			=		explode("-",$gbg_kbl1);
					$gbg_kbl2				=		implode("",$pecah_kbl2);

					if($kembali==0)
					{
						$ket_transaksi	=		'';
						$status_transaksi	=		1;
					}
					elseif($kembali<0)
					{
						$ket_transaksi	=		'Pembayaran Kurang '.$gbg_kbl2;
						$status_transaksi	=		0;
					}
					else
					{
						$ket_transaksi	=		'Uang kembalian '.$gbg_kbl2;
						$status_transaksi	=		1;
					}

					if($bayar==0)
					{
						echo $bayar;
					}
					else
					{
						$q = "insert into tbl_penjualan_header(kd_transaksi,kd_pelanggan,total,bayar,status,ket_transaksi)
									values('".$kode_trans."','".$kd_pelanggan."','".$total."','".$bayar."','".$status_transaksi."','".$ket_transaksi."')";
						$this->Penjualan->simpan_penjualan($q);
						foreach($this->cart->contents() as $items)
						{
							$this->Penjualan->simpan_penjualan("insert into tbl_penjualan_detail (kd_transaksi,kd_brg,nm_brg,harga,jumlah,status) values('".$kode_trans."','".$items['id']."','".$items['name']."','".$items['price']."','".$items['qty']."','".$status_transaksi."')");
							//echo "<script type='text/javascript' language='Javascript'>window.open('http://google.com');</sc‌​ript>";
							//echo '<script> window.open("'.base_url().'transaksi/nota_penjualan/cetak_penjualan/") </script>';
						}
						//echo $bayar;
						//echo "window.open('".base_url()."transaksi/nota_penjualan/cetak_penjualan/'$(".'#kd_transaksi'.").val())";
						//echo "<meta http-equiv='refresh' content='0; url='".base_url()."Transaksi/Nota_penjualan/'>";
						//echo "<a href='".base_url()."transaksi/nota_penjualan/cetak_penjualan' target='_blank' ></a>";
						echo json_encode($d);
						$this->cart->destroy();
					}
	}

	function cetak_penjualan()
	{
		$data['kode']='';
		if ($this->uri->segment(4) === FALSE)
		{
			$d['kode']='';
		}
		else
		{
			$d['kode'] = $this->uri->segment(4);
		}
		$d['detail'] = $this->Penjualan->gcetak_penjualan($d['kode']);
		if(count($d['detail']->result())>0)
		{
			$d = array(
						'judul' => 'Master',
						'sub_judul' => 'Transaksi - Nota Penjualan',
						'judul_box' => 'Transaksi - Nota Penjualan',
						'class' => "buat_nota",
						'dt_trans' => $this->Penjualan->gcetak_penjualan($d['kode']),
						'setting' => $this->Home->get_setting(),
						'barang' => $this->Penjualan->get(),
						'kd_tr' => $d['kode'],
						'kode_trans'=>$this->input->post('hid_kd_transaksi'),
					);
	        $this->load->view('transaksi/nota_penjualan/cetak_nota/v_cetak',$d);
		}
		else {
			echo 'Tidak Ada Data';
		}
	}

	function barcode_cetak_penjualan($kode)
	{
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code39', 'image', array('text'=>$kode), array());
	}

}
