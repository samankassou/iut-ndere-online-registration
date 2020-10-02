<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('assets_helper');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['title'] = 'Accueil';
		$this->load->view('front_end/index', $data);
	}
}
