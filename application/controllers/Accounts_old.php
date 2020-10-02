<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_old extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('Accounts_model', 'Accounts');
		$this->load->library('form_validation');
		$this->load->helper('general_helper');
		$this->load->helper('assets_helper');


		if (empty($this->session->email)){
			redirect('login/index');
		}
	}

	public function index(){
		$data['title'] = 'Comptes';
		$data['js'] = base_url().'assets/js/admin.js';
		$data['comptes'] = $this->Accounts->get_accounts();
		$this->load->view('admin/header', $data, FALSE);
		$this->load->view('admin/accounts_view', $data, FALSE);
		$this->load->view('admin/footer', $data, FALSE);
	}

	public function add_admin(){
		$this->form_validation->set_rules('name', 'Nom', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[admin.email_admin]');
		$this->form_validation->set_rules('psw', 'Mot de passe', 'required|min_length[5]');
		$this->form_validation->set_rules('psw_conf', 'Confirmation', 'matches[psw]');
		if ($this->form_validation->run()) {
			$account = array(
				'nom_admin' => mb_strtoupper($this->input->post('name')),
				'email_admin' => mb_strtolower($this->input->post('email')),
				'mot_de_pass' => password_hash($this->input->post('psw'), PASSWORD_DEFAULT)
			);
			$this->Accounts->add_account($account);
			echo "1";
		} else {
			echo json_encode($this->form_validation->error_array());
		}
	}

	public function ajax_get_admin(){
		$id_admin = $this->input->post('id');
		$admin = $this->Accounts->get_admin(array('id_admin' => $id_admin));
		
		echo json_encode($admin);
	}

	public function delete_admin(){
		$id = $this->input->post('id');
		$this->Accounts->delete_admin($id);
		echo "1";
	}
}