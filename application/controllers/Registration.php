<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller 

{

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->helper('url');
        $this->load->model('Registration_model', 'Registration');
    }

	public function index()
	{
		$data['title'] = 'Choix du concours';
		$this->load->view('common/header', $data);
		$this->load->view('front_end/candidate_choice_view', $data);
		$this->load->view('common/footer', $data);
	}

           /*Regles de Validation*/

     
           		/*Validation informations personnels*/

    public function validateInfoPerso1()
    {
    	$cycle = $this->input->post('cycle');
		$this->form_validation->set_rules('nom_candidat', 'Nom', 'trim|required|alpha_numeric_spaces|min_length[2]');
		$this->form_validation->set_rules('prenom_candidat', 'Prénom', 'trim|alpha_numeric_spaces|min_length[2]');	
		$this->form_validation->set_rules('nationalite', 'nationalité', 'required');
		$this->form_validation->set_rules('region_or', 'région d\'origine', 'required');
		$this->form_validation->set_rules('sexe', 'sexe', 'trim|required');
		
		if ($cycle == 'LITECH')
			{
				$this->form_validation->set_rules('nom_mere', 'nom de la mère', 'trim|required|alpha_numeric_spaces|min_length[2]');
				$this->form_validation->set_rules('nom_pere', 'nom du père', 'trim|required|alpha_numeric_spaces|min_length[2]');	
			}
		if ($this->form_validation->run())
			echo "1";
		else
			echo json_encode($this->form_validation->error_array());
    }
                 /* Validation des diplomes et Formations*/

	public function validateInfoPerso2()
	{
		if (!empty($_POST))
		{	
			$cycle = $this->input->post('cycle');
			$this->form_validation->set_rules('date_naiss', 'date de naissance', 'trim|required');
			$this->form_validation->set_rules('lieu_naiss', 'lieu de naissance', 'trim|required');	
			$this->form_validation->set_rules('phone', 'téléphone', 'trim|required|is_natural|min_length[9]|is_unique[candidat.telephone]',array ( 'is_natural'  =>  'Entrez un numero de telephone valide' ));
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[candidat.email]');

			if ($cycle == 'LITECH')
			{
				$this->form_validation->set_rules('emploi', 'emploi', 'trim|required|alpha_numeric_spaces|min_length[2]');
				
				$statut = $this->input->post('emploi');

				if ( $statut == 'Oui')
					{
						$this->form_validation->set_rules('nom_employeur', 'Nom de l\'employeur', 'trim|required|alpha_numeric_spaces|min_length[2]');
						$this->form_validation->set_rules('poste', 'Fonction occupée', 'trim|required|alpha_numeric_spaces|min_length[2]');
					}

			}
			
			


			if ($this->form_validation->run())
				echo "1";
			else
				echo json_encode($this->form_validation->error_array());
		}
	}




	public function validateFormation()
    {
    	if (!empty($_POST))

    	{

	    	$this->form_validation->set_rules('diplome', 'diplôme d\'admission', 'required');
	        $this->form_validation->set_rules('annee_obt', 'année d\'obtention', 'required');
	        $this->form_validation->set_rules('pays_obt', 'pays d\'obtention', 'trim|required');
	        $this->form_validation->set_rules('centre_obtention', 'centre d\'obtention', 'required');
	    	$this->form_validation->set_rules('mention', 'mention', 'trim|required');
	    	
	    	if($this->input->post('mention') != "")
	   			 {
		    		
		    		$id_mention = $this->input->post('mention');
		    		$cycle = $this->input->post('cycle');
		    		$mention = $this->db->where('id_mention', $id_mention)->get('mention')->first_row()->sigle_mention;
		    		
		    		if($cycle == 'DUT')
		    			{

					    	if ($mention == 'GBIO') 
							{
								$this->form_validation->set_rules('parcours1', 'parcours1', 'required');
					       		$this->form_validation->set_rules('parcours2', 'parcours2', 'required');
					       		$this->form_validation->set_rules('parcours3', 'parcours3', 'required');

							}

							elseif ($mention == 'GIM')
							 {
								$this->form_validation->set_rules('parcours1', 'parcours1', 'required');
					       		$this->form_validation->set_rules('parcours2', 'parcours2', 'required');
					       		$this->form_validation->set_rules('parcours3', 'parcours3', 'required');
					       		$this->form_validation->set_rules('parcours4', 'parcours4', 'required');
							 }

							 else
							 {
							 	$this->form_validation->set_rules('parcours1', 'parcours1', 'required');
							 }

						}
					
					if ($cycle == 'LITECH')
						{
								if ($mention != 'GCD') 
									{
										$this->form_validation->set_rules('parcours1', 'parcours1', 'required');
							       		$this->form_validation->set_rules('parcours2', 'parcours2', 'required');
									}
		    	
					 			else
								 	 {
						    			$this->form_validation->set_rules('parcours1', 'parcours1', 'required');
						    		 }
		    			}	
		    		if ($cycle == 'BTS')
			    		{
			    			$this->form_validation->set_rules('parcours1', 'parcours1', 'required');
			    		}
	        
	        	 }

	        if ($this->form_validation->run())
	            echo "1";
	        else
	            echo json_encode($this->form_validation->error_array());
    	}
    }



                  /* Validations Concours */


    public function validateConcours()
    {
        if (!empty($_POST))
        {
        	$cycle = $this->input->post('cycle');

        	if( $cycle != 'LITECH')
        		{
		            $this->form_validation->set_rules('centre_exam', 'centre d\'examen', 'required');
		            $this->form_validation->set_rules('lieu_depot', 'lieu du dépôt du dossier physique', 'required');
		            $this->form_validation->set_rules('tentative', 'nombre de tentative', 'required');
		            $this->form_validation->set_rules('admission', 'admission', 'required');

		        }

		    else
		    	{

		    		$this->form_validation->set_rules('lieu_depot', 'lieu du dépôt du dossier physique', 'required');
		    		$this->form_validation->set_rules('admission', 'admission', 'required');
		    	}

            if ($this->form_validation->run())
                echo "1";
            else
                echo json_encode($this->form_validation->error_array());
        }
    }

                   /* Validation Parcours */


                   public function validateCursus()
    {

    	if (!empty($_POST))

    	{
    		$cycle = $this->input->post('cycle');

        	if( $cycle == 'LITECH')
        		


        		{
        			$this->form_validation->set_rules('ets1', 'établissement 1', 'trim|max_length[255]|required',array ( 'required'  =>  'Entrez l\'etablissement ou vous avez obtenu votre BAC' ));
			        $this->form_validation->set_rules('ets2', 'établissement 2', 'trim|max_length[255]|required',array ( 'required'  =>  'Entrez l\'etablissement ou vous avez obtenu votre diplome universitaire' ));
			        $this->form_validation->set_rules('ets3', 'établissement 3', 'trim|max_length[255]');
			        $this->form_validation->set_rules('cls1', 'specialité BAC', 'trim|max_length[255]|required',array ( 'required'  =>  'Entrez la specialité de votre BAC' ));
			        $this->form_validation->set_rules('cls2', 'specialité BAC+2', 'trim|max_length[255]|required',array ( 'is_natural'  =>  'Entrez la specialité de votre diplome universitaire' ));
			        $this->form_validation->set_rules('cls3', 'specialité autre diplome', 'trim|max_length[255]');
			        $this->form_validation->set_rules('exm1', 'diplôme 1', 'trim|max_length[255]');
			        $this->form_validation->set_rules('exm2', 'diplôme 2', 'trim|max_length[255]');
			        $this->form_validation->set_rules('exm3', 'diplôme 3', 'trim|max_length[255]');
			        $this->form_validation->set_rules('mention1', 'mention BAC', 'trim|max_length[64]|required',array ( 'required'  =>  'Entrez la mention obtenu au BAC' ));
			        $this->form_validation->set_rules('mention2', 'mention BAC+2', 'trim|max_length[64]|required',array ( 'required'  =>  'Entrez la mention de votre diplome universitaire' ));
			        $this->form_validation->set_rules('mention3', 'mention autre diplome', 'trim|max_length[64]');
			        $this->form_validation->set_rules('annee1', 'année BAC ', 'trim|max_length[64]|required');
			        $this->form_validation->set_rules('annee2', 'anéee BAC+2', 'trim|max_length[64]|required');
			        $this->form_validation->set_rules('annee3', 'anée autre diplome', 'trim|max_length[64]');

        		}

        	else{
			        $this->form_validation->set_rules('ets1', 'établissement 1', 'trim|max_length[255]|required');
			        $this->form_validation->set_rules('ets2', 'établissement 2', 'trim|max_length[255]');
			        $this->form_validation->set_rules('ets3', 'établissement 3', 'trim|max_length[255]');
			        $this->form_validation->set_rules('ets4', 'établissement 4', 'trim|max_length[255]');
			        $this->form_validation->set_rules('ets5', 'établissement 5', 'trim|max_length[255]');
			        $this->form_validation->set_rules('cls1', 'classe 1', 'trim|max_length[255]|required');
			        $this->form_validation->set_rules('cls2', 'classe 2', 'trim|max_length[255]');
			        $this->form_validation->set_rules('cls3', 'classe 3', 'trim|max_length[255]');
			        $this->form_validation->set_rules('cls4', 'classe 4', 'trim|max_length[255]');
			        $this->form_validation->set_rules('cls5', 'classe 5', 'trim|max_length[255]');
			        $this->form_validation->set_rules('exm1', 'diplôme 1', 'trim|max_length[255]');
			        $this->form_validation->set_rules('exm2', 'diplôme 2', 'trim|max_length[255]');
			        $this->form_validation->set_rules('exm3', 'diplôme 3', 'trim|max_length[255]');
			        $this->form_validation->set_rules('exm4', 'diplôme 4', 'trim|max_length[255]');
			        $this->form_validation->set_rules('exm5', 'diplôme 5', 'trim|max_length[255]');
			        $this->form_validation->set_rules('res1', 'resultat 1', 'trim|required',array ( 'required'  =>  'Vous devez remplir au moins une année' ));
			        $this->form_validation->set_rules('res2', 'resultat 2', 'trim');
			        $this->form_validation->set_rules('res3', 'resultat 3', 'trim');
			        $this->form_validation->set_rules('res4', 'resultat 4', 'trim');
			        $this->form_validation->set_rules('res5', 'resultat 5', 'trim');
			        $this->form_validation->set_rules('mention1', 'mention 1', 'trim|max_length[64]');
			        $this->form_validation->set_rules('mention2', 'mention 2', 'trim|max_length[64]');
			        $this->form_validation->set_rules('mention3', 'mention 3', 'trim|max_length[64]');
			        $this->form_validation->set_rules('mention4', 'mention 4', 'trim|max_length[64]');
			        $this->form_validation->set_rules('mention5', 'mention 5', 'trim|max_length[64]');
			    }

	        if ($this->form_validation->run())
	            echo "1";
	        else
	            echo json_encode($this->form_validation->error_array());
    	}
    }


              /* Validation du Paiement */
              
       public function validatePaiement()
     {
        
     	if (!empty($_POST))

	        {
	        	$this->form_validation->set_rules('banque', 'banque', 'trim|required');
	        	$this->form_validation->set_rules('nom_agence', 'nom de l\'agence', 'trim|max_length[255]|required');
	        	$this->form_validation->set_rules('num_trans', 'numero de transaction', 'trim|required|max_length[50]|is_unique[paiement.num_transaction]');
	        	$this->form_validation->set_rules('num_bordereau', 'numero de bordereau', 'trim|required|max_length[50]|is_unique[paiement.num_bordereau]',array ( 'is_natural'  =>  'Entrez un numero de bordereau valide' ));
	      
	        	if ($this->form_validation->run())
	            	echo "1";
	        	else
	            	echo json_encode($this->form_validation->error_array());
    		}
    }












	/* Controlleurs pour Enregistrement des Candidats*/


    // cas du cycle DUT
	public function dut_registration()
	{
		$cycle = 'DUT';
		$data['title'] = 'Candidature Cycle DUT';
		$data['js2'] = base_url().'assets/js/dut_form.js';
		$data['banques'] = $this->Registration->get_banques();
		$data['centres_exam'] = $this->Registration->get_centres_exam();
		$data['mentions'] = $this->Registration->get_mentions($cycle);
		$data['lieux_depot'] = $this->Registration->get_lieux_depot();
		//var_dump($data['mentions']);
		//$data['diplomes'] = $this->Registration->get_diplomes($cycle);
		$data['pays'] = $this->Registration->get_pays();
		$data['styles'] = base_url('assets/css/wizard_style.css');
		$data['js'] = base_url('assets/js/form_wizard.js');
		$this->load->view('common/header', $data);
		/* ON insere dans la variable data['pays'] le retour de la methode get_pays() du model Registration*/ 
		$data['$pays']=$this->Registration->get_pays();
		/* ON envoi le resultat de toute les requetes a la vue dut_registration_view a travers la variable data*/  
		$this->load->view('front_end/dut_registration_view', $data);
		$this->load->view('common/footer', $data);
	 //   print_r($data['pays']);
	}
	
	public function bts_registration()
	{
		$cycle = 'BTS';
		$data['title'] = 'Candidature Cycle BTS';
		$data['js2'] = base_url().'assets/js/bts_form.js';
		$data['banques'] = $this->Registration->get_banques();
		$data['centres_exam'] = $this->Registration->get_centres_exam();
		$data['mentions'] = $this->Registration->get_mentions($cycle);
		$data['lieux_depot'] = $this->Registration->get_lieux_depot();
		//$data['diplomes'] = $this->Registration->get_diplome($cycle);
		$data['pays'] = $this->Registration->get_pays();
		$data['styles'] = base_url('assets/css/wizard_style.css');
		$data['js'] = base_url('assets/js/form_wizard.js');
		$this->load->view('common/header', $data);
		// ON insere dans la variable data['pays'] le retour de la methode get_pays() du model Registration
		$data['$pays']=$this->Registration->get_pays();
		// ON envoi le resultat de toute les requetes a la vue dut_registration_view a travers la variable data  
		$this->load->view('front_end/bts_registration_view', $data);
		$this->load->view('common/footer', $data);
	}

    public function litech_registration()
	{
		$cycle = 'LITECH';
		$data['title'] = 'Candidature Cycle Licence';
		$data['js2'] = base_url().'assets/js/litech_form.js';
		$data['banques'] = $this->Registration->get_banques();
		$data['mentions'] = $this->Registration->get_mentions($cycle);
		$data['lieux_depot'] = $this->Registration->get_lieux_depot();
		//$data['diplomes'] = $this->Registration->get_diplome($cycle);
		$data['pays'] = $this->Registration->get_pays();
		$data['styles'] = base_url('assets/css/wizard_style.css');
		$data['js'] = base_url('assets/js/form_wizard.js');
		$this->load->view('common/header', $data);
		// ON insere dans la variable data['pays'] le retour de la methode get_pays() du model Registration
		$data['$pays']=$this->Registration->get_pays();
		// ON envoi le resultat de toute les requetes a la vue dut_registration_view a travers la variable data  
		$this->load->view('front_end/litech_registration_view', $data);
		$this->load->view('common/footer', $data);
	}
	

	public function get_regions()
	{

		$id_pays = $this->input->post('id_pays', TRUE);//recupere l'id du pays selctionné dans un imput
		$regions = $this->Registration->get_regions($id_pays);
		echo json_encode($regions);
	}

	public function get_parcours()
	{
		$id_mention = $this->input->post('mention', TRUE);
		$abrev_cycle = $this->input->post('cycle', TRUE);
		$parcours = $this->Registration->get_parcours($id_mention, $abrev_cycle);
		echo json_encode($parcours);
	}

    public function get_diplome()
    {
     	if($this->input->post('parcours1'))
     	{
     		$c= $this->input->post('parcours1');

     		echo $this->Registration->get_diplome($c);
     	}
    }
    
	public function dut_save_folder()
	{

		$paiement = array(
			'nom_agence' => mb_strtoupper($this->input->post('nom_agence')),
			'num_bordereau' => $this->input->post('num_bordereau'),
			'num_transaction' => $this->input->post('num_trans'),
			'id_mode_paiement' => $this->input->post('banque')
		);
		$diplome_entree = array(
			'annee' => $this->input->post('annee_obt'),
			'centre_obtention' => mb_strtoupper($this->input->post('centre_obtention')),
			'id_diplome' => $this->input->post('diplome'),
			'id_pays' => $this->input->post('pays_obt')
		);
		$candidat = array(
			'nom_candidat' => mb_strtoupper($this->input->post('nom_candidat')),
			'prenom_candidat' => mb_strtoupper($this->input->post('prenom_candidat')),
			'date_naiss' => $this->input->post('date_naiss'),
			'lieu_naiss' => mb_strtoupper($this->input->post('lieu_naiss')),
			'sexe' => $this->input->post('sexe'),
			'adresse_perso' => mb_strtoupper($this->input->post('adress_perso')),
			'telephone' => $this->input->post('phone'),
			'email' => mb_strtolower($this->input->post('email')),
			'photo' => 'default.png',
			'tentative' => $this->input->post('tentative'),
			'id_reg_or' => $this->input->post('region_or')
		);
		if ($this->input->post('admission') == 'Concours') 
		{
			$lang_comp = (($this->input->post('lang_comp') == 'fr')?'Français':'Anglais');

		}
		else
		{
			$lang_comp = '';
		}



		$this->Registration->add_paiement($paiement);
		$id_paiement = $this->db->insert_id();
		$this->Registration->add_diplome_entree($diplome_entree);
		$id_diplome_entree = $this->db->insert_id();
		$this->Registration->add_candidat($candidat);
		$id_candidat = $this->db->insert_id();
		

		$dossier = array(
			'langue_composition' => $lang_comp,
			'date_inscription' => date('Y-m-d'),
			'mode_admission' => $this->input->post('admission'),
			'statut' => 'en_attente',
			'id_lieu_depot' => $this->input->post('lieu_depot'),
			'id_centre_examen' => $this->input->post('centre_exam'),
			'id_candidat' => $id_candidat,
			'id_paiement' => $id_paiement,
			'id_diplome_entree' => $id_diplome_entree
		);
		$this->Registration->add_folder($dossier);
		$id_dossier = $this->db->insert_id();
		$id_mention = $this->input->post('mention');
		$mention = $this->db->where('id_mention', $id_mention)->get('mention')->first_row()->sigle_mention;
		if ($mention == 'GBIO') 
		{
			$parcours_choisis = array();
			for($i=1; $i<4; $i++)
			{
				$parcours_choisis[] = array(
					'ordre_parcour_choisi' => $i,
					'id_parcour' => $this->input->post('parcours'.$i),
					'id_dossier' => $id_dossier
				);
			}

			for($count = 0; $count < count($parcours_choisis); $count++)
			{
				$this->Registration->add_parcour_choisi($parcours_choisis[$count]);
			}
			
		}
		elseif($mention == 'GIM')
		{
			$parcours_choisis = array();
			for($i=1; $i<5; $i++)
			{
				$parcours_choisis[] = array(
					'ordre_parcour_choisi' => $i,
					'id_parcour' => $this->input->post('parcours'.$i),
					'id_dossier' => $id_dossier
				);
			}

			for($count = 0; $count < count($parcours_choisis); $count++)
			{
				$this->Registration->add_parcour_choisi($parcours_choisis[$count]);
			}
		}
		else
		{
			$parcours_choisis =array(
				'ordre_parcour_choisi' => 1,
				'id_parcour' => $this->input->post('parcours1'),
				'id_dossier' => $id_dossier
			);
			$this->Registration->add_parcour_choisi($parcours_choisis);
		}
		

		

		$cursus = array();
		for($i=1; $i < 6; $i++)
		{
			$cursus[] = array(
				'annee' => $this->input->post('annee'.$i),
				'etablissement' => mb_strtoupper($this->input->post('ets'.$i)),
				'classe_suivie' => $this->input->post('cls'.$i),
				'examen_prepare' => mb_strtoupper($this->input->post('exm'.$i)),
				'resultat' => $this->input->post('res'.$i),
				'mention' => $this->input->post('mention'.$i),
				'id_dossier' => $id_dossier
			);
		}

		for($count = 0; $count < count($cursus); $count++)
		{
			$this->Registration->add_cursus($cursus[$count]);
		}

		$this->session->set_flashdata('id_candidat', $id_candidat);
		
		redirect('generation/generer_fiche_candidat');

	}



	public function bts_save_folder()
	{

			$paiement = array(
				'nom_agence' => mb_strtoupper($this->input->post('nom_agence')),
				'num_bordereau' => $this->input->post('num_bordereau'),
				'num_transaction' => $this->input->post('num_trans'),
				'id_mode_paiement' => $this->input->post('banque')
			);
			
			$diplome_entree = array(
				'annee' => $this->input->post('annee_obt'),
				'centre_obtention' => mb_strtoupper($this->input->post('centre_obtention')),
				'id_diplome' => $this->input->post('diplome'),
				'id_pays' => $this->input->post('pays_obt')
			);
			$candidat = array(
				'nom_candidat' => mb_strtoupper($this->input->post('nom_candidat')),
				'prenom_candidat' => mb_strtoupper($this->input->post('prenom_candidat')),
				'date_naiss' => $this->input->post('date_naiss'),
				'lieu_naiss' => mb_strtoupper($this->input->post('lieu_naiss')),
				'sexe' => $this->input->post('sexe'),
				'adresse_perso' => mb_strtoupper($this->input->post('adress_perso')),
				'telephone' => $this->input->post('phone'),
				'email' => mb_strtolower($this->input->post('email')),
				'photo' => 'default.png',
				'tentative' => $this->input->post('tentative'),
				'id_reg_or' => $this->input->post('region_or')

			);
			
			$lang_comp = (($this->input->post('lang_comp') == 'fr')?'Français':'Anglais');
			$this->Registration->add_paiement($paiement);
			$id_paiement = $this->db->insert_id();
			$this->Registration->add_diplome_entree($diplome_entree);
			$id_diplome_entree = $this->db->insert_id();
			$this->Registration->add_candidat($candidat);
			$id_candidat = $this->db->insert_id();
			

			$dossier = array(
								'langue_composition' => $lang_comp,
								'date_inscription' => date('Y-m-d'),
								//'mode_admission' => $this->input->post('admission'),
								'statut' => 'en_attente',
								'id_lieu_depot' => $this->input->post('lieu_depot'),
								'id_centre_examen' => $this->input->post('centre_exam'),
								'id_candidat' => $id_candidat,
								'id_paiement' => $id_paiement,
								'id_diplome_entree' => $id_diplome_entree
							);
			$this->Registration->add_folder($dossier);
			$id_dossier = $this->db->insert_id();
		
			
			$parcours_choisis =array(
				'ordre_parcour_choisi' => 1,
				'id_parcour' => $this->input->post('parcours1'),
				'id_dossier' => $id_dossier
				);
				$this->Registration->add_parcour_choisi($parcours_choisis);
			
			

			

			$cursus = array();
			for($i=1; $i < 6; $i++)
			{
				$cursus[] = array(
					'annee' => $this->input->post('annee'.$i),
					'etablissement' => mb_strtoupper($this->input->post('ets'.$i)),
					'classe_suivie' => $this->input->post('cls'.$i),
					'examen_prepare' => mb_strtoupper($this->input->post('exm'.$i)),
					'resultat' => $this->input->post('res'.$i),
					'mention' => $this->input->post('mention'.$i),
					'id_dossier' => $id_dossier
				);
			}

			for($count = 0; $count < count($cursus); $count++)
			{
				$this->Registration->add_cursus($cursus[$count]);
			}

			$this->session->set_flashdata('id_candidat', $id_candidat);
			
			redirect('generation/generer_fiche_candidat');

	}


	public function litech_save_folder()
	{

		$paiement = array(
			'nom_agence' => mb_strtoupper($this->input->post('nom_agence')),
			'num_bordereau' => $this->input->post('num_bordereau'),
			'num_transaction' => $this->input->post('num_trans'),
			'id_mode_paiement' => $this->input->post('banque')
		);
		
		$diplome_entree = array(
			'annee' => $this->input->post('annee_obt'),
			'centre_obtention' => mb_strtoupper($this->input->post('centre_obtention')),
			'id_diplome' => $this->input->post('diplome'),
			'id_pays' => $this->input->post('pays_obt')
		);
		$candidat = array(
			'nom_candidat' => mb_strtoupper($this->input->post('nom_candidat')),
			'prenom_candidat' => mb_strtoupper($this->input->post('prenom_candidat')),
			'date_naiss' => $this->input->post('date_naiss'),
			'lieu_naiss' => mb_strtoupper($this->input->post('lieu_naiss')),
			'sexe' => $this->input->post('sexe'),
			'adresse_perso' => mb_strtoupper($this->input->post('adress_perso')),
			'telephone' => $this->input->post('phone'),
			'email' => mb_strtolower($this->input->post('email')),
			'photo' => 'default.png',
			'tentative' => $this->input->post('tentative'),
			'id_reg_or' => $this->input->post('region_or'),
			'nom_du_pere' => $this->input->post('nom_pere'),
			'nom_de_la_mere' => $this->input->post('nom_mere')


		);
	



		
		$lang_comp = (($this->input->post('lang_comp') == 'fr')?'Français':'Anglais');
		$this->Registration->add_paiement($paiement);
		
		$id_paiement = $this->db->insert_id();
		$this->Registration->add_diplome_entree($diplome_entree);
		$id_diplome_entree = $this->db->insert_id();
		$this->Registration->add_candidat($candidat);
		$id_candidat = $this->db->insert_id();
		
		
		// INSERTION DE L'EMPLOI DU CANDIDAT

		if ($this->input->post('emploi')=='Oui')
		{
			$employeur= $this->input->post('nom_employeur');
			$fonction= $this->input->post('poste');

			$emploi = array(
				'employeur' => mb_strtoupper($employeur),
				'fonction' => $fonction,
				'id_candidat' => $id_candidat
			);

			$this->Registration->add_emploi($emploi);
		}
		

		

		$dossier = array(
							'langue_composition' => $lang_comp,
							'date_inscription' => date('Y-m-d'),
							//'mode_admission' => $this->input->post('admission'),
							'statut' => 'en_attente',
							'id_lieu_depot' => $this->input->post('lieu_depot'),
							'id_centre_examen' => (11),
							'id_candidat' => $id_candidat,
							'id_paiement' => $id_paiement,
							'id_diplome_entree' => $id_diplome_entree
						);
		$this->Registration->add_folder($dossier);
		$id_dossier = $this->db->insert_id();
		$id_mention = $this->input->post('mention');
		$mention = $this->db->where('id_mention', $id_mention)->get('mention')->first_row()->sigle_mention;
		if ($mention == 'GCD') 
		{
			$parcours_choisis =array(
				'ordre_parcour_choisi' => 1,
				'id_parcour' => $this->input->post('parcours1'),
				'id_dossier' => $id_dossier
			);
			$this->Registration->add_parcour_choisi($parcours_choisis);
			
		}
		else
		{
			$parcours_choisis = array();
			for($i=1; $i<3; $i++)
			{
				$parcours_choisis[] = array(
					'ordre_parcour_choisi' => $i,
					'id_parcour' => $this->input->post('parcours'.$i),
					'id_dossier' => $id_dossier
				);
			}

			for($count = 0; $count < count($parcours_choisis); $count++)
			{
				$this->Registration->add_parcour_choisi($parcours_choisis[$count]);
			}
		}
		
		$cursus = array();
		for($i=1; $i < 4; $i++)
		{
			$cursus[] = array(
				'annee' => $this->input->post('annee'.$i),
				'etablissement' => mb_strtoupper($this->input->post('ets'.$i)),
				'classe_suivie' => $this->input->post('cls'.$i),
				'examen_prepare' => mb_strtoupper($this->input->post('exm'.$i)),
				'mention' => $this->input->post('mention'.$i),
				'id_dossier' => $id_dossier
			);
		}

		for($count = 0; $count < count($cursus); $count++)
		{
			$this->Registration->add_cursus($cursus[$count]);
		}

		$this->session->set_flashdata('id_candidat', $id_candidat);
		
		redirect('generation/generer_fiche_candidat');

	}


	
	
	/* GENERATION DE L'APERCU */ 
	public function apercu()
	{
        /*RECUPERATION DES DONNEES DU FORMULAIRE*/
         $cycle = $this->input->post('cycle');

        // CAS DES INFORMATIONS PERSONNELLES
         $data['cycle'] = $cycle;
		$data['nom_candidat'] = $this->input->post('nom_candidat');
		$data['prenom_candidat'] = $this->input->post('prenom_candidat');
		$data['sexe'] = $this->input->post('sexe');
		$data['lieu_naiss'] = $this->input->post('lieu_naiss');
		$data['date_naiss'] = $this->input->post('date_naiss');
		$id_nationalite = $this->input->post('nationalite');
		$data['nationalite'] = $this->db->where('id_pays', $id_nationalite)->get('pays')->first_row()->nom_pays;
        $id_reg_or = $this->input->post('region_or');
        $data['region_or'] = $this->db->where('id_reg_or', $id_reg_or)->get('region_or')->first_row()->nom_reg_or;
		
         // CAS D'ADRESSES PERSONNELLES

        $data['adress_perso'] = $this->input->post('adress_perso');
		$data['phone'] = $this->input->post('phone');
		$data['email'] = $this->input->post('email');

        // CAS DES INFORMATIONS SUR LE DIPLOME D'ENTREE
        
        $id_diplome = $this->input->post('diplome');
		$data['diplome'] = $this->db->where('id_diplome', $id_diplome)->get('diplome')->first_row()->intitule_diplome;	
		$data['annee_obt'] = $this->input->post('annee_obt');	
		$id_pays = $this->input->post('pays_obt');
		$data['pays_obt'] = $this->db->where('id_pays', $id_pays)->get('pays')->first_row()->nom_pays;
		$data['centre_obtention'] = $this->input->post('centre_obtention');


		// CAS DES INFORMATIONS SUR LA FORMATION CHOISIE

		$data['mode_admission'] = $this->input->post('admission'); 
        $id_mention = $this->input->post('mention');
		$data['sigle_mention'] = $this->db->where('id_mention', $id_mention)->get('mention')->first_row()->sigle_mention;
		$data['mention'] = $this->db->where('id_mention', $id_mention)->get('mention')->first_row()->nom_mention;

         // CAS DU CURSUS SCOLAIRE

         $data['annee1']= $this->input->post('annee1');
         $data['ets1']= $this->input->post('ets1');
         $data['cls1']= $this->input->post('cls1');
         $data['exm1']= $this->input->post('exm1');
         $data['mention1']= $this->input->post('mention1');

         $data['annee2']= $this->input->post('annee2');
         $data['ets2']= $this->input->post('ets2');
         $data['cls2']= $this->input->post('cls2');
         $data['exm2']= $this->input->post('exm2');
         $data['mention2']= $this->input->post('mention2');

         $data['annee3']= $this->input->post('annee3');
         $data['ets3']= $this->input->post('ets3');
         $data['cls3']= $this->input->post('cls3');
         $data['exm3']= $this->input->post('exm3');
         $data['mention3']= $this->input->post('mention3');
          
          // CAS DES DONNEES DE PAIEMENTS

         $id_banque = $this->input->post('banque');
		 $data['banque'] = $this->db->where('id_mode_paiement', $id_banque)->get('mode_paiement')->first_row()->nom_banque;

		$data['agence'] = $this->input->post('nom_agence');
		$data['num_bordereau'] = $this->input->post('num_bordereau');
		$data['num_trans'] = $this->input->post('num_trans');

		// CAS DES INFORMATIONS SUR LE DOSSIER
				
        $id_lieu_depot = $this->input->post('lieu_depot');
		$data['lieu_depot'] = $this->db->where('id_lieu_depot', $id_lieu_depot)->get('lieu_depot')->first_row()->abrev_lieu_depot;
		
		if ($cycle == 'LITECH')
			{
				$data['nom_mere']= $this->input->post('nom_mere');
				$data['nom_pere']= $this->input->post('nom_pere');
				$data['emploi']= $this->input->post('emploi');
				if ($data['emploi']=='Oui')
					{
						$data['employeur']= $this->input->post('nom_employeur');
						$data['fonction']= $this->input->post('poste');
					}
				else
					{
						$data['employeur']= '//';
						$data['fonction']= '//';
					}

				if ($data['sigle_mention']=='GCD')
					{
						$id_parcours1= $this->input->post('parcours1');
						$data['parcours1'] = $this->db->where('id_parcour', $id_parcours1)->get('parcour')->first_row()->abreviation_parcour;
						$data['parcours2'] = $data['parcours1'];
						
					}
				else
					{
						$id_parcours1= $this->input->post('parcours1');
						$data['parcours1'] = $this->db->where('id_parcour', $id_parcours1)->get('parcour')->first_row()->abreviation_parcour;
						$id_parcours2= $this->input->post('parcours2');
						$data['parcours2'] = $this->db->where('id_parcour', $id_parcours2)->get('parcour')->first_row()->abreviation_parcour;
					}
				
				$apercu =  $this->load->view('apercu_fiche_litech', $data,true);
        		echo $apercu;
			}

		else
			{

				$id_centre_examen = $this->input->post('centre_exam');
				$data['centre_exam'] = $this->db->where('id_centre_examen', $id_centre_examen)->get('centre_examen')->first_row()->nom_centre_examen;
				$data['tentative'] = $this->input->post('tentative');
				$data['lang_comp'] = $this->input->post('lang_comp');
				$data['res1']= $this->input->post('res1');
				$data['res2']= $this->input->post('res2');
				$data['res3']= $this->input->post('res3');

				 $data['annee4']= $this->input->post('annee4');
		         $data['ets4']= $this->input->post('ets4');
		         $data['cls4']= $this->input->post('cls4');
		         $data['exm4']= $this->input->post('exm4');
		         $data['res4']= $this->input->post('res4');
		         $data['mention4']= $this->input->post('mention4');

		         $data['annee5']= $this->input->post('annee5');
		         $data['ets5']= $this->input->post('ets5');
		         $data['cls5']= $this->input->post('cls5');
		         $data['exm5']= $this->input->post('exm5');
		         $data['res5']= $this->input->post('res5');
		         $data['mention5']= $this->input->post('mention5');

		          $apercu =  $this->load->view('apercu_fiche_dut', $data,true);
       			  echo $apercu;

		    }

        // TRANSMISSION DES DONNEES A LA VUE
	   
	}
}
