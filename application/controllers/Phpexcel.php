<?php

/* @property phpexcel_model $phpexcel_model */

class Phpexcel extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'Admin');
		$this->load->library('CI_PHPSpreadSheet');

		//$this->load->model('phpexcel_model');

	}


	public function download($statut)
	{
		require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

		$data = [];
		$data['sexe'] = $this->input->post('sexe');
		$data['pays'] = $this->input->post('pays');
		$data['region'] = $this->input->post('region');
		$data['langue'] = $this->input->post('langue');
		$data['lieu_depot'] = $this->input->post('lieu_depot');
		$data['centre_examen'] = $this->input->post('centre_examen');
		$data['mnt'] = $this->input->post('mention');
		$data['parcours'] = $this->input->post('parcours');
		$data['cyc'] = $this->input->post('cycle');

		$candidates = $this->Admin->filtre_candidat($data, $statut, FALSE);

		//var_dump($data, $candidates); die; 

		// Create new Spreadsheet object
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Webeasystep.com ')
			->setLastModifiedBy('Ahmed Fakhr')
			->setTitle('Phpecxel codeigniter tutorial')
			->setSubject('integrate codeigniter with PhpExcel')
			->setDescription('this is the file test');

		// add style to the header
		$styleArray = array(
			'font' => array(
				'bold' => true,
			),
			'alignment' => array(
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'top' => array(
					'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				),
			),
			'fill' => array(
				'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startcolor' => array(
					'argb' => 'FFA0A0A0',
				),
				'endcolor' => array(
					'argb' => 'FFFFFFFF',
				),
			),
		);
		$spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);


		// auto fit column to content

		foreach (range('A', 'F') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)
				->setAutoSize(true);
		}
		// set the names of header cells
		$spreadsheet->getActiveSheet()
			->setCellValue("A1", 'Nom')
			->setCellValue("B1", 'Prenom(s)')
			->setCellValue("C1", 'Sexe')
			->setCellValue("D1", 'Date de naissance')
			->setCellValue("E1", 'Lieu de naissance')
		    ->setCellValue("E1",'UserJob')
		    ->setCellValue("F1",'Gender');

		// Add some data
		$x = 2;
		foreach($candidates as $c){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A$x", '')
			->setCellValue("B$x", '')
			->setCellValue("C$x", '')
			->setCellValue("D$x", '')
			->setCellValue("E$x", '');
			$x++;
		}
		
		//->setCellValue("E$x",'user_address')
		//->setCellValue("F$x",'user_job');




		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Users Information');

		// set right to left direction
		//		$spreadsheet->getActiveSheet()->setRightToLeft(true);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="subscribers_sheet"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
		$writer->save('php://output');
		exit;

		//  create new file and remove Compatibility mode from word title


	}
	public function test()  
	{

	

				require_once APPPATH . '/libraries/Phpexcel/excel.php';
				

				
				//$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
				$spreadsheet = new CI_PHPSpreadSheet();

				// Set document properties
				$spreadsheet->getProperties()->setCreator('afromane.com ')
						->setLastModifiedBy('Afomane.com')
						->setTitle('liste exemplaire')
						->setSubject('inconnu')
						->setDescription('this is the file test');
				// add style to the header
				$styleArray = array(
						'font' => array(
								'bold' => true,
						),
						'alignment' => array(
								'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
								'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
						),
						'borders' => array(
								'top' => array(
										'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								),
						),
						'fill' => array(
								'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
								'rotation' => 90,
								'startcolor' => array(
										'argb' => 'FFA0A0A0',
								),
								'endcolor' => array(
										'argb' => 'FFFFFFFF',
								),
						),
				);
				$spreadsheet->getActiveSheet()->getStyle('A2:C2')->applyFromArray($styleArray);
				foreach(range('A','C') as $columnID) {
					$spreadsheet->getActiveSheet()->getColumnDimension($columnID)
							->setAutoSize(true);
				}
			
				$spreadsheet->setActiveSheetIndex(0)
							->setCellValueExplicit("A2",'Num ISBN', 'n')
							->setCellValueExplicit("B2",'Etat', 'n')
							->setCellValue("C2",'Date Approvisionnement');

				// Add some data
					$x= 2;
				
				$spreadsheet->setActiveSheetIndex(0)
									->setCellValueExplicit("A$x",'mrr', 'n')
									->setCellValueExplicit("B$x",'ttt', 'n')
									->setCellValueExplicit("C$x",' fff', 'n');
				
				$spreadsheet->getActiveSheet()->setTitle('Exemplaire Information');


				$spreadsheet->setActiveSheetIndex(0);

				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="liste_exemplaire_complet"');
				header('Cache-Control: max-age=0');
				header('Cache-Control: max-age=1');
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
				header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
				header('Cache-Control: cache, must-revalidate'); 
				header('Pragma: public'); 

				$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
				$writer->save('php://output');
				exit;



	}
}
/* End of file dashboard.php */
/* Location: ./system/application/modules/matchbox/controllers/dashboard.php */