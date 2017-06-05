<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_service extends CI_Model
{
	private $primary_key = 'kd_brg';
	private $table_name	= 'tbl_brg';
	private $tbl_service	= 'tbl_service';
	private $tbl_perbaikan_detail	= 'tbl_service_detail';
	private $tbl_perbaikan_header  = 'tbl_service_header';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get()
	{
		$this->db->select('kd_service,nm_service');
		return $this->db->get($this->tbl_service)->result();
	}

	function get_by_id($id)
	{
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->$tbl_service)->row();
	}
	function create_kd_service()
	{
		$q2 = $this->db->query("SELECT max(right(kd_trans_service,2)) as nkode FROM $this->tbl_perbaikan_header where (SELECT max(left(kd_trans_service,2)) as nkode FROM $this->tbl_perbaikan_header)<>'SV' ");
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
			return 'SC'.$kode_brg;
	}
	function save_transaksi($data)
	{
		$this->db->insert($this->tbl_perbaikan_header, $data);
		return $this->db->insert_id();
	}
	function simpan_transaksi($datainput)
	{
		$q = $this->db->query($datainput);
	}
	function gcetak_perbaikan($id)
	{
		$q = $this->db->query("SELECT * from  where a.id_file='$id'");
		return $q;
	}
}
