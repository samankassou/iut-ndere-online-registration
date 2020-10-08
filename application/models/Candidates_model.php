<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidates_model extends CI_Model {

	public function get_infos_perso_candidat($id_candidat){
		$this->db->where('candidat.id_candidat', $id_candidat);
		$this->db->join('dossier', 'dossier.id_candidat = candidat.id_candidat', 'left');
		$this->db->join('centre_examen', 'dossier.id_centre_examen = centre_examen.id_centre_examen', 'left');
		return $this->db->get('candidat')->first_row();
	}

	public function get_origine_candidat($id_candidat){
		$this->db->where('candidat.id_candidat', $id_candidat);
		$this->db->join('region_or', 'region_or.id_reg_or = candidat.id_reg_or', 'left');
		$this->db->join('pays', 'region_or.id_pays = pays.id_pays', 'left');
		return $this->db->get('candidat')->first_row();
	}

	public function get_emploi_candidat($id_candidat){
		$this->db->where('id_candidat', $id_candidat);
		return $this->db->get('emploi')->first_row();
	}

	public function get_diplome_candidat($id_candidat){
		$this->db->where('id_candidat', $id_candidat);
		$this->db->join('diplome_entree', 'dossier.id_diplome_entree = diplome_entree.id_diplome_entree', 'left');
		$this->db->join('diplome', 'diplome.id_diplome = diplome_entree.id_diplome', 'left');
		$this->db->join('pays', 'pays.id_pays = diplome_entree.id_pays');
		return $this->db->get('dossier')->first_row();
	}

	public function get_cursus_candidat($id_candidat){
		$this->db->where('id_candidat', $id_candidat);
		$this->db->join('cursus', 'cursus.id_dossier = dossier.id_dossier');
		return $this->db->get('dossier')->result();
	}

	public function get_mention_candidat($id_candidat){
		$this->db->where('id_candidat', $id_candidat);
		$this->db->join('parcour_choisi', 'parcour_choisi.id_dossier = dossier.id_dossier', 'left');
		$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('mention', 'parcour.id_mention = mention.id_mention', 'left');
		return $this->db->get('dossier')->first_row();
	}

	public function get_parcour_candidat($id_candidat){
		$this->db->where('id_candidat', $id_candidat);
		$this->db->join('parcour_choisi', 'parcour_choisi.id_dossier = dossier.id_dossier', 'left');
		$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
		return $this->db->get('dossier')->first_row();
	}

	public function get_parcours_choisis_candidat($id_candidat){
		$this->db->where('id_candidat', $id_candidat);
		$this->db->join('parcour_choisi', 'parcour_choisi.id_dossier = dossier.id_dossier', 'left');
		$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
		return $this->db->get('dossier')->result();
	}

	public function get_candidate_cycle($id_candidat){
		$id_dossier = $this->db->where('id_candidat', $id_candidat)->get('dossier')->first_row()->id_dossier;
		$id_parcour = $this->db->where('id_dossier', $id_dossier)->get('parcour_choisi')->first_row()->id_parcour;
		$id_cycle = $this->db->where('id_parcour', $id_parcour)->get('cycle_parcours')->first_row()->id_cycle;
		$cycle = $this->db->where('id_cycle', $id_cycle)->get('cycle')->first_row()->abreviation_cycle;
		return $cycle;

	}
	
	public function get_all_candidates(){
		$this->db->join('dossier', 'dossier.id_candidat = candidat.id_candidat', 'left');
		$this->db->join('region_or', 'region_or.id_reg_or = candidat.id_reg_or', 'left');
		$this->db->join('pays', 'region_or.id_pays = pays.id_pays', 'left');
		$this->db->join('parcour_choisi', 'dossier.id_dossier = parcour_choisi.id_dossier', 'left');
		$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
		$this->db->group_by('candidat.id_candidat');
		return $this->db->get('candidat')->result();
	}

}