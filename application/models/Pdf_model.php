<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_model extends CI_Model {

	public function get_candidats(){
		return $this->db->get('candidat')->result();
	}
}