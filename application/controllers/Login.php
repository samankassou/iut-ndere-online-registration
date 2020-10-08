<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Accounts_model2', 'Accounts');
		$this->load->helper('url');
		$this->load->model('Login_model', 'Login');
		$this->load->helper('form');
		$this->load->helper('assets_helper');
		$this->load->library('form_validation');

	}

	public function index(){
		$data['title'] = 'Login';
		$this->load->view('admin/admin_login_view', $data);
	}

	public function login_validation(){
		$data['title'] = 'Login';
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required');

		if ($this->form_validation->run())
		{
			$email = $this->input->post('email');
			$password = sha1($this->input->post('password'));

			if ($this->Accounts->can_login($email, $password))
			{
				$user = $this->Accounts->get_by_email_and_password($email, $password);
				if ($user['statut'] == '1')
				{
					$this->session->set_userdata($user);
					redirect(site_url('admin/index'));
				}
				else
				{
					$data['error'] = '<span class="text-light">Votre compte est désactivé</span>';
					$this->load->view('admin/admin_login_view', $data);
				}
				
			}
			else
			{
				$data['error'] = '<span class="text-light">Email ou mot de passe incorrect</span>';
				$this->load->view('admin/admin_login_view', $data);
			}
		}
		else
		{
			$this->index();
		}

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url('login/index'));
	}



}