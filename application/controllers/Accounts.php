<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('Accounts_model2', 'Accounts');
		$this->load->library('form_validation');
		$this->load->helper('general_helper');
		$this->load->helper('assets_helper');


		if (empty($this->session->email)){
			redirect('login/index');
		}
	}

	public function index()
	{
		$data['title'] = 'Comptes';
		$data['js'] = base_url().'assets/js/user.js';
		$this->load->view('admin/header', $data, FALSE);
		$this->load->view('admin/accounts_view', $data, FALSE);
		$this->load->view('admin/footer', $data, FALSE);
	}

	public function ajax_list()
	{
		$list = $this->Accounts->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $user->firstname;
			$row[] = $user->lastname;
			$row[] = $user->email;
			$row[] = ($user->statut == 1)?'Actif':'Inactif';
			$row[] = $user->role;
			if($user->photo)
				$row[] = '<a href="'.base_url('assets/img/profiles/'.$user->photo).'" target="_blank"><img width="50" height="50" src="'.base_url('assets/img/profiles/'.$user->photo).'" class="img-responsive" /></a>';
			else
				$row[] = '(Pas de photo)';
			if ($this->Accounts->get_by_id($user->create_by))
			{
				$row[] = $this->Accounts->get_by_id($user->create_by)->firstname." ".$this->Accounts->get_by_id($user->create_by)->lastname;
			}
			else
			{
				$row[] = 'inconnu';
			}
			

			//add html for action
			if ($user->statut == 1)
			{
				
			$row[] = '<a class="btn btn-warning" href="javascript:void(0)" title="Désactiver" onclick="unset_user('."'".$user->id_user."'".')"><i class="fa fa-times"></i></a>';
			}
			else
			{

			$row[] = '<a class="btn btn-warning" href="javascript:void(0)" title="Activer" onclick="unset_user('."'".$user->id_user."'".')"><i class="fa fa-check"></i></a>';
			}
			$row[] = '<a class="btn  btn-primary" href="javascript:void(0)" title="Modifier" onclick="edit_user('."'".$user->id_user."'".')"><i class="fa fa-edit"></i></a>';
			$row[] = '<a class="btn  btn-danger" href="javascript:void(0)" title="Supprimer" onclick="delete_user('."'".$user->id_user."'".')"><i class="fa fa-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Accounts->count_all(),
			"recordsFiltered" => $this->Accounts->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->Accounts->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();

		$firstname = ucfirst(strtolower($this->input->post('firstname')));
		$lastname = ucfirst(strtolower($this->input->post('lastname')));
		$email = mb_strtolower($this->input->post('email'));
		$password = sha1($this->input->post('password'));
		$data = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email'	=> $email,
			'password'	=> $password,
			'role'	=> $this->input->post('role'),
			'create_by' => $this->session->userdata('id_user')
		);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->Accounts->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		
		$firstname = ucfirst(strtolower($this->input->post('firstname')));
		$lastname = ucfirst(strtolower($this->input->post('lastname')));
		$email = mb_strtolower($this->input->post('email'));
		if ($this->input->post('change_psw') == 'yes') {
			$password = sha1($this->input->post('password'));
		}
		$data = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email'	=> $email,
			'role'	=> $this->input->post('role')
		);

		if ($this->input->post('change_psw') == 'yes') {
			$data['password']	= $password;
		}


		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('assets/img/profiles/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('assets/img/profiles/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$user = $this->Accounts->get_by_id($this->input->post('id'));
			if(file_exists('assets/img/profiles/'.$user->photo) && $user->photo)
				unlink('assets/img/profiles/'.$user->photo);

			$data['photo'] = $upload;
		}

		$this->Accounts->update(array('id_user' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$user = $this->Accounts->get_by_id($id);
		if(file_exists('assets/img/profiles/'.$user->photo) && $user->photo)
			unlink('assets/img/profiles/'.$user->photo);
		
		$this->Accounts->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_unset($id){
		$this->Accounts->unset_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['upload_path']          = 'assets/img/profiles/';
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {

        	$data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			
			echo json_encode($data);
			exit();
		}
		$file_data = $this->upload->data();
		$config['image_library']		= 'gd2';
		$config['source_image']			= 'assets/img/profiles/'.$file_data['file_name'];
		$config['create_thumb']			= FALSE;
		$config['maintain_ratio']		= FALSE;
		$config['quality']				= '90%';	
		$config['width']          		= 400;
		$config['height']          		= 500;
		$config['new_image']          	= 'assets/img/profiles/'.$file_data['file_name'];
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		return $this->upload->data('file_name');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('firstname') == '')
		{
			$data['inputerror'][] = 'firstname';
			$data['error_string'][] = 'Le champ Nom est requis';
			$data['status'] = FALSE;
		}

		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Le champ Email est requis';
			$data['status'] = FALSE;
		}elseif(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL) === false){
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Veuillez entrer une adresse email vailde';
			$data['status'] = FALSE;
		}else
		{
			if ($this->uri->segment(2) == 'ajax_add') {
				$user = $this->Accounts->get_by_email($this->input->post('email'));

				if ($user != NULL)
				{
					$data['inputerror'][] = 'email';
					$data['error_string'][] = 'L\'adresse email n\'est pas disponible';
					$data['status'] = FALSE;
				}
			}
		}
		

		if ($this->input->post('change_psw') == 'yes') {

			if($this->input->post('password') == '')
			{
				$data['inputerror'][] = 'password';
				$data['error_string'][] = 'Le champ Mot de passe est requis';
				$data['status'] = FALSE;
			}

			if($this->input->post('password') != $this->input->post('password_conf')){
				$data['inputerror'][] = 'password';
				$data['error_string'][] = 'Les mots de passe ne correspondent pas';
				$data['inputerror'][] = 'password_conf';
				$data['error_string'][] = 'Les mots de passe ne correspondent pas';
				$data['status'] = FALSE;
			}
		}

		if($this->input->post('role') == '')
		{
			$data['inputerror'][] = 'role';
			$data['error_string'][] = 'Veuillez sélectionner';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}