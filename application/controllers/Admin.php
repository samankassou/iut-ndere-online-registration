<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('Admin_model', 'Admin');
		$this->load->helper('menu_helper');
		$this->load->library('form_validation');
		$this->load->helper('general_helper');
		$this->load->helper('assets_helper');

		if (empty($this->session->email)){
			redirect('login/index');
		}
	}

	public function index()
	{
		$data['total_folders'] = $this->Admin->count_folders();
		$data['valid_folders'] = $this->Admin->count_folders(array('statut' => 'valide'));
		$data['invalid_folders'] = $this->Admin->count_folders(array('statut' => 'en_attente'));
		$data['title'] = 'Admin';
		$data['js'] = base_url().'assets/js/admin.js';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('admin/footer', $data);
	}

	public function liste_candidats($statut){
		$data['liste_candidats'] = $this->Admin->liste_candidats($statut);
		$data['lieux'] = $this->Admin->lieu_depot();
		$data['pays'] = $this->Admin->Pays_Origine();
		$data['reg_or'] = $this->Admin->reg_or();
		//$data['centre'] = $this->Admin->centre_exam();
		$data['mention'] = $this->Admin->mention();
		$data['parcour'] = $this->Admin->parcours();
		$data['cycle'] = $this->Admin->cycle();		//$data['liste_candidat'] = 
		$data['title'] = 'Listes des candidats';
		$data['js'] = base_url().'assets/js/admin.js';

		$this->load->view('admin/header', $data);
		$this->load->view('admin/candidates_list_view', $data);
		$this->load->view('admin/footer', $data);
		
	}

	public function multiple_validation(){
		if ($this->input->post('checkbox_value')) {
			$id_candidat = $this->input->post('checkbox_value');

			for($count = 0; $count < count($id_candidat); $count++)
			{
				$this->Admin->valid_candidat($id_candidat[$count]);
			}
		}
	}
	public function multiple_invalidation(){
		if ($this->input->post('checkbox_value')) {
			$id_candidat = $this->input->post('checkbox_value');

			for($count = 0; $count < count($id_candidat); $count++)
			{
				$this->Admin->invalid_candidat($id_candidat[$count]);
			}
		}
	}

	public function fetch_parcours()
	{
		//ar_dump($this->input->post()); die;
		/*$id=$this->input->post('id_mention');
		$id_cy=$this->input->post('id_mention');
		echo $this->Admin->fetch_parcours($id);*/
		
		if($this->input->post('id_mention') && $this->input->post('id_cycle'))
		{
			echo $this->Admin->fetch_parcour($this->input->post('id_mention'),$this->input->post('id_cycle'));
		}
		
		//echo "pppp";
	}

	public function fetch_region()
	{
		if($this->input->post('id_pays'))
		{
			echo $this->Admin->fetch_region($this->input->post('id_pays'));
		}
	}

	public function fetch_cycle()
	{
		if($this->input->post('id_parcours'))
		{
			echo $this->Admin->fetch_cycle($this->input->post('id_parcours'));
		}
	}
	public function fetch_centre()
	{
		$output="<option value='' disabled selected>Choisissez un centre</option>";
		if($this->input->post('id_cycle'))
		{
			$result= $this->Admin->fetch_centre($this->input->post('id_cycle'));

			foreach ($result as  $value) 
			{
				$output.='<option value="'.$value->id_centre_examen.'">'.$value->nom_centre_examen.'</option>';
			}
			echo $output;
		}
	}

	public function filtre_candidat()
	{
		/*if($this->input->post('sexe') && $this->input->post('pays') && $this->input->post('region') && $this->input->post('langue') && $this->input->post('lieu_depot') && $this->input->post('centre_examen') && $this->input->post('mention') && $this->input->post('parcours')   && $this->input->post('cycle'))
		{*/
			//var_dump($_POST); die;
			$data=[];
			$data['sexe']=$this->input->post('sexe');
			$data['pays']=$this->input->post('pays');
			$data['region']=$this->input->post('region');
			$data['langue']=$this->input->post('langue');
			$data['lieu_depot']=$this->input->post('lieu_depot');
			$data['centre_examen']=$this->input->post('centre_examen');
			$data['mnt']=$this->input->post('mention');
			$data['parcours']=$this->input->post('parcours');
			$data['cyc']=$this->input->post('cycle');

			//var_dump($data); die;

			echo $this->Admin->filtre_candidat($data, 'valide');
		//}
		}


		public function ajout()

		{
			$this->form_validation->set_rules('n_mention','n_mention','trim');
			$this->form_validation->set_rules('s_mention','s_mention','trim');
			$this->form_validation->set_rules('cycle','cycle','trim');
			//if($this->form_validation->run())
			
		}



	}
