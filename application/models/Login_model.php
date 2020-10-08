<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function can_login($email, $password){
		$verif = $this->db->where('email_admin', $email)->get('admin')->num_rows();
		if ($verif) {
			$hash = $this->db->where('email_admin', $email)->get('admin')->first_row()->mot_de_pass;
			if (password_verify($password, $hash)) {
				return true;
			}
		}
		return false;
	}

	public function get_admin($conditions = array()){
		$this->db->where($conditions);
		return $this->db->get('admin')->first_row();
	}
}