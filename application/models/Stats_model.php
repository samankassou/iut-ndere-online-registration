<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats_model extends CI_Model {

	public function count_folders($table, $conditions=array())
	{
		$this->db->where($conditions);
		return $this->count_all_results($table);
	}

	public function count_by_region($conditions){
		$this->db->select('region_or.id_reg_or, nom_reg_or, sexe, COUNT(id_candidat) as total');
		$this->db->join('region_or', 'candidat.id_reg_or = region_or.id_reg_or', 'right');
		$this->db->group_by('region_or.nom_reg_or');
		$this->db->order_by('nom_reg_or', 'desc');
		return $this->db->get('candidat')->result();
	}

	public function noms_regions(){
		return $this->db->query("SELECT nom_reg_or FROM region_or GROUP BY nom_reg_or ORDER BY nom_reg_or DESC")->result_array();
	}

	public function noms_centre_exam($cycle = ''){
		if ($cycle != '') {
			return $this->db->query('SELECT nom_centre_examen FROM centre_examen LEFT JOIN cycle_centre_examen ON centre_examen.id_centre_examen = cycle_centre_examen.id_centre_examen LEFT JOIN cycle ON cycle_centre_examen.id_cycle = cycle.id_cycle WHERE abreviation_cycle = ? GROUP BY nom_centre_examen ORDER BY nom_centre_examen DESC', $cycle)->result_array();
		}
		return $this->db->query("SELECT nom_centre_examen FROM centre_examen GROUP BY nom_centre_examen ORDER BY nom_centre_examen DESC")->result_array();
	}

	public function noms_lieu_depot(){
		return $this->db->query("SELECT abrev_lieu_depot FROM lieu_depot GROUP BY abrev_lieu_depot ORDER BY abrev_lieu_depot DESC")->result_array();
	}

	public function count($conditions = array()){
		$this->db->where($conditions);
		return $this->db->count_all_results('candidat');
	}

	public function candidats_par_region($nom_reg_or, $sexe = '', $cycle = '', $lang = '', $lieu_depot = '', $centre_exam = ''){
		//par region d'origine et par sexe
		if ($cycle == '' && $lang == '') {
			if ($sexe == '') {
				$this->db->where('nom_reg_or', $nom_reg_or);
				$this->db->join('region_or', 'candidat.id_reg_or = region_or.id_reg_or', 'left');
				return $this->db->count_all_results('candidat');
			}
			$this->db->where('nom_reg_or', $nom_reg_or);
			$this->db->where('sexe', $sexe);
			$this->db->join('region_or', 'candidat.id_reg_or = region_or.id_reg_or', 'left');
			return $this->db->count_all_results('candidat');
		}
		if ($cycle != '' && $sexe != '' && $lang == '') {
			$this->db->join('region_or', 'candidat.id_reg_or = region_or.id_reg_or', 'left');
			$this->db->join('dossier', 'dossier.id_candidat = candidat.id_candidat', 'left');
			$this->db->join('parcour_choisi', 'parcour_choisi.id_dossier = dossier.id_dossier', 'left');
			$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
			$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
			$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
			$this->db->where('nom_reg_or', $nom_reg_or);
			$this->db->where('sexe', $sexe);
			$this->db->where('abreviation_cycle', $cycle);
			$this->db->group_by('candidat.id_candidat');
			return $this->db->get('candidat')->result();
		}
		//par langue de composition
		if ($lang != '') {
			$this->db->join('region_or', 'candidat.id_reg_or = region_or.id_reg_or', 'left');
			$this->db->join('dossier', 'dossier.id_candidat = candidat.id_candidat', 'left');
			$this->db->join('parcour_choisi', 'parcour_choisi.id_dossier = dossier.id_dossier', 'left');
			$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
			$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
			$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
			$this->db->where('nom_reg_or', $nom_reg_or);
			$this->db->where('langue_composition', $lang);
			$this->db->where('abreviation_cycle', $cycle);
			$this->db->group_by('candidat.id_candidat');
			return $this->db->get('candidat')->result();
		}
		//par cycle
		if ($sexe == '' && $lang == ''  && $cycle != '') {

			$this->db->join('region_or', 'candidat.id_reg_or = region_or.id_reg_or', 'left');
			$this->db->join('dossier', 'dossier.id_candidat = candidat.id_candidat', 'left');
			$this->db->join('parcour_choisi', 'parcour_choisi.id_dossier = dossier.id_dossier', 'left');
			$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
			$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
			$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
			$this->db->where('nom_reg_or', $nom_reg_or);
			$this->db->where('abreviation_cycle', $cycle);
			$this->db->group_by('candidat.id_candidat');
			return $this->db->get('candidat')->result();
			
		}
		

	}

	public function count_total_cycle($conditions = array()){
		$this->db->join('dossier', 'candidat.id_candidat = dossier.id_candidat', 'left');
		$this->db->join('parcour_choisi', 'dossier.id_dossier = parcour_choisi.id_dossier', 'left');
		$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
		$this->db->where($conditions);
		$this->db->group_by('candidat.id_candidat');
		return $this->db->get('candidat')->result();
	}

	public function count_total_cycle_centre_exam($centre_exam, $sexe = '', $cycle, $lang = ''){
		$this->db->join('dossier', 'candidat.id_candidat = dossier.id_candidat', 'left');
		$this->db->join('centre_examen', 'centre_examen.id_centre_examen = dossier.id_centre_examen', 'left');
		$this->db->join('parcour_choisi', 'dossier.id_dossier = parcour_choisi.id_dossier', 'left');
		$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
		$this->db->where('nom_centre_examen', $centre_exam);
		if ($sexe != '') {
			$this->db->where('sexe', $sexe);
		}
		if($lang =! '' && $sexe == '')
		{
			$this->db->where('langue_composition', $lang);
		}
		$this->db->where('abreviation_cycle', $cycle);
		$this->db->group_by('candidat.id_candidat');
		return $this->db->get('candidat')->result();
	}

	public function count_total_cycle_lieu_depot($lieu_depot, $sexe = '', $cycle){
		$this->db->join('dossier', 'candidat.id_candidat = dossier.id_candidat', 'left');
		$this->db->join('lieu_depot', 'dossier.id_lieu_depot = lieu_depot.id_lieu_depot', 'left');
		$this->db->join('parcour_choisi', 'dossier.id_dossier = parcour_choisi.id_dossier', 'left');
		$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
		$this->db->where('abrev_lieu_depot', $lieu_depot);
		if ($sexe != '') {
			$this->db->where('sexe', $sexe);
		}
		$this->db->where('abreviation_cycle', $cycle);
		$this->db->group_by('candidat.id_candidat');
		return $this->db->get('candidat')->result();
	}
}
