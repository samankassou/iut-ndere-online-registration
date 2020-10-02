<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_Model {

	public function get_banques(){
         /* ->result() permet de retourner le resultat sous forme de tableau*/
		return $this->db->get('mode_paiement')->result();
		
	}

	public function get_centres_exam(){
		return $this->db->get('centre_examen')->result();
	}

	public function get_lieux_depot(){
		return $this->db->get('lieu_depot')->result();
	}
  // chargement des mentions en fonction du cycle
	


	public function get_mentions($cycle = ''){
		if ($cycle	== '') 
		{
			return $this->db->get('mention')->result();
		}

         	$this->db->join('parcour', 'mention.id_mention = parcour.id_mention', 'left');
			$this->db->join('cycle_parcours', 'parcour.id_parcour = cycle_parcours.id_parcour', 'left');
			$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
			$this->db->where('abreviation_cycle', $cycle);
			$this->db->group_by('nom_mention');	
			return $this->db->get('mention')->result();
         }

	public function get_parcours($id_mention, $abrev_cycle){
		$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
		$this->db->where('id_mention', $id_mention);
		$this->db->where('abreviation_cycle', $abrev_cycle);
		return $this->db->get('parcour')->result();
	}
	public function get_diplome($c){
		/*$this->db->join('diplome_requis', 'diplome.id_diplome = diplome_requis.id_diplome', 'left');
		$this->db->join('parcour', 'parcour.id_parcour = diplome_requis.id_parcour', 'left');
		$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
		$this->db->where('abreviation_cycle', $abrev_cycle);
		$this->db->group_by('intitule_diplome');
		return $this->db->get('diplome')->result();*/

		$query= $this->db->query("SELECT * FROM diplome,diplome_requis WHERE diplome.id_diplome=diplome_requis.id_diplome AND id_parcour='$c'");
		$output='';
		foreach ($query->result() as $key) {
			$output.='<option value="'.$key->id_diplome.'">'.$key->intitule_diplome.'</option>';
		}
		return $output;
	}

	public function add_paiement($data){
		$this->db->insert('paiement', $data);
	}

	public function add_diplome_entree($diplome_entree){
		$this->db->insert('diplome_entree', $diplome_entree);
	}

	public function add_candidat($candidat){
		$this->db->insert('candidat', $candidat);
	}

	public function add_folder($folder){
		$this->db->insert('dossier', $folder);
	}

	public function add_emploi($emploi){
		$this->db->insert('emploi', $emploi);
	}

	public function add_cursus($cursus){
		$this->db->insert('cursus', $cursus);
	}

	public function add_parcour_choisi($parcour_choisi){
		$this->db->insert('parcour_choisi', $parcour_choisi);
	}



	/* Recuperation de la table pays dans la bd*/
	public function get_pays(){
		return $this->db->get('pays')->result();
	}

	public function get_regions($id_pays){
		return $this->db->where('id_pays', $id_pays)->get('region_or')->result();
	}
}