<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Login_model', 'Login');
		$this->load->helper('form');
		$this->load->helper('assets_helper');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|valid_email');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|min_length[5]');

		if ($this->form_validation->run()) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			if ($this->Login->can_login($email, $password)) {
				$admin = $this->Login->get_admin(array('email_admin' => $email));
				$info_admin = array(
					'email_admin' => $admin->email_admin,
					'nom_admin'   => $admin->nom_admin
				);
				$this->session->set_userdata($info_admin);
				redirect('Admin');
			}else{
				$data['msg'] = 'Login ou mot de passe incorrect!<br>';
				$this->load->view('admin/admin_login_view', $data);
			}
			
		} else {
			$this->load->view('admin/admin_login_view');
		}
		
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('Login');
	}
}
