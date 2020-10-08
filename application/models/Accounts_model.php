<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model {
	
	public function get_accounts(){
		return $this->db->get('admin')->result();
	}

	public function add_account($account){
		$this->db->insert('admin', $account);
	}

	public function delete_admin($id){
		$this->db->where('id_admin', $id);
		$this->db->delete('admin');
	}

}