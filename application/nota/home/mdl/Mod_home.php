<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Mod_home extends CI_Model 
	{
		var $table  = 'tbl_setting';

		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		/* Query Data Setting Aplikasi*/
		function get_setting()
		{
			$this->db->from($this->table);
			$this->db->where('id','1');
			$query = $this->db->get();
			return $query->row();
		}
	}