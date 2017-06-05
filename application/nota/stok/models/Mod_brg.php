<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Mod_brg extends CI_Model {
		var $column = array('kd_brg','nm_brg','harga','stok_brg');
		var $order = array('kd_brg' => 'asc');
		var $table  = 'tbl_brg';

		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		/* Query Data */
		private function dtBarang()
		{
			$this->db->from('tbl_brg');
			
			$this->db->join('tbl_satuan', 'tbl_brg.kd_satuan=tbl_satuan.kd_satuan','left');
			$this->db->where('tbl_brg.kd_satuan=tbl_satuan.kd_satuan');		
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
		function get_dtBarang()
		{
			$this->dtBarang();
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}
		/* Hitung Data yang di Filter */
		function hitung_filter()
		{
			$this->dtBarang();
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		/* HITUNG TOTAL DATA  */
		public function hitung_data()
		{
			$this->db->from('tbl_brg');			
			return $this->db->count_all_results();
		}

		function cari_dt_satuan()
		{
			$q = $this->db->order_by('kd_satuan');
			$q = $this->db->get('tbl_satuan');
			return $q;
		}
		function get_by_kode($kd_brg)
		{
			$this->db->from($this->table);
			$this->db->where('kd_brg',$kd_brg);
			$query = $this->db->get();

			return $query->row();
		}

		function delete_by_kode($kd_brg)
		{
			$this->db->where('kd_brg', $kd_brg);
			$this->db->delete($this->table);
		}
		function create_kd_brg()
		{
			$q2 = $this->db->query("SELECT max(right(kd_brg,2)) as nkode FROM tbl_brg");
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
				return 'BL'.$kode_brg;
		}
		function save($data)
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}

		function update($where, $data)
		{
			$this->db->update($this->table, $data, $where);
			return $this->db->affected_rows();
		}
	}