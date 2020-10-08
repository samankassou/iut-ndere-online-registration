<?php
defined('BASEPATH') OR exit('No direct script access allowed');


date_default_timezone_set('Africa/Douala');

class Statistiques extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('Admin_model', 'Admin');
		$this->load->library('form_validation');
		$this->load->helper('general_helper');
		$this->load->helper('assets_helper');
		$this->load->library('CI_PHPSpreadSheet');
		$this->load->helper('moment_helper');
		$this->load->model("Stats_model", "Stats");


		if (empty($this->session->email)){
			redirect('login/index');
		}
	}

	public function globales(){
		$regions = $this->Stats->noms_regions();// liste des regions
		$centre_exam = $this->Stats->noms_centre_exam();// liste des centres d'examen
		$lieu_depot = $this->Stats->noms_lieu_depot();// liste des lieux de depot


		$data['title'] = 'Statistiques';
		$data['js'] = base_url().'assets/js/stats.js';

		//Recuperation des candidats par sexe et par region
		//total par region
		foreach ($regions as $key =>$value) {
			$candidats_par_region[$value['nom_reg_or']] = $this->Stats->candidats_par_region($value['nom_reg_or']);
		}
		foreach ($regions as $key =>$value) {
			$candidats_m[$value['nom_reg_or']] = $this->Stats->candidats_par_region($value['nom_reg_or'], 'm');
		}
		foreach ($regions as $key =>$value) {
			$candidats_f[$value['nom_reg_or']] = $this->Stats->candidats_par_region($value['nom_reg_or'], 'f');
		}
		//total par region cycle dut
		foreach ($regions as $key =>$value) {
			$candidats_dut_par_region[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', 'DUT'));
		}
		//total par region cycle bts
		foreach ($regions as $key =>$value) {
			$candidats_bts_par_region[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', 'BTS'));
		}
		//total par region cycle litech
		foreach ($regions as $key =>$value) {
			$candidats_litech_par_region[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', 'LITECH'));
		}
		//Recuperation des candidats par sexe, cycle et par region
		//cycle DUT
		foreach ($regions as $key =>$value) {
			$candidats_m_dut[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'm', 'DUT'));
		}
		foreach ($regions as $key =>$value) {
			$candidats_f_dut[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'f', 'DUT'));
		}
		//cycle BTS
		foreach ($regions as $key =>$value) {
			$candidats_m_bts[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'm', 'BTS'));
		}
		foreach ($regions as $key =>$value) {
			$candidats_f_bts[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'f', 'BTS'));
		}
		//cycle LITECH
		foreach ($regions as $key =>$value) {
			$candidats_m_litech[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'm', 'LITECH'));
		}
		foreach ($regions as $key =>$value) {
			$candidats_f_litech[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'f', 'LITECH'));
		}


		//Recuperation des candidats par langue et par region
		//cycle DUT
		foreach ($regions as $key =>$value) {
			$candidats_fr_dut[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'm', 'DUT', 'Français'));
		}
		foreach ($regions as $key =>$value) {
			$candidats_en_dut[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'f', 'DUT', 'Anglais'));
		}
		//cycle BTS
		foreach ($regions as $key =>$value) {
			$candidats_fr_bts[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'm', 'BTS', 'Français'));
		}
		foreach ($regions as $key =>$value) {
			$candidats_en_bts[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'f', 'BTS', 'Anglais'));
		}


		//modification de '(Autre)' en 'Etranger'
		$candidats_par_region['Etranger'] = $candidats_par_region['(Autre)'];
		$candidats_dut_par_region['Etranger'] = $candidats_dut_par_region['(Autre)'];
		$candidats_bts_par_region['Etranger'] = $candidats_bts_par_region['(Autre)'];
		$candidats_litech_par_region['Etranger'] = $candidats_litech_par_region['(Autre)'];
		$candidats_m['Etranger'] = $candidats_m['(Autre)'];
		$candidats_f['Etranger'] = $candidats_f['(Autre)'];
		unset($candidats_par_region['(Autre)']);
		unset($candidats_dut_par_region['(Autre)']);
		unset($candidats_bts_par_region['(Autre)']);
		unset($candidats_litech_par_region['(Autre)']);
		unset($candidats_m['(Autre)']);
		unset($candidats_f['(Autre)']);

		$candidats_m_bts['Etranger'] = $candidats_m_bts['(Autre)'];
		$candidats_f_bts['Etranger'] = $candidats_f_bts['(Autre)'];
		unset($candidats_m_bts['(Autre)']);
		unset($candidats_f_bts['(Autre)']);

		$candidats_m_dut['Etranger'] = $candidats_m_dut['(Autre)'];
		$candidats_f_dut['Etranger'] = $candidats_f_dut['(Autre)'];
		unset($candidats_m_dut['(Autre)']);
		unset($candidats_f_dut['(Autre)']);

		$candidats_m_litech['Etranger'] = $candidats_m_litech['(Autre)'];
		$candidats_f_litech['Etranger'] = $candidats_f_litech['(Autre)'];
		unset($candidats_m_litech['(Autre)']);
		unset($candidats_f_litech['(Autre)']);

		$candidats_fr_dut['Etranger'] = $candidats_fr_dut['(Autre)'];
		$candidats_en_dut['Etranger'] = $candidats_en_dut['(Autre)'];
		unset($candidats_fr_dut['(Autre)']);
		unset($candidats_en_dut['(Autre)']);

		$candidats_fr_bts['Etranger'] = $candidats_fr_bts['(Autre)'];
		$candidats_en_bts['Etranger'] = $candidats_en_bts['(Autre)'];
		unset($candidats_fr_dut['(Autre)']);
		unset($candidats_en_dut['(Autre)']);

		//construction du tableau pour le diagramme(par cycle)
		//total
		$total_candidats = $this->Stats->count();
		foreach ($candidats_par_region as $key => $value) {
			if ($total_candidats == 0) {
				$arr_par_reg[] = ['label' => $key, 'y' => castNumberId($value/1, 2, 2)];
			}else{
				$arr_par_reg[] = ['label' => $key."(".castNumberId($value/$total_candidats*100, 2, 2)."%)", 'y' => castNumberId($value/$total_candidats*100, 2, 2)];
			}
			
		}
		$total_candidats_dut = count($this->Stats->count_total_cycle(array('abreviation_cycle' => 'DUT')));
		foreach ($candidats_dut_par_region as $key => $value) {
			if ($total_candidats_dut == 0) {
				$arr_dut_par_reg[] = ['label' => $key, 'y' => castNumberId($value/1, 2, 2)];
			}else{
				$arr_dut_par_reg[] = ['label' => $key."(".castNumberId($value/$total_candidats_dut*100, 2, 2)."%)", 'y' => castNumberId($value/$total_candidats_dut*100, 2, 2)];
			}
			
		}


		$total_candidats_bts = count($this->Stats->count_total_cycle(array('abreviation_cycle' => 'BTS')));
		foreach ($candidats_bts_par_region as $key => $value) {
			if ($total_candidats_bts == 0) {
				$arr_bts_par_reg[] = ['label' => $key, 'y' => castNumberId($value/1, 2, 2)];
			}else{
				$arr_bts_par_reg[] = ['label' => $key."(".castNumberId($value/$total_candidats_bts*100, 2, 2)."%)", 'y' => castNumberId($value/$total_candidats_bts*100, 2, 2)];
			}
			
		}

		$total_candidats_litech = count($this->Stats->count_total_cycle(array('abreviation_cycle' => 'LITECH')));
		foreach ($candidats_litech_par_region as $key => $value) {
			if ($total_candidats_litech == 0) {
				$arr_litech_par_reg[] = ['label' => $key, 'y' => castNumberId($value/1, 2, 2)];
			}else{
				$arr_litech_par_reg[] = ['label' => $key."(".castNumberId($value/$total_candidats_litech*100, 2, 2)."%)", 'y' => castNumberId($value/$total_candidats_litech*100, 2, 2)];
			}
			
		}
		//cycle dut
		foreach ($candidats_m_dut as $key => $value) {
			$arr_m_dut[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_f_dut as $key => $value) {
			$arr_f_dut[] = ['label' => $key, 'y' => $value];
		}
		//cycle bts
		foreach ($candidats_m_bts as $key => $value) {
			$arr_m_bts[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_f_bts as $key => $value) {
			$arr_f_bts[] = ['label' => $key, 'y' => $value];
		}
		//cycle litech
		foreach ($candidats_m_litech as $key => $value) {
			$arr_m_litech[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_f_litech as $key => $value) {
			$arr_f_litech[] = ['label' => $key, 'y' => $value];
		}

		//construction du tableau pour le diagramme(par langue de composition)
		//cycle dut
		foreach ($candidats_fr_dut as $key => $value) {
			$arr_fr_dut[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_en_dut as $key => $value) {
			$arr_en_dut[] = ['label' => $key, 'y' => $value];
		}
		//cycle bts
		foreach ($candidats_fr_bts as $key => $value) {
			$arr_fr_bts[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_en_bts as $key => $value) {
			$arr_en_bts[] = ['label' => $key, 'y' => $value];
		}



		//construction du tableau pour le diagramme(global)
		foreach ($candidats_m as $key => $value) {
			$arr_m[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_f as $key => $value) {
			$arr_f[] = ['label' => $key, 'y' => $value];
		}
		
		//Recuperation des candidats par sexe et par region
		//par centre d'examen et par cycle
		//cycle dut
		foreach ($centre_exam as $key =>$value) {
			$candidats_m_dut_centre_exam[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], 'm', 'DUT'));
		}
		foreach ($centre_exam as $key =>$value) {
			$candidats_f_dut_centre_exam[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], 'f', 'DUT'));
		}
		//construction du tableau pour le diagramme(centre d'examen cycle dut)
		foreach ($candidats_m_dut_centre_exam as $key => $value) {
			$arr_m_dut_centr_exam[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_f_dut_centre_exam as $key => $value) {
			$arr_f_dut_centr_exam[] = ['label' => $key, 'y' => $value];
		}
		//Recuperation des candidats par sexe et par region
		//par centre d'examen et par cycle
		//cycle bts
		$centre_exam_bts = $this->Stats->noms_centre_exam('BTS');
		foreach ($centre_exam_bts as $value) {
			$candidats_m_bts_centre_exam[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], 'm', 'BTS'));
		}
		foreach ($centre_exam_bts as $value) {
			$candidats_f_bts_centre_exam[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], 'f', 'BTS'));
		}

		//construction du tableau pour le diagramme(centre d'examen cycle bts)
		foreach ($candidats_m_bts_centre_exam as $key => $value) {
			$arr_m_bts_centr_exam[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_f_bts_centre_exam as $key => $value) {
			$arr_f_bts_centr_exam[] = ['label' => $key, 'y' => $value];
		}


		//Recuperation des candidats par sexe et par region
		//par lieu de depot et par cycle
		//cycle dut
		foreach ($lieu_depot as $key =>$value) {
			$candidats_m_dut_lieu[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], 'm', 'DUT'));
		}
		foreach ($lieu_depot as $key =>$value) {
			$candidats_f_dut_lieu[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], 'f', 'DUT'));
		}

		//construction du tableau pour le diagramme(lieu de depot et cycle dut)
		foreach ($candidats_m_dut_lieu as $key => $value) {
			$arr_m_dut_lieu_depot[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_f_dut_lieu as $key => $value) {
			$arr_f_dut_lieu_depot[] = ['label' => $key, 'y' => $value];
		}

		//par centre d'examen par langue de composition et par cycle
		foreach ($centre_exam as $key =>$value) {
			$candidats_dut_fr_centre_exam[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], '', 'DUT', 'Français'));
		}
		foreach ($centre_exam as $key =>$value) {
			$candidats_dut_en_centre_exam[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], '', 'DUT', 'Anglais'));
		}
		//construction du tableau pour le diagramme(centre d'examen cycle dut)
		foreach ($candidats_dut_fr_centre_exam as $key => $value) {
			$arr_dut_fr_centr_exam[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_dut_en_centre_exam as $key => $value) {
			$arr_dut_en_centr_exam[] = ['label' => $key, 'y' => $value];
		}
		//Recuperation des candidats par sexe et par region
		//par centre d'examen et par cycle
		//cycle bts
		$centre_exam_bts = $this->Stats->noms_centre_exam('BTS');
		foreach ($centre_exam_bts as $value) {
			$candidats_bts_fr_centre_exam[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], '', 'BTS', 'Français'));
		}
		foreach ($centre_exam_bts as $value) {
			$candidats_bts_en_centre_exam[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], '', 'BTS', 'Anglais'));
		}

		//construction du tableau pour le diagramme(centre d'examen cycle bts)
		foreach ($candidats_bts_fr_centre_exam as $key => $value) {
			$arr_bts_fr_centr_exam[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_bts_en_centre_exam as $key => $value) {
			$arr_bts_en_centr_exam[] = ['label' => $key, 'y' => $value];
		}


		//Recuperation des candidats par sexe et par region
		//par lieu de depot et par cycle
		//cycle bts
		foreach ($lieu_depot as $value) {
			$candidats_m_bts_lieu[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], 'm', 'BTS'));
		}
		foreach ($lieu_depot as $value) {
			$candidats_f_bts_lieu[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], 'f', 'BTS'));
		}
		//construction du tableau pour le diagramme(lieu de depot et cycle bts)
		foreach ($candidats_m_bts_lieu as $key => $value) {
			$arr_m_bts_lieu_depot[] = ['label' => $key, 'y' => $value];
		}
		foreach ($candidats_f_bts_lieu as $key => $value) {
			$arr_f_bts_lieu_depot[] = ['label' => $key, 'y' => $value];
		}

		//definitions de toutes les variables
		$data['total_candidats'] = $this->Stats->count();
		$data['total_candidats_dut'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => 'DUT')));
		$data['total_candidats_bts'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => 'BTS')));
		$data['total_candidats_litech'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => 'LITECH')));
		$data['candidats_par_region'] = $arr_par_reg;
		$data['candidats_dut_par_region'] = $arr_dut_par_reg;
		$data['candidats_bts_par_region'] = $arr_bts_par_reg;
		$data['candidats_litech_par_region'] = $arr_litech_par_reg;
		$data['candidats_masculin'] = $arr_m;
		$data['candidats_feminin'] = $arr_f;
		$data['candidats_masculin_dut'] = $arr_m_dut;
		$data['candidats_feminin_dut'] = $arr_f_dut;
		$data['candidats_masculin_bts'] = $arr_m_bts;
		$data['candidats_feminin_bts'] = $arr_f_bts;
		$data['candidats_fr_dut'] = $arr_fr_dut;
		$data['candidats_en_dut'] = $arr_en_dut;
		$data['candidats_fr_bts'] = $arr_fr_bts;
		$data['candidats_en_bts'] = $arr_en_bts;
		$data['candidats_dut_fr_centre_exam'] = $arr_dut_fr_centr_exam;
		$data['candidats_dut_en_centre_exam'] = $arr_dut_en_centr_exam;
		$data['candidats_bts_fr_centre_exam'] = $arr_bts_fr_centr_exam;
		$data['candidats_bts_en_centre_exam'] = $arr_bts_en_centr_exam;
		$data['candidats_masculin_litech'] = $arr_m_litech;
		$data['candidats_feminin_litech'] = $arr_f_litech;
		$data['candidats_masculin_dut_centre_exam'] = $arr_m_dut_centr_exam;
		$data['candidats_feminin_dut_centre_exam'] = $arr_f_dut_centr_exam;
		$data['candidats_masculin_bts_centre_exam'] = $arr_m_bts_centr_exam;
		$data['candidats_feminin_bts_centre_exam'] = $arr_f_bts_centr_exam;
		$data['candidats_masculin_dut_lieu'] = $arr_m_dut_lieu_depot;
		$data['candidats_feminin_dut_lieu'] = $arr_f_dut_lieu_depot;
		$data['candidats_masculin_bts_lieu'] = $arr_m_bts_lieu_depot;
		$data['candidats_feminin_bts_lieu'] = $arr_f_bts_lieu_depot;
		$data['stat_class'] = 'card-info';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/statistiques_view', $data);
		$this->load->view('admin/footer', $data);
	}

	public function par_cycle(){
	    $regions = $this->Stats->noms_regions();// liste des regions
        $centre_exam = $this->Stats->noms_centre_exam();// liste des centres d'examen
        $lieu_depot = $this->Stats->noms_lieu_depot();// liste des lieux de depot

        $data['title'] = 'Statistiques';
        $data['js'] = base_url().'assets/js/stats.js';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/stats_par_cycle_view', $data);
        $this->load->view('admin/footer', $data);
	}

	public function print_stat($type_stat = '', $cycle = ''){
		$regions = $this->Stats->noms_regions();
		$centre_exam = $this->Stats->noms_centre_exam();
		$lieu_depot = $this->Stats->noms_lieu_depot();

		if ($type_stat == 'globales') {
			
			$data['total_candidats'] = $this->Stats->count();
			$data['total_masculin'] = $this->Stats->count(array('sexe' => 'm'));
			$data['total_feminin'] = $this->Stats->count(array('sexe' => 'f'));
			foreach ($regions as $key =>$value) {
				$candidats[$value['nom_reg_or']] = $this->Stats->candidats_par_region($value['nom_reg_or']);
			}
			foreach ($regions as $key =>$value) {
				$candidats_m[$value['nom_reg_or']] = $this->Stats->candidats_par_region($value['nom_reg_or'], 'm');
			}
			foreach ($regions as $key =>$value) {
				$candidats_f[$value['nom_reg_or']] = $this->Stats->candidats_par_region($value['nom_reg_or'], 'f');
			}

			$candidats_m['Etranger'] = $candidats_m['(Autre)'];
			$candidats_f['Etranger'] = $candidats_f['(Autre)'];
			$candidats['Etranger'] = $candidats['(Autre)'];
			unset($candidats_m['(Autre)']);
			unset($candidats_f['(Autre)']);
			unset($candidats['(Autre)']);

			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_m as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_f as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}
			

			$nom = 'stats_globales_'.date('d_m_Y_H_i_s').'.pdf';
			$data['cdts'] = $tab;
			$html = $this->load->view('print_stat', $data, TRUE);

			require './application/libraries/html2pdf/autoload.php';

			$pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','fr');
			$pdf->setDefaultFont('helvetica');
			$pdf->WriteHTML($html);
			$pdf->Output(FCPATH.'assets/documents/stats/pdf/globales/'.$nom, 'FI');
		}elseif($type_stat == 'cycle'){
			$cycle = mb_strtoupper($cycle);
			//
			$data['total_candidats'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => $cycle)));
			$data['total_masculin'] =count( $this->Stats->count_total_cycle(array('sexe' => 'm', 'abreviation_cycle' => $cycle)));
			$data['total_feminin'] = count($this->Stats->count_total_cycle(array('sexe' => 'f', 'abreviation_cycle' => $cycle)));
			foreach ($regions as $key =>$value) {
				$candidats[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle));
			}
			foreach ($regions as $key =>$value) {
				$candidats_m[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'm', $cycle));
			}
			foreach ($regions as $key =>$value) {
				$candidats_f[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'f', $cycle));
			}

			$candidats_m['Etranger'] = $candidats_m['(Autre)'];
			$candidats_f['Etranger'] = $candidats_f['(Autre)'];
			$candidats['Etranger'] = $candidats['(Autre)'];
			unset($candidats_m['(Autre)']);
			unset($candidats_f['(Autre)']);
			unset($candidats['(Autre)']);

			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_m as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_f as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}

			$nom = 'statistiques_cycle_'.mb_strtolower($cycle).'_'.date('d_m_Y_H_i_s').'.pdf';
			$data['cycle'] = $cycle;
			$data['cdts'] = $tab;
			$html = $this->load->view('print_stat', $data, TRUE);

			require './application/libraries/html2pdf/autoload.php';

			$pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','fr');
			$pdf->setDefaultFont('helvetica');
			$pdf->WriteHTML($html);
			$pdf->Output(FCPATH.'assets/documents/stats/pdf/par_cycle/'.$nom, 'FI');
		}elseif($type_stat == 'lang'){
			$cycle = mb_strtoupper($cycle);
			//
			$data['total_candidats'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => $cycle)));
			//total_masculin == total_fr, total_feminin == total_en,
			$data['total_masculin'] =count( $this->Stats->count_total_cycle(array('langue_composition' => 'Français', 'abreviation_cycle' => $cycle)));
			$data['total_feminin'] = count($this->Stats->count_total_cycle(array('langue_composition' => 'Anglais', 'abreviation_cycle' => $cycle)));
			foreach ($regions as $key =>$value) {
				$candidats[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle));
			}
			foreach ($regions as $key =>$value) {
				$candidats_fr[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle, 'Français'));
			}
			foreach ($regions as $key =>$value) {
				$candidats_en[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle, 'Anglais'));
			}

			$candidats_fr['Etranger'] = $candidats_fr['(Autre)'];
			$candidats_en['Etranger'] = $candidats_en['(Autre)'];
			$candidats['Etranger'] = $candidats['(Autre)'];
			unset($candidats_fr['(Autre)']);
			unset($candidats_en['(Autre)']);
			unset($candidats['(Autre)']);

			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_fr as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_en as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}


			$nom = 'statistiques_par_langue_cycle_'.mb_strtolower($cycle).'_'.date('d_m_Y_H_i_s').'.pdf';
			$data['cycle'] = $cycle;
			$data['filtre'] = 'Langue de composition';
			$data['cdts'] = $tab;
			$html = $this->load->view('print_stat', $data, TRUE);

			require './application/libraries/html2pdf/autoload.php';

			$pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','fr');
			$pdf->setDefaultFont('helvetica');
			$pdf->WriteHTML($html);
			$pdf->Output(FCPATH.'assets/documents/stats/pdf/par_langue/'.$nom, 'FI');
		}elseif ($type_stat == 'centre_exam') {
			$cycle = mb_strtoupper($cycle);
			//
			$data['total_candidats'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => $cycle)));
			$data['total_masculin'] =count( $this->Stats->count_total_cycle(array('sexe' => 'm', 'abreviation_cycle' => $cycle)));
			$data['total_feminin'] = count($this->Stats->count_total_cycle(array('sexe' => 'f', 'abreviation_cycle' => $cycle)));
			foreach ($centre_exam as $key =>$value) {
				$candidats[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], '', $cycle));
			}
			foreach ($centre_exam as $key =>$value) {
				$candidats_m[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], 'm', $cycle));
			}
			foreach ($centre_exam as $key =>$value) {
				$candidats_f[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], 'f', $cycle));
			}


			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_m as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_f as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}


			$nom = 'statistiques_par_centre_examen_cycle_'.mb_strtolower($cycle).'_'.date('d_m_Y_H_i_s').'.pdf';
			$data['cycle'] = $cycle;
			$data['filtre'] = 'Centre d\'examen';
			$data['cdts'] = $tab;
			$html = $this->load->view('print_stat', $data, TRUE);

			require './application/libraries/html2pdf/autoload.php';

			$pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','fr');
			$pdf->setDefaultFont('helvetica');
			$pdf->WriteHTML($html);
			$pdf->Output(FCPATH.'assets/documents/stats/pdf/par_centre_exam/'.$nom, 'FI');
		}elseif ($type_stat == 'lieu_depot') {
			$cycle = mb_strtoupper($cycle);
			//
			$data['total_candidats'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => $cycle)));
			$data['total_masculin'] =count( $this->Stats->count_total_cycle(array('sexe' => 'm', 'abreviation_cycle' => $cycle)));
			$data['total_feminin'] = count($this->Stats->count_total_cycle(array('sexe' => 'f', 'abreviation_cycle' => $cycle)));
			foreach ($lieu_depot as $key =>$value) {
				$candidats[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], '', $cycle));
			}
			foreach ($lieu_depot as $key =>$value) {
				$candidats_m[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], 'm', $cycle));
			}
			foreach ($lieu_depot as $key =>$value) {
				$candidats_f[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], 'f', $cycle));
			}


			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_m as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_f as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}
			

			$nom = 'statistiques_par_lieu_depot_cycle_'.mb_strtolower($cycle).'_'.date('d_m_Y_H_i_s').'.pdf';
			$data['cycle'] = $cycle;
			$data['filtre'] = 'Lieux de depot';
			$data['cdts'] = $tab;
			$html = $this->load->view('print_stat', $data, TRUE);

			require './application/libraries/html2pdf/autoload.php';

			$pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','fr');
			$pdf->setDefaultFont('helvetica');
			$pdf->WriteHTML($html);
			$pdf->Output(FCPATH.'assets/documents/stats/pdf/par_lieux_depot/'.$nom, 'FI');
		}
		else{
			show_404();
		}
		
	}

	public function print_excel($type_stat = '', $cycle = ''){
		$regions = $this->Stats->noms_regions();
		$centre_exam = $this->Stats->noms_centre_exam();
		$lieu_depot = $this->Stats->noms_lieu_depot();

		$objPHPExcel = new CI_PHPSpreadSheet();


			$objPHPExcel->getProperties()->setCreator("IUT de Ngaoundéré");
			$objPHPExcel->getProperties()->setLastModifiedBy("IUT de Ngaoundéré");
			$objPHPExcel->getProperties()->setTitle("Statistiques des candidats aux concours");
			$objPHPExcel->getProperties()->setSubject("Statistiques des candidats aux concours");
			$objPHPExcel->getProperties()->setDescription("Statistiques des candidats aux concours");

			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->mergeCells('G2:J2');
			$objPHPExcel->getActiveSheet()->SetCellValue('G2', 'CONCOURS D\'ENTREE A L\'IUT DE NGAOUNDERE');

		if ($type_stat == 'globales') {
			
			$total_candidats = $this->Stats->count();
			$total_masculin = $this->Stats->count(array('sexe' => 'm'));
			$total_feminin = $this->Stats->count(array('sexe' => 'f'));
			foreach ($regions as $key =>$value) {
				$candidats[$value['nom_reg_or']] = $this->Stats->candidats_par_region($value['nom_reg_or']);
			}
			foreach ($regions as $key =>$value) {
				$candidats_m[$value['nom_reg_or']] = $this->Stats->candidats_par_region($value['nom_reg_or'], 'm');
			}
			foreach ($regions as $key =>$value) {
				$candidats_f[$value['nom_reg_or']] = $this->Stats->candidats_par_region($value['nom_reg_or'], 'f');
			}

			$candidats_m['Etranger'] = $candidats_m['(Autre)'];
			$candidats_f['Etranger'] = $candidats_f['(Autre)'];
			$candidats['Etranger'] = $candidats['(Autre)'];
			unset($candidats_m['(Autre)']);
			unset($candidats_f['(Autre)']);
			unset($candidats['(Autre)']);

			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_m as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_f as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}
			

			$nom = 'statistiques_globales_'.date('d_m_Y_H_i_s').'';

			$objPHPExcel->getActiveSheet()->mergeCells('G5:J5');
			$objPHPExcel->getActiveSheet()->SetCellValue('G5', 'STATISTIQUES GLOBALES DES CANDIDATS');
			$objPHPExcel->getActiveSheet()->mergeCells('G7:H7');
			$objPHPExcel->getActiveSheet()->SetCellValue('G7', 'EFFECTIF TOTAL: '.$total_candidats);
			$objPHPExcel->getActiveSheet()->mergeCells('F12:L13');
			$objPHPExcel->getActiveSheet()->SetCellValue('F12', 'INSCRITS');
			$objPHPExcel->getActiveSheet()->mergeCells('F14:F15');
			$objPHPExcel->getActiveSheet()->SetCellValue('F14', 'REGION');
			$objPHPExcel->getActiveSheet()->mergeCells('G14:G15');
			$objPHPExcel->getActiveSheet()->SetCellValue('G14', 'TOTAL');
			$objPHPExcel->getActiveSheet()->mergeCells('H14:H15');
			$objPHPExcel->getActiveSheet()->SetCellValue('H14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('I14:I15');
			$objPHPExcel->getActiveSheet()->SetCellValue('I14', 'FILLES');
			$objPHPExcel->getActiveSheet()->mergeCells('J14:J15');
			$objPHPExcel->getActiveSheet()->SetCellValue('J14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('K14:K15');
			$objPHPExcel->getActiveSheet()->SetCellValue('K14', 'GARCONS');
			$objPHPExcel->getActiveSheet()->mergeCells('L14:L15');
			$objPHPExcel->getActiveSheet()->SetCellValue('L14', '%');

            // centrage des cellules

			$horizontal = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
			$vertical = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER;
			$objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getAlignment()->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

            // mise en forme des cellules : mise en gras des entêtes
			$styleArray = array( 'font' => array( 'bold' => true) ); $size = 12;

			$objPHPExcel->getActiveSheet()->getStyle('G2')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G5')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$styleArray = array(
				'borders' => array(
					'allBorders' => array(
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
						'color' => array('argb' => '00000000'),
					),
				),
			);

                // définition des longueurs des cellules
			$lgCell1 = 30; $lgCell2 = 4; $lgCell4 = 5; $lgCell3 = 15; $htCell1 = 10;
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth($lgCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth($htCell1);

			$objPHPExcel->getActiveSheet()->getStyle('F12:L15')->applyFromArray($styleArray);
			
			$row = 16;

			

			foreach ($tab as $key => $value)
			{
				$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, $key)
				->setCellValueExplicit('G'.$row, $value['total'], 'n')
				->setCellValue('H'.$row, number_format(($value['total'] == 0)?0.00:($value['total']/$total_candidats*100), 2, ",", " "))
				->setCellValueExplicit('I'.$row, $value['total_f'], 'n')
				->setCellValue('J'.$row, number_format(($value['total_f'] == 0)?0.00:($value['total_f']/$total_feminin*100), 2, ",", " "))
				->setCellValueExplicit('K'.$row, $value['total_m'], 'n')
				->setCellValue('L'.$row, number_format(($value['total_m'] == 0)?0.00:($value['total_m']/$total_masculin*100), 2, ",", " "));

				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$row++;
			}

			$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, "TOTAL")
				->setCellValueExplicit('G'.$row, $total_candidats, 'n')
				->setCellValue('H'.$row, "100")
				->setCellValueExplicit('I'.$row, $total_feminin, 'n')
				->setCellValue('J'.$row, "100")
				->setCellValueExplicit('K'.$row, $total_masculin, 'n')
				->setCellValue('L'.$row, "100");
				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
			$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
			
		$objPHPExcel->getActiveSheet()->getStyle('F12:L'.$row)->applyFromArray($styleArray);


			$objWriter = $objPHPExcel->writer();
			$objWriter->setOffice2003Compatibility(true);
			$objPHPExcel->getActiveSheet()->setTitle('STATISTIQUES GLOBALES');

			$objWriter->save(FCPATH.'assets/documents/stats/excel/globales/'.$nom.'.xlsx');
			redirect('file_browser/index/assets/documents/stats/excel/globales/'.$nom.'.xlsx');

		}elseif($type_stat == 'cycle'){
			$cycle = mb_strtoupper($cycle);
			//
			$data['total_candidats'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => $cycle)));
			$data['total_masculin'] =count( $this->Stats->count_total_cycle(array('sexe' => 'm', 'abreviation_cycle' => $cycle)));
			$data['total_feminin'] = count($this->Stats->count_total_cycle(array('sexe' => 'f', 'abreviation_cycle' => $cycle)));
			foreach ($regions as $key =>$value) {
				$candidats[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle));
			}
			foreach ($regions as $key =>$value) {
				$candidats_m[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'm', $cycle));
			}
			foreach ($regions as $key =>$value) {
				$candidats_f[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], 'f', $cycle));
			}

			$candidats_m['Etranger'] = $candidats_m['(Autre)'];
			$candidats_f['Etranger'] = $candidats_f['(Autre)'];
			$candidats['Etranger'] = $candidats['(Autre)'];
			unset($candidats_m['(Autre)']);
			unset($candidats_f['(Autre)']);
			unset($candidats['(Autre)']);

			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_m as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_f as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}

			$nom = 'statistiques_cycle_'.mb_strtolower($cycle).'_'.date('d_m_Y_H_i_s').'';
			
			$objPHPExcel->getActiveSheet()->mergeCells('G5:J5');
			$objPHPExcel->getActiveSheet()->SetCellValue('G5', 'STATISTIQUES DES CANDIDATS PAR CYCLE');
			$objPHPExcel->getActiveSheet()->mergeCells('G7:H7');
			$objPHPExcel->getActiveSheet()->mergeCells('G9:H9');
			$objPHPExcel->getActiveSheet()->SetCellValue('G7', 'EFFECTIF: '.$data['total_candidats']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G9', 'CYCLE: '.$cycle);
			$objPHPExcel->getActiveSheet()->mergeCells('F12:L13');
			$objPHPExcel->getActiveSheet()->SetCellValue('F12', 'INSCRITS');
			$objPHPExcel->getActiveSheet()->mergeCells('F14:F15');
			$objPHPExcel->getActiveSheet()->SetCellValue('F14', 'REGION');
			$objPHPExcel->getActiveSheet()->mergeCells('G14:G15');
			$objPHPExcel->getActiveSheet()->SetCellValue('G14', 'TOTAL');
			$objPHPExcel->getActiveSheet()->mergeCells('H14:H15');
			$objPHPExcel->getActiveSheet()->SetCellValue('H14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('I14:I15');
			$objPHPExcel->getActiveSheet()->SetCellValue('I14', 'FILLES');
			$objPHPExcel->getActiveSheet()->mergeCells('J14:J15');
			$objPHPExcel->getActiveSheet()->SetCellValue('J14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('K14:K15');
			$objPHPExcel->getActiveSheet()->SetCellValue('K14', 'GARCONS');
			$objPHPExcel->getActiveSheet()->mergeCells('L14:L15');
			$objPHPExcel->getActiveSheet()->SetCellValue('L14', '%');

            // centrage des cellules

			$horizontal = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
			$vertical = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER;
			$objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getAlignment()->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G9')->getAlignment()->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

            // mise en forme des cellules : mise en gras des entêtes
			$styleArray = array( 'font' => array( 'bold' => true) ); $size = 12;

			$objPHPExcel->getActiveSheet()->getStyle('G2')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G5')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G9')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$styleArray = array(
				'borders' => array(
					'allBorders' => array(
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
						'color' => array('argb' => '00000000'),
					),
				),
			);

                // définition des longueurs des cellules
			$lgCell1 = 30; $lgCell2 = 4; $lgCell4 = 5; $lgCell3 = 15; $htCell1 = 10;
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth($lgCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth($htCell1);

			$objPHPExcel->getActiveSheet()->getStyle('F12:L15')->applyFromArray($styleArray);
			
			$row = 16;

			

			foreach ($tab as $key => $value)
			{
				$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, $key)
				->setCellValueExplicit('G'.$row, $value['total'], 'n')
				->setCellValue('H'.$row, number_format(($value['total'] == 0)?0.00:($value['total']/$data['total_candidats']*100), 2, ",", " "))
				->setCellValueExplicit('I'.$row, $value['total_f'], 'n')
				->setCellValue('J'.$row, number_format(($value['total_f'] == 0)?0.00:($value['total_f']/$data['total_feminin']*100), 2, ",", " "))
				->setCellValueExplicit('K'.$row, $value['total_m'], 'n')
				->setCellValue('L'.$row, number_format(($value['total_m'] == 0)?0.00:($value['total_m']/$data['total_masculin']*100), 2, ",", " "));

				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$row++;
			}

			$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, "TOTAL")
				->setCellValueExplicit('G'.$row, $data['total_candidats'], 'n')
				->setCellValue('H'.$row, "100")
				->setCellValueExplicit('I'.$row, $data['total_feminin'], 'n')
				->setCellValue('J'.$row, "100")
				->setCellValueExplicit('K'.$row, $data['total_masculin'], 'n')
				->setCellValue('L'.$row, "100");
				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
			$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
			
		$objPHPExcel->getActiveSheet()->getStyle('F12:L'.$row)->applyFromArray($styleArray);


			$objWriter = $objPHPExcel->writer();
			$objWriter->setOffice2003Compatibility(true);
			$objPHPExcel->getActiveSheet()->setTitle('STATISTIQUES CYCLE '.$cycle);

			$objWriter->save(FCPATH.'assets/documents/stats/excel/par_cycle/'.$nom.'.xlsx');
			redirect('file_browser/index/assets/documents/stats/excel/par_cycle/'.$nom.'.xlsx');

			
		}elseif($type_stat == 'lang'){
			$cycle = mb_strtoupper($cycle);
			//
			$data['total_candidats'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => $cycle)));
			//total_masculin == total_fr, total_feminin == total_en,
			$data['total_masculin'] =count( $this->Stats->count_total_cycle(array('langue_composition' => 'Français', 'abreviation_cycle' => $cycle)));
			$data['total_feminin'] = count($this->Stats->count_total_cycle(array('langue_composition' => 'Anglais', 'abreviation_cycle' => $cycle)));
			foreach ($regions as $key =>$value) {
				$candidats[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle));
			}
			foreach ($regions as $key =>$value) {
				$candidats_fr[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle, 'Français'));
			}
			foreach ($regions as $key =>$value) {
				$candidats_en[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle, 'Anglais'));
			}

			$candidats_fr['Etranger'] = $candidats_fr['(Autre)'];
			$candidats_en['Etranger'] = $candidats_en['(Autre)'];
			$candidats['Etranger'] = $candidats['(Autre)'];
			unset($candidats_fr['(Autre)']);
			unset($candidats_en['(Autre)']);
			unset($candidats['(Autre)']);

			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_fr as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_en as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}


			$nom = 'statistiques_par_langue_cycle_'.mb_strtolower($cycle).'_'.date('d_m_Y_H_i_s').'';
			
			$objPHPExcel->getActiveSheet()->mergeCells('G5:J5');
			$objPHPExcel->getActiveSheet()->SetCellValue('G5', 'STATISTIQUES DES CANDIDATS PAR LANGUE');
			$objPHPExcel->getActiveSheet()->mergeCells('G7:H7');
			$objPHPExcel->getActiveSheet()->mergeCells('G9:H9');
			$objPHPExcel->getActiveSheet()->SetCellValue('G7', 'EFFECTIF: '.$data['total_candidats']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G9', 'CYCLE: '.$cycle);
			$objPHPExcel->getActiveSheet()->mergeCells('F12:L13');
			$objPHPExcel->getActiveSheet()->SetCellValue('F12', 'INSCRITS');
			$objPHPExcel->getActiveSheet()->mergeCells('F14:F15');
			$objPHPExcel->getActiveSheet()->SetCellValue('F14', 'REGION');
			$objPHPExcel->getActiveSheet()->mergeCells('G14:G15');
			$objPHPExcel->getActiveSheet()->SetCellValue('G14', 'TOTAL');
			$objPHPExcel->getActiveSheet()->mergeCells('H14:H15');
			$objPHPExcel->getActiveSheet()->SetCellValue('H14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('I14:I15');
			$objPHPExcel->getActiveSheet()->SetCellValue('I14', 'ANGLAIS');
			$objPHPExcel->getActiveSheet()->mergeCells('J14:J15');
			$objPHPExcel->getActiveSheet()->SetCellValue('J14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('K14:K15');
			$objPHPExcel->getActiveSheet()->SetCellValue('K14', 'FRANCAIS');
			$objPHPExcel->getActiveSheet()->mergeCells('L14:L15');
			$objPHPExcel->getActiveSheet()->SetCellValue('L14', '%');

            // centrage des cellules

			$horizontal = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
			$vertical = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER;
			$objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getAlignment()->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G9')->getAlignment()->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

            // mise en forme des cellules : mise en gras des entêtes
			$styleArray = array( 'font' => array( 'bold' => true) ); $size = 12;

			$objPHPExcel->getActiveSheet()->getStyle('G2')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G5')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G9')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$styleArray = array(
				'borders' => array(
					'allBorders' => array(
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
						'color' => array('argb' => '00000000'),
					),
				),
			);

                // définition des longueurs des cellules
			$lgCell1 = 30; $lgCell2 = 4; $lgCell4 = 5; $lgCell3 = 15; $htCell1 = 10;
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth($lgCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth($htCell1);

			$objPHPExcel->getActiveSheet()->getStyle('F12:L15')->applyFromArray($styleArray);
			
			$row = 16;

			

			foreach ($tab as $key => $value)
			{
				$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, $key)
				->setCellValueExplicit('G'.$row, $value['total'], 'n')
				->setCellValue('H'.$row, number_format(($value['total'] == 0)?0.00:($value['total']/$data['total_candidats']*100), 2, ",", " "))
				->setCellValueExplicit('I'.$row, $value['total_f'], 'n')
				->setCellValue('J'.$row, number_format(($value['total_f'] == 0)?0.00:($value['total_f']/$data['total_feminin']*100), 2, ",", " "))
				->setCellValueExplicit('K'.$row, $value['total_m'], 'n')
				->setCellValue('L'.$row, number_format(($value['total_m'] == 0)?0.00:($value['total_m']/$data['total_masculin']*100), 2, ",", " "));

				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$row++;
			}

			$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, "TOTAL")
				->setCellValueExplicit('G'.$row, $data['total_candidats'], 'n')
				->setCellValue('H'.$row, "100")
				->setCellValueExplicit('I'.$row, $data['total_feminin'], 'n')
				->setCellValue('J'.$row, "100")
				->setCellValueExplicit('K'.$row, $data['total_masculin'], 'n')
				->setCellValue('L'.$row, "100");
				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
			$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
			
		$objPHPExcel->getActiveSheet()->getStyle('F12:L'.$row)->applyFromArray($styleArray);


			$objWriter = $objPHPExcel->writer();
			$objWriter->setOffice2003Compatibility(true);
			$objPHPExcel->getActiveSheet()->setTitle('STATISTIQUES PAR LANGUE');

			$objWriter->save(FCPATH.'assets/documents/stats/excel/par_langue/'.$nom.'.xlsx');
			redirect('file_browser/index/assets/documents/stats/excel/par_langue/'.$nom.'.xlsx');

		}elseif ($type_stat == 'centre_exam') {
			$cycle = mb_strtoupper($cycle);
			//
			$data['total_candidats'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => $cycle)));
			$data['total_masculin'] =count( $this->Stats->count_total_cycle(array('sexe' => 'm', 'abreviation_cycle' => $cycle)));
			$data['total_feminin'] = count($this->Stats->count_total_cycle(array('sexe' => 'f', 'abreviation_cycle' => $cycle)));
			foreach ($centre_exam as $key =>$value) {
				$candidats[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], '', $cycle));
			}
			foreach ($centre_exam as $key =>$value) {
				$candidats_m[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], 'm', $cycle));
			}
			foreach ($centre_exam as $key =>$value) {
				$candidats_f[$value['nom_centre_examen']] = count($this->Stats->count_total_cycle_centre_exam($value['nom_centre_examen'], 'f', $cycle));
			}


			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_m as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_f as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}


			$nom = 'statistiques_par_centre_examen_cycle_'.mb_strtolower($cycle).'_'.date('d_m_Y_H_i_s').'.pdf';
			
$cycle = mb_strtoupper($cycle);
			//
			$data['total_candidats'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => $cycle)));
			//total_masculin == total_fr, total_feminin == total_en,
			$data['total_masculin'] =count( $this->Stats->count_total_cycle(array('langue_composition' => 'Français', 'abreviation_cycle' => $cycle)));
			$data['total_feminin'] = count($this->Stats->count_total_cycle(array('langue_composition' => 'Anglais', 'abreviation_cycle' => $cycle)));
			foreach ($regions as $key =>$value) {
				$candidats[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle));
			}
			foreach ($regions as $key =>$value) {
				$candidats_fr[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle, 'Français'));
			}
			foreach ($regions as $key =>$value) {
				$candidats_en[$value['nom_reg_or']] = count($this->Stats->candidats_par_region($value['nom_reg_or'], '', $cycle, 'Anglais'));
			}

			$candidats_fr['Etranger'] = $candidats_fr['(Autre)'];
			$candidats_en['Etranger'] = $candidats_en['(Autre)'];
			$candidats['Etranger'] = $candidats['(Autre)'];
			unset($candidats_fr['(Autre)']);
			unset($candidats_en['(Autre)']);
			unset($candidats['(Autre)']);

			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_fr as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_en as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}


			$nom = 'statistiques_par_centre_examen_cycle_'.mb_strtolower($cycle).'_'.date('d_m_Y_H_i_s').'';
			
			$objPHPExcel->getActiveSheet()->mergeCells('F5:J5');
			$objPHPExcel->getActiveSheet()->SetCellValue('F5', 'STATISTIQUES DES CANDIDATS PAR CENTRE D\'EXAMEN');
			$objPHPExcel->getActiveSheet()->mergeCells('G7:H7');
			$objPHPExcel->getActiveSheet()->mergeCells('G9:H9');
			$objPHPExcel->getActiveSheet()->SetCellValue('G7', 'EFFECTIF: '.$data['total_candidats']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G9', 'CYCLE: '.$cycle);
			$objPHPExcel->getActiveSheet()->mergeCells('F12:L13');
			$objPHPExcel->getActiveSheet()->SetCellValue('F12', 'INSCRITS');
			$objPHPExcel->getActiveSheet()->mergeCells('F14:F15');
			$objPHPExcel->getActiveSheet()->SetCellValue('F14', 'CENTRE');
			$objPHPExcel->getActiveSheet()->mergeCells('G14:G15');
			$objPHPExcel->getActiveSheet()->SetCellValue('G14', 'TOTAL');
			$objPHPExcel->getActiveSheet()->mergeCells('H14:H15');
			$objPHPExcel->getActiveSheet()->SetCellValue('H14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('I14:I15');
			$objPHPExcel->getActiveSheet()->SetCellValue('I14', 'FILLES');
			$objPHPExcel->getActiveSheet()->mergeCells('J14:J15');
			$objPHPExcel->getActiveSheet()->SetCellValue('J14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('K14:K15');
			$objPHPExcel->getActiveSheet()->SetCellValue('K14', 'GARCONS');
			$objPHPExcel->getActiveSheet()->mergeCells('L14:L15');
			$objPHPExcel->getActiveSheet()->SetCellValue('L14', '%');

            // centrage des cellules

			$horizontal = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
			$vertical = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER;
			$objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F5')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getAlignment()->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G9')->getAlignment()->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

            // mise en forme des cellules : mise en gras des entêtes
			$styleArray = array( 'font' => array( 'bold' => true) ); $size = 12;

			$objPHPExcel->getActiveSheet()->getStyle('G2')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F5')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G9')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$styleArray = array(
				'borders' => array(
					'allBorders' => array(
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
						'color' => array('argb' => '00000000'),
					),
				),
			);

                // définition des longueurs des cellules
			$lgCell1 = 30; $lgCell2 = 4; $lgCell4 = 5; $lgCell3 = 15; $htCell1 = 10;
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth($lgCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth($htCell1);

			$objPHPExcel->getActiveSheet()->getStyle('F12:L15')->applyFromArray($styleArray);
			
			$row = 16;

			

			foreach ($tab as $key => $value)
			{
				$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, $key)
				->setCellValueExplicit('G'.$row, $value['total'], 'n')
				->setCellValue('H'.$row, number_format(($value['total'] == 0)?0.00:($value['total']/$data['total_candidats']*100), 2, ",", " "))
				->setCellValueExplicit('I'.$row, $value['total_f'], 'n')
				->setCellValue('J'.$row, number_format(($value['total_f'] == 0)?0.00:($value['total_f']/$data['total_feminin']*100), 2, ",", " "))
				->setCellValueExplicit('K'.$row, $value['total_m'], 'n')
				->setCellValue('L'.$row, number_format(($value['total_m'] == 0)?0.00:($value['total_m']/$data['total_masculin']*100), 2, ",", " "));

				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$row++;
			}

			$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, "TOTAL")
				->setCellValueExplicit('G'.$row, $data['total_candidats'], 'n')
				->setCellValue('H'.$row, "100")
				->setCellValueExplicit('I'.$row, $data['total_feminin'], 'n')
				->setCellValue('J'.$row, "100")
				->setCellValueExplicit('K'.$row, $data['total_masculin'], 'n')
				->setCellValue('L'.$row, "100");
				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
			$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
			
		$objPHPExcel->getActiveSheet()->getStyle('F12:L'.$row)->applyFromArray($styleArray);


			$objWriter = $objPHPExcel->writer();
			$objWriter->setOffice2003Compatibility(true);
			$objPHPExcel->getActiveSheet()->setTitle('STATISTIQUES PAR CENTRE');

			$objWriter->save(FCPATH.'assets/documents/stats/excel/par_centre_exam/'.$nom.'.xlsx');
			redirect('file_browser/index/assets/documents/stats/excel/par_centre_exam/'.$nom.'.xlsx');


			
		}elseif ($type_stat == 'lieu_depot') {
			$cycle = mb_strtoupper($cycle);
			//
			$data['total_candidats'] = count($this->Stats->count_total_cycle(array('abreviation_cycle' => $cycle)));
			$data['total_masculin'] =count( $this->Stats->count_total_cycle(array('sexe' => 'm', 'abreviation_cycle' => $cycle)));
			$data['total_feminin'] = count($this->Stats->count_total_cycle(array('sexe' => 'f', 'abreviation_cycle' => $cycle)));
			foreach ($lieu_depot as $key =>$value) {
				$candidats[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], '', $cycle));
			}
			foreach ($lieu_depot as $key =>$value) {
				$candidats_m[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], 'm', $cycle));
			}
			foreach ($lieu_depot as $key =>$value) {
				$candidats_f[$value['abrev_lieu_depot']] = count($this->Stats->count_total_cycle_lieu_depot($value['abrev_lieu_depot'], 'f', $cycle));
			}


			foreach ($candidats as $key => $value) {
				$tab[$key] = array('total' => $value, 'total_m' => '', 'total_f' => '');
			}

			foreach ($candidats_m as $key => $value) {
				$tab[$key]['total_m'] = $value;
			}

			foreach ($candidats_f as $key => $value) {
				$tab[$key]['total_f'] = $value;
			}
			

			$nom = 'statistiques_par_lieu_depot_cycle_'.mb_strtolower($cycle).'_'.date('d_m_Y_H_i_s').'';
			

			$objPHPExcel->getActiveSheet()->mergeCells('F5:J5');
			$objPHPExcel->getActiveSheet()->SetCellValue('F5', 'STATISTIQUES DES CANDIDATS PAR LIEUX DEPOT');
			$objPHPExcel->getActiveSheet()->mergeCells('G7:H7');
			$objPHPExcel->getActiveSheet()->mergeCells('G9:H9');
			$objPHPExcel->getActiveSheet()->SetCellValue('G7', 'EFFECTIF: '.$data['total_candidats']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G9', 'CYCLE: '.$cycle);
			$objPHPExcel->getActiveSheet()->mergeCells('F12:L13');
			$objPHPExcel->getActiveSheet()->SetCellValue('F12', 'INSCRITS');
			$objPHPExcel->getActiveSheet()->mergeCells('F14:F15');
			$objPHPExcel->getActiveSheet()->SetCellValue('F14', 'LIEU DEPOT');
			$objPHPExcel->getActiveSheet()->mergeCells('G14:G15');
			$objPHPExcel->getActiveSheet()->SetCellValue('G14', 'TOTAL');
			$objPHPExcel->getActiveSheet()->mergeCells('H14:H15');
			$objPHPExcel->getActiveSheet()->SetCellValue('H14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('I14:I15');
			$objPHPExcel->getActiveSheet()->SetCellValue('I14', 'FILLES');
			$objPHPExcel->getActiveSheet()->mergeCells('J14:J15');
			$objPHPExcel->getActiveSheet()->SetCellValue('J14', '%');
			$objPHPExcel->getActiveSheet()->mergeCells('K14:K15');
			$objPHPExcel->getActiveSheet()->SetCellValue('K14', 'GARCONS');
			$objPHPExcel->getActiveSheet()->mergeCells('L14:L15');
			$objPHPExcel->getActiveSheet()->SetCellValue('L14', '%');

            // centrage des cellules

			$horizontal = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
			$vertical = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER;
			$objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F5')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getAlignment()->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('G9')->getAlignment()->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getAlignment()->setHorizontal($horizontal)->setVertical($vertical);

            // mise en forme des cellules : mise en gras des entêtes
			$styleArray = array( 'font' => array( 'bold' => true) ); $size = 12;

			$objPHPExcel->getActiveSheet()->getStyle('G2')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F5')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G7')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G9')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F12')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);

			$objPHPExcel->getActiveSheet()->getStyle('G14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('H14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('I14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('J14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('K14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('L14')->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
			$styleArray = array(
				'borders' => array(
					'allBorders' => array(
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
						'color' => array('argb' => '00000000'),
					),
				),
			);

                // définition des longueurs des cellules
			$lgCell1 = 30; $lgCell2 = 4; $lgCell4 = 5; $lgCell3 = 15; $htCell1 = 10;
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth($lgCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth($htCell1);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth($lgCell3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth($htCell1);

			$objPHPExcel->getActiveSheet()->getStyle('F12:L15')->applyFromArray($styleArray);
			
			$row = 16;

			

			foreach ($tab as $key => $value)
			{
				$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, $key)
				->setCellValueExplicit('G'.$row, $value['total'], 'n')
				->setCellValue('H'.$row, number_format(($value['total'] == 0)?0.00:($value['total']/$data['total_candidats']*100), 2, ",", " "))
				->setCellValueExplicit('I'.$row, $value['total_f'], 'n')
				->setCellValue('J'.$row, number_format(($value['total_f'] == 0)?0.00:($value['total_f']/$data['total_feminin']*100), 2, ",", " "))
				->setCellValueExplicit('K'.$row, $value['total_m'], 'n')
				->setCellValue('L'.$row, number_format(($value['total_m'] == 0)?0.00:($value['total_m']/$data['total_masculin']*100), 2, ",", " "));

				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$row++;
			}

			$objPHPExcel->getActiveSheet()
				->setCellValue('F'.$row, "TOTAL")
				->setCellValueExplicit('G'.$row, $data['total_candidats'], 'n')
				->setCellValue('H'.$row, "100")
				->setCellValueExplicit('I'.$row, $data['total_feminin'], 'n')
				->setCellValue('J'.$row, "100")
				->setCellValueExplicit('K'.$row, $data['total_masculin'], 'n')
				->setCellValue('L'.$row, "100");
				$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('I'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$row)->getFont()->setSize($size)->setName('Times New Roman');
				$objPHPExcel->getActiveSheet()->getStyle('K'.$row)->getFont()->setSize($size)->setName('Times New Roman')->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->getFont()->setSize($size)->setName('Times New Roman');
			$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
			
		$objPHPExcel->getActiveSheet()->getStyle('F12:L'.$row)->applyFromArray($styleArray);


			$objWriter = $objPHPExcel->writer();
			$objWriter->setOffice2003Compatibility(true);
			$objPHPExcel->getActiveSheet()->setTitle('STATISTIQUES PAR LIEUX DEPOT');

			$objWriter->save(FCPATH.'assets/documents/stats/excel/par_lieux_depot/'.$nom.'.xlsx');
			redirect('file_browser/index/assets/documents/stats/excel/par_lieux_depot/'.$nom.'.xlsx');

			
		}
		else{
			show_404();
		}
	}

}
