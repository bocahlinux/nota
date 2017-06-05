<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Mod_service extends CI_Model {
		var $column = array('kd_service','nm_service','harga_service');
		var $order = array('kd_service' => 'asc');
		var $table  = 'tbl_service';

		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		/* Query Data */
		private function dtService()
		{
			$this->db->from('tbl_service');
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
		function get_dtService()
		{
			$this->dtService();
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}
		/* Hitung Data yang di Filter */
		function hitung_filter()
		{
			$this->dtService();
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		/* HITUNG TOTAL DATA  */
		public function hitung_data()
		{
			$this->db->from('tbl_service');
			return $this->db->count_all_results();
		}

		function cari_dt_service()
		{
			$q = $this->db->order_by('kd_service');
			$q = $this->db->get('tbl_service');
			return $q;
		}

		function get_by_kode($kd_service)
		{
			$this->db->from($this->table);
			$this->db->where('kd_service',$kd_service);
			$query = $this->db->get();

			return $query->row();
		}

		 function delete_kode_service($kd_service)
		{
			$this->db->where('kd_service', $kd_service);
			$this->db->delete($this->table);
		}

		function create_kd_srv()
		{
				$q2 = $this->db->query("SELECT max(right(kd_service,3)) as jum_kd FROM tbl_service");
				$kode_srv='';
				$row = $q2->num_rows();
				if($row>0){
					foreach($q2->result() as $dt){
						$no_srv = ((int) $dt->jum_kd)+1;
						//$kode_srv = "ST".str_pad($no_srv, 3, "0", STR_PAD_LEFT);
						$kode_srv = sprintf("%03s", $no_srv);
					}
				}else{
					$kode_srv = "001";
				}
				return 'SC'.$kode_srv;			
		}

		function save_service($data)
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}

		function update_service($where, $data)
		{
			$this->db->update($this->table, $data, $where);
			return $this->db->affected_rows();
		}
	}