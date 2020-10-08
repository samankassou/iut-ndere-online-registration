<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generation extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Pdf');
		$this->load->helper('date');
		$this->load->helper('moment_helper');
		$this->load->library('ciqrcode');
		$this->load->helper('url');
		$this->load->helper('assets_helper');
		$this->load->model('Candidates_model', 'Candidats');
		$this->load->model('Admin_model', 'Admin');
		$this->load->helper('general_helper');
	}

	public function index(){
		$data['candidats'] = $this->Candidats->get_all_candidates();
		$data['title'] = 'Listes des candidats';
		$this->load->view('candidates_list_view', $data);
		
	}

	public function generer_Liste_Candidat($statut)
	{
		//var_dump($_POST); die();
		$data = [];
		$data['sexe'] = $this->input->post('sexe');
		$data['pays'] = $this->input->post('pays');
		$data['region'] = $this->input->post('region');
		$data['langue'] = $this->input->post('langue');
		$data['lieu_depot'] = $this->input->post('lieu_depot');
		$data['centre_examen'] = $this->input->post('centre_examen');
		$data['mnt'] = $this->input->post('mention');
		$data['parcours'] = $this->input->post('parcours');
		$data['cyc'] =$this->input->post('cycle');

				

		$data['listes'] = $this->Admin->filtre_candidat($data, $statut, FALSE);

		$this->pdf->Options->setIsRemoteEnabled(true);
		$this->pdf->setPaper('A4', 'portrait')
			->filename('')
			->zone('')
			->load_view('fiche_candidats', $data)
			->generate();
	}

	public function generer($id_candidat){
		$this->session->set_flashdata('id_candidat', $id_candidat);
		//$this->generer_fiche_candidat();
		redirect('generation/generer_fiche_candidat');
	}

	public function generer_fiche_candidat()
	{
		$id = $this->session->flashdata('id_candidat');
		if ($id) {
			$data['infos_perso_candidat'] = $this->Candidats->get_infos_perso_candidat($id);
			$data['origine_candidat'] = $this->Candidats->get_origine_candidat($id);
			$data['infos_diplome_candidat'] = $this->Candidats->get_diplome_candidat($id);
			$data['cursus_candidat'] = $this->Candidats->get_cursus_candidat($id);
			$data['mention_candidat'] = $this->Candidats->get_mention_candidat($id);
			$data['parcour_candidat'] = $this->Candidats->get_parcour_candidat($id);
			$data['parcours_choisis'] = $this->Candidats->get_parcours_choisis_candidat($id);
			$params['data'] = 'http://iut.univ-ndere.cm';
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = FCPATH.'assets/img/qrcode/qrcode.png';
			$this->ciqrcode->generate($params);

			$cycle_candidat = $this->Candidats->get_candidate_cycle($id);
			$parcour_candidat = $this->Candidats->get_parcour_candidat($id)->abreviation_parcour;
			$nom_fiche = '( CYCLE '.$cycle_candidat.')';
			$nom_fiche .= '_FICHE_CANDIDATURE_';
			$nom_fiche .= $this->Candidats->get_infos_perso_candidat($id)->nom_candidat;
			$nom_fiche .= '_(N° '.castNumberId($id, 5).')';

			if ($cycle_candidat === 'DUT') {
				
				if ($parcour_candidat === 'GIN') {
					$this->pdf->Options->setIsRemoteEnabled(true);
					$this->pdf->setPaper('A4', 'portrait')
					->filename($nom_fiche)
					->zone('')
					->load_view('fiche_dut_gin', $data)
					->generate();
				}elseif (($parcour_candidat === 'IAB') || ($parcour_candidat === 'ABB') || ($parcour_candidat === 'GEN')) {
					$this->pdf->Options->setIsRemoteEnabled(true);
					$this->pdf->setPaper('A4', 'portrait')
					->filename($nom_fiche)
					->zone('')
					->load_view('fiche_dut_gbio', $data)
					->generate();
				}elseif (($parcour_candidat === 'GMP') || ($parcour_candidat === 'MIP') || ($parcour_candidat === 'GEL') || ($parcour_candidat === 'GTE')) {
					$this->pdf->Options->setIsRemoteEnabled(true);
					$this->pdf->setPaper('A4', 'portrait')
					->filename($nom_fiche)
					->zone('')
					->load_view('fiche_dut_gim', $data)
					->generate();
				}elseif ($parcour_candidat === 'GCD') {
					$this->pdf->Options->setIsRemoteEnabled(true);
					$this->pdf->setPaper('A4', 'portrait')
					->filename($nom_fiche)
					->zone('')
					->load_view('fiche_dut_gcd', $data)
					->generate();
				}elseif($parcour_candidat == 'MEB'){
					$this->pdf->Options->setIsRemoteEnabled(true);
					$this->pdf->setPaper('A4', 'portrait')
					->filename($nom_fiche)
					->zone('')
					->load_view('fiche_dut_meb', $data)
					->generate();
				}else{
					show_404();
				}
				
			}elseif ($cycle_candidat === 'BTS') {
				$this->pdf->Options->setIsRemoteEnabled(true);
				$this->pdf->setPaper('A4', 'portrait')
				->filename($nom_fiche)
				->zone('')
				->load_view('fiche_bts', $data)
				->generate();
			}elseif($cycle_candidat === 'LITECH'){

				$parcour_candidat = $this->Candidats->get_parcour_candidat($id)->abreviation_parcour;
				$data['emploi_candidat'] = $this->Candidats->get_emploi_candidat($id);
				
				$this->pdf->Options->setIsRemoteEnabled(true);
				$this->pdf->setPaper('A4', 'portrait')
				->filename($nom_fiche)
				->zone('')
				->load_view('fiche_litech', $data)
				->generate();
				
			}
		}else{
			show_404();
		}
	}
}
