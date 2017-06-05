<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Mod_satuan extends CI_Model {
		var $column = array('kd_satuan','ket_satuan');
		var $order = array('kd_satuan' => 'asc');
		var $table  = 'tbl_satuan';

		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		/* Query Data */
		private function dtSatuan()
		{
			$this->db->from('tbl_satuan');
			$i = 0;
			foreach ($this->column as $item)
			{
				if($_POST['search']['value'])
				{
					if($i===0)
					{
						$this->db->group_start();
						$this->db->like($item, $_POST['search']['value']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']['value']);
					}
					if(count($this->column) - 1 == $i)
						$this->db->group_end();
				}
				$column[$i] = $item;
				$i++;
			}
			if(isset($_POST['order']))
			{
				$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}
		/* Get Data */
		function get_dtSatuan()
		{
			$this->dtSatuan();
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}
		/* Hitung Data yang di Filter */
		function hitung_filter()
		{
			$this->dtSatuan();
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		/* HITUNG TOTAL DATA  */
		public function hitung_data()
		{
			$this->db->from('tbl_satuan');
			return $this->db->count_all_results();
		}

		function cari_dt_satuan()
		{
			$q = $this->db->order_by('kd_satuan');
			$q = $this->db->get('tbl_satuan');
			return $q;
		}

		function get_by_kode($kd_satuan)
		{
			$this->db->from($this->table);
			$this->db->where('kd_satuan',$kd_satuan);
			$query = $this->db->get();

			return $query->row();
		}

		 function delete_by_kode($kd_satuan)
		{
			$this->db->where('kd_satuan', $kd_satuan);
			$this->db->delete($this->table);
		}

		function create_kd_sat()
		{
				$q2 = $this->db->query("SELECT max(right(kd_satuan,3)) as jum_kd FROM tbl_satuan");
				$kode_sat='';
				$row = $q2->num_rows();
				if($row>0){
					foreach($q2->result() as $dt){
						$no_sat = ((int) $dt->jum_kd)+1;
						//$kode_sat = "ST".str_pad($no_sat, 3, "0", STR_PAD_LEFT);
						$kode_sat = sprintf("%03s", $no_sat);
					}
				}else{
					$kode_sat = "001";
				}
				return 'ST'.$kode_sat;			
		}

		function save_satuan($data)
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}

		function update_satuan($where, $data)
		{
			$this->db->update($this->table, $data, $where);
			return $this->db->affected_rows();
		}
	}