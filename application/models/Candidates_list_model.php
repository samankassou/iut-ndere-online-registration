<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidates_list_model extends CI_Model {

	var $table = 'candidat';
	var $column_order = array(null, null, null, 'nom_lieu_depot', 'nom_candidat', 'prenom_candidat', 'sexe', 'date_naiss', 'nom_mention', 'nom_centre_examen','nom_lieu_depot'); //set column field database for datatable orderable
	var $column_search = array('nom_lieu_depot', 'nom_candidat', 'prenom_candidat', 'sexe', 'date_naiss', 'nom_mention', 'nom_centre_examen','nom_lieu_depot'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('candidat.id_candidat' => 'desc'); // default order 


	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		$this->db->join('dossier', 'candidat.id_candidat = dossier.id_candidat', 'left');
		$this->db->join('paiement', 'dossier.id_paiement = paiement.id_paiement', 'left');
		$this->db->join('mode_paiement', 'paiement.id_mode_paiement = mode_paiement.id_mode_paiement', 'left');
		$this->db->join('region_or', 'candidat.id_reg_or = region_or.id_reg_or', 'left');
		$this->db->join('pays', 'region_or.id_pays = pays.id_pays', 'left');
		$this->db->join('parcour_choisi', 'dossier.id_dossier = parcour_choisi.id_dossier', 'left');
		$this->db->join('parcour', 'parcour_choisi.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
		$this->db->join('mention', 'parcour.id_mention = mention.id_mention', 'left');
		$this->db->join('centre_examen', 'dossier.id_centre_examen = centre_examen.id_centre_examen', 'left');
		$this->db->join('lieu_depot', 'dossier.id_lieu_depot = lieu_depot.id_lieu_depot', 'left');
		$this->db->where('statut', $this->input->post('statut'));

		if ($this->input->post('cycle') !== null && !empty($this->input->post('cycle'))) {
			$this->db->where('cycle.id_cycle', $this->input->post('cycle'));
		}

		if ($this->input->post('pays') !== null && !empty($this->input->post('pays'))) {
			$this->db->where('pays.id_pays', $this->input->post('pays'));
		}

		if ($this->input->post('region') !== null && !empty($this->input->post('region'))) {
			$this->db->where('region_or.id_reg_or', $this->input->post('region'));
		}

		if ($this->input->post('sexe') !== null && !empty($this->input->post('sexe'))) {
			$this->db->where('sexe', $this->input->post('sexe'));
		}

		if ($this->input->post('mention') !== null && !empty($this->input->post('mention'))) {
			$this->db->where('mention.id_mention', $this->input->post('mention'));
		}

		if ($this->input->post('langue') !== null && !empty($this->input->post('langue'))) {
			$this->db->where('langue_composition', $this->input->post('langue'));
		}

		if ($this->input->post('centre_examen') !== null && !empty($this->input->post('centre_examen'))) {
			$this->db->where('centre_examen.id_centre_examen', $this->input->post('centre_examen'));
		}

		if ($this->input->post('lieu_depot') !== null && !empty($this->input->post('lieu_depot'))) {
			$this->db->where('lieu_depot.id_lieu_depot', $this->input->post('lieu_depot'));
		}

		if ($this->input->post('parcours') !== null && !empty($this->input->post('parcours'))) {
			$this->db->where('parcour.id_parcour', $this->input->post('parcours'));
		}

		$i = 0;
		
		foreach ($this->column_search as $item) // loop column 
		{
			if(isset($_POST['search']['value'])) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
				}
				$i++;
			}
			
			$this->db->group_by('candidat.id_candidat');
			
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if (isset($_POST['length'])) {
			if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('candidat.id_candidat',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function valid_candidat($id_candidat){
		$this->db->set('statut', 'valide');
		$this->db->where('id_candidat', $id_candidat);
		$this->db->update('dossier');
	}
	public function invalid_candidat($id_candidat){
		$this->db->set('statut', 'en_attente');
		$this->db->where('id_candidat', $id_candidat);
		$this->db->update('dossier');
	}
	public function lieu_depot()
	{
		return $this->db->select('*')
		->from('lieu_depot')
		->get()
		->result();
	}
	public function Pays_Origine()
	{
		return $this->db->select('*')
		->from('pays')
		->get()
		->result();
	}
	public function reg_or()
	{
		return $this->db->select('*')
		->from('region_Or')
		->group_by('nom_reg_or')
		->get()
		->result();
	}
	
	public function centre_exam()
	{
		return $this->db->select('*')
		->from('centre_examen')
		->get()
		->result();
	}
	public function fetch_centre($id)
	{
		return $this->db->select('*')
		->from('cycle_centre_examen')
		->where('cycle.id_cycle',$id)
		->join('cycle','cycle.id_cycle=cycle_centre_examen.id_cycle')
		->join('centre_examen','centre_examen.id_centre_examen=cycle_centre_examen.id_centre_examen')
		->get()
		->result();
	}
	
	public function mention()
	{
		return $this->db->select('*')
		->from('mention')
		->get()
		->result();
	}
	public function parcours()
	{
		return $this->db->select('*')
		->from('parcour')
		->get()
		->result();
	}
	public function cycle()
	{
		return $this->db->select('*')
		->from('cycle')
		->get()
		->result();
	}
	public function get_cycle($id)
	{
		return $this->db->select('*')
		->from('cycle')
		->where('id_cycle',$id)
		->get()
		->result();
	}
	public function get_mention($id)
	{
		return $this->db->select('*')
		->from('mention')
		->where('id_mention',$id)
		->get()
		->result();
	}
	public function get_centre($id)
	{
		return $this->db->select('*')
		->from('centre_examen')
		->where('id_centre_examen',$id)
		->get()
		->result();
	}
	public function fetch_parcours($mention)
	{
		$query = $this->db->query("SELECT * FROM parcour WHERE id_mention=?", $mention);
		$output = '<option value="">Choissisez un parcours</option>';
		foreach ($query->result() as $key) {
			$output .= '<option value=' . $key->id_parcour . '>' . $key->abreviation_parcour . '</option>';
		}
		return $output;
	}



	public function fetch_parcour($mention, $cycle)
	{
		$resultat = $this->db->select('*')
		->from('parcour')
		->join('mention', 'parcour.id_mention = mention.id_mention')
		->join('cycle_parcours', 'parcour.id_parcour = cycle_parcours.id_parcour')
		->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle')
		->where('mention.id_mention', $mention)
		->where('cycle.id_cycle', $cycle)
		->get()
		->result();
			//var_dump($resulat); die;

		$output = '';
		foreach ($resultat as $key) {
			$output .= '<option value=' . $key->id_parcour . '>' . $key->abreviation_parcour . '</option>';
		}
		return $output;
	}
	public function get_parcour($id)
	{
		return $this->db->select('*')
		->from('parcour')
		->where('id_mention', $id)
		->get()
		->result();
	}
		//public function

	public function fetch_region($id_pays)
	{

		return $this->db->where('id_pays', $id_pays)->get('region_or')->result();
	}

	public function fetch_mentions($id_cycle)
	{
		$this->db->join('parcour', 'mention.id_mention = parcour.id_mention', 'left');
		$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
		if ($id_cycle != '') {
			$this->db->where('cycle.id_cycle', $id_cycle);
		}
		
		$this->db->group_by('nom_mention');
		return $this->db->get('mention')->result();

	}

	public function ajax_fetch_parcours($id_cycle, $id_mention)
	{
		$this->db->join('mention', 'mention.id_mention = parcour.id_mention', 'left');
		$this->db->join('cycle_parcours', 'cycle_parcours.id_parcour = parcour.id_parcour', 'left');
		$this->db->join('cycle', 'cycle_parcours.id_cycle = cycle.id_cycle', 'left');
		$this->db->where('cycle.id_cycle', $id_cycle);
		$this->db->where('mention.id_mention', $id_mention);
		$this->db->group_by('nom_parcour');
		return $this->db->get('parcour')->result();

	}

	public function fetch_cycle($parcours)
	{
		$query = $this->db->query("SELECT * FROM cycle,cycle_parcours WHERE cycle_parcours.id_cycle=cycle.id_cycle AND cycle_parcours.id_parcours='$parcours'");
		$output = '<option value="">Choissisez un cycle</option>';
		foreach ($query->result() as $key) {
			$output .= '<option value="' . $key->id_cycle . '">' . $key->abreviation_cycle . '</option>';
		}
		return $output;
	}

	public function filtre_candidat($data, $statut, $html = TRUE)
	{
			
		$this->db->select('*')
				//->distinct('d.id_dossier')
		->from('candidat c')
		->join('dossier d', 'd.id_candidat=c.id_candidat')
		->join('paiement p', 'd.id_paiement=p.id_paiement')
		->join('mode_paiement mp', 'p.id_mode_paiement=mp.id_mode_paiement')
		->join('parcour_choisi pc', 'pc.id_dossier=d.id_dossier')
		->join('parcour pr', 'pr.id_parcour=pc.id_parcour')
		->join('cycle_parcours cp', 'cp.id_parcour=pr.id_parcour')
		->join('cycle cy', 'cy.id_cycle=cp.id_cycle')
		->join('mention mt', 'mt.id_mention=pr.id_mention')
		->join('lieu_depot ld', 'ld.id_lieu_depot=d.id_lieu_depot')
		->join('centre_examen ce', 'ce.id_centre_examen=d.id_centre_examen')
		->join('region_or ro', 'ro.id_reg_or=c.id_reg_or')
		->join('pays py', 'py.id_pays=ro.id_pays')
		->where('d.statut', $statut);

		if (isset($data['sexe']) && !empty($data['sexe'])) $this->db->where('c.sexe', $data['sexe']);
		if (isset($data['pays']) && !empty($data['pays'])) $this->db->where('py.id_pays', $data['pays']);
		if (isset($data['region']) && !empty($data['region'])) $this->db->where('ro.id_reg_or', $data['region']);
		if (isset($data['langue']) && !empty($data['langue'])) $this->db->where('d.langue_composition', $data['langue']);
		if (isset($data['lieu_depot']) && !empty($data['lieu_depot'])) $this->db->where('ld.id_lieu_depot', $data['lieu_depot']);
		if (isset($data['centre_examen']) && !empty($data['centre_examen'])) $this->db->where('ce.id_centre_examen', $data['centre_examen']);
		if (isset($data['mnt']) && !empty($data['mnt'])) $this->db->where('mt.id_mention', $data['mnt']);
		if (isset($data['parcours']) && !empty($data['parcours'])) $this->db->where('pr.id_parcour', $data['parcours']);
		if (isset($data['cyc']) && !empty($data['cyc'])) $this->db->where('cy.id_cycle', $data['cyc']);

		$this->db->group_by('d.id_dossier');
			//var_dump($this->db->get()->result()); die;
		$query = $this->db->get()->result();

		if ($html) {
			$output = '';
			$num = 1;
			foreach ($query as $i=>$key) {
				$output .= '<tr>
				<td>' . ($i+1) . '</td>
				<td class="text-center">
				<div class="form-check">
				<input class="form-check-input invalid_checkbox" type="checkbox" value="' . $key->id_candidat . '">
				</div>
				</td>
				<td>N° Transaction: <b> ' . $key->num_transaction . '</b><br>' . $key->nom_banque . '
				</td>
				<td> ' . $key->nom_candidat . ' </td>
				<td>' . $key->prenom_candidat . '</td>
				<td> ' . $key->sexe . '</td>
				<td> ' . $key->date_naiss . '</td>
				<td> ' . $key->sigle_mention . '</td>
				<td> ' . $key->nom_centre_examen . '</td>
				<td> ' . $key->nom_lieu_depot . '</td>
				</tr>';
			}
			return $output;
		} else {
			return $query;
		}
	}

	public function prints($statut)
	{
		return $this->db->select('*')
		->from('dossier')
		->where('dossier.statut', $statut)
		->join('candidat', 'dossier.id_candidat=candidat.id_candidat')
		->join('region_or', 'region_or.id_reg_or=candidat.id_reg_or')
		->join('pays', 'pays.id_pays=region_or.id_pays')
		->get()
		->result();
	}

}
