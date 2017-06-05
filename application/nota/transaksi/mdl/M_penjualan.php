<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_Model
{
	private $primary_key = 'kd_brg';
	private $table_name	= 'tbl_brg';
	private $tbl_penjualan_header  = 'tbl_penjualan_header';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get()
	{
		$this->db->select('kd_brg,nm_brg');
		return $this->db->get($this->table_name)->result();
	}

	function get_by_id($id)
	{
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name)->row();
	}
	function create_kd_penjualan()
	{
		$q2 = $this->db->query("SELECT max(right(kd_transaksi,2)) as nkode FROM $this->tbl_penjualan_header");
		$kode_brg='';
		$row = $q2->num_rows();
			if($row>0){
				foreach($q2->result() as $dt){
					$no_akhir = ((int) $dt->nkode)+1;
					//$kode_brg= "BL".str_pad($no_akhir, 4, "0", STR_PAD_LEFT);
					$kode_brg = sprintf("%04s", $no_akhir);
				}
			}else{
				$kode_brg = '0001';
			}
			return 'TP'.$kode_brg;
	}
	function save_penjualan($data)
	{
		$this->db->insert($this->tbl_penjualan_header, $data);
		return $this->db->insert_id();
	}
	function simpan_penjualan($datainput)
	{
		$q = $this->db->query($datainput);
	}
	function gcetak_penjualan($id)
	{
		$q = $this->db->query("SELECT * from tbl_penjualan_detail as a
			  										left join tbl_penjualan_header as b
															on a.kd_transaksi=b.kd_transaksi
																where a.kd_transaksi='$id' and b.kd_transaksi='$id'
																order by a.kd_brg asc");
		return $q;
	}
}
