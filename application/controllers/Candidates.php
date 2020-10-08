<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidates extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('Candidates_list_model', 'Admin');
		$this->load->helper('general_helper');
		$this->load->helper('assets_helper');


		if (empty($this->session->email)){
			redirect('login/index');
		}
	}

	public function index()
	{

		$data['lieux'] = $this->Admin->lieu_depot();
		$data['pays'] = $this->Admin->Pays_Origine();
		$data['reg_or'] = $this->Admin->reg_or();
		//$data['centre'] = $this->Admin->centre_exam();
		$data['mention'] = $this->Admin->mention();
		$data['parcour'] = $this->Admin->parcours();
		$data['cycle'] = $this->Admin->cycle();		//$data['liste_candidat'] = 
		$data['title'] = 'Listes des candidats';

		$data['js'] = base_url().'assets/js/candidates_list.js';
		$this->load->view('admin/header', $data, FALSE);
		$this->load->view('admin/candidates_list', $data, FALSE);
		$this->load->view('admin/footer', $data, FALSE);
	}

	public function ajax_list()
	{
		$list = $this->Admin->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $candidat) {
			$no++;
			$row = array();
			$row[] = $no;
			if($this->input->post('statut') === 'en_attente'):
				$row[] = 	'<div class="form-check" style="width: 100%; height: 100%;">
                      			<input class="form-check-input valid_checkbox" type="checkbox" value='.$candidat->id_candidat.'>
                			</div>';
			else:
				$row[] =	'<div class="form-check">
                        		<input class="form-check-input invalid_checkbox" type="checkbox" value='.$candidat->id_candidat.'>
                     		 </div>';
            endif;
			$row[] = 'N° Transaction: <b>'.$candidat->num_transaction.'</b><br>'.$candidat->nom_banque;
			$row[] = $candidat->nom_candidat;
			$row[] = $candidat->prenom_candidat;
			$row[] = ($candidat->sexe === 'm')?'M':'F';
			$row[] = nice_date($candidat->date_naiss, 'd-m-Y');
			$row[] = $candidat->sigle_mention;
			$row[] = $candidat->nom_centre_examen;
			$row[] = $candidat->nom_lieu_depot;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Admin->count_all(),
			"recordsFiltered" => $this->Admin->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
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


	public function ajax_get_region()
	{
	
		$regions = $this->Admin->fetch_region($this->input->post('id_pays'));
		echo json_encode($regions);
	
	}

	public function ajax_get_mentions()
	{
	
		$mentions = $this->Admin->fetch_mentions($this->input->post('id_cycle'));
		echo json_encode($mentions);
	
	}

	public function ajax_get_parcours()
	{
	
		$mentions = $this->Admin->ajax_fetch_parcours($this->input->post('id_cycle'), $this->input->post('id_mention'));
		echo json_encode($mentions);
	
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
}