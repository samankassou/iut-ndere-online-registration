<?php
/**
 * Created by PhpStorm.
 * User: yttyyw
 * Date: 20/12/2017
 * Time: 19:50
 */

require_once FCPATH."application/third_party/spreadsheets/autoload.php";

//define('FILTERS', array(
//    '='=>PHPExcel_Worksheet_AutoFilter_Column_Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
//    '!'=>PHPExcel_Worksheet_AutoFilter_Column_Rule::AUTOFILTER_COLUMN_RULE_NOTEQUAL,
//    '>'=>PHPExcel_Worksheet_AutoFilter_Column_Rule::AUTOFILTER_COLUMN_RULE_GREATERTHAN,
//    '<'=>PHPExcel_Worksheet_AutoFilter_Column_Rule::AUTOFILTER_COLUMN_RULE_LESSTHAN
//));
//
//define();

use \PhpOffice\PhpSpreadsheet\Exception;
use \PhpOffice\PhpSpreadsheet\Comment;
use \PhpOffice\PhpSpreadsheet\IComparable;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\NamedRange;
use \PhpOffice\PhpSpreadsheet\ReferenceHelper;
use \PhpOffice\PhpSpreadsheet\Settings;
use \PhpOffice\PhpSpreadsheet\Writer\Csv;
use \PhpOffice\PhpSpreadsheet\Writer\Html;
use \PhpOffice\PhpSpreadsheet\Writer\WIwriter;
use \PhpOffice\PhpSpreadsheet\Writer\Ods;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Writer\Xls;

class CI_PHPSpreadSheet extends \PhpOffice\PhpSpreadsheet\Spreadsheet
{
    // use \PhpOffice\PhpSpreadsheet\Exception;
    // use \PhpOffice\PhpSpreadsheet\Comment;
    // use \PhpOffice\PhpSpreadsheet\IComparable;
    // use \PhpOffice\PhpSpreadsheet\IOFactory;
    // use \PhpOffice\PhpSpreadsheet\NamedRange;
    // use \PhpOffice\PhpSpreadsheet\ReferenceHelper;
    // use \PhpOffice\PhpSpreadsheet\Settings;
    // use \PhpOffice\PhpSpreadsheet\Writer\Csv;
    // use \PhpOffice\PhpSpreadsheet\Writer\Html;
    // use \PhpOffice\PhpSpreadsheet\Writer\WIwriter;
    // use \PhpOffice\PhpSpreadsheet\Writer\Ods;
    // use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    // use \PhpOffice\PhpSpreadsheet\Writer\Xls;
    protected $file, $FILTERS, $FILTER_TYPES;

    public function __construct($file=null)
    {
        parent::__construct();
        $this->setFile($file);

        $this->FILTERS=array(
            '='=>\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
            '!'=>\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_NOTEQUAL,
            '>'=>\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_GREATERTHAN,
            '<'=>\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_LESSTHAN
        );
        $this->FILTER_TYPES=array('=', '!', '>', '<');
    }

    public function getFile(){
        return $this->file;
    }

    public function getFileType(){
        try{
            return \PhpOffice\PhpSpreadsheet\IOFactory::identify($this->file);
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            echo $e->getMessage();
            die;
        }
        //return PHPExcel_IOFactory::identify($this->file);
    }

    public function read($fCell=null, $lCell=null, $sheetIndex=0, $Filtres=array(), $type='Xlsx')
    {

        try {
            $FileType = $this->getFileType();
            //$FileType = 'CSV';
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($FileType);

            $objPHPExcel = $objReader->load($this->file);
            $sheet = $objPHPExcel->getSheet($sheetIndex);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $firstCell=$fCell==null?'A1':$fCell;
            $lastCell=$fCell==null?$highestColumn.''.$highestRow:$lCell;
            //var_dump($firstCell,$lastCell); die;

            $array=array();
            if(!empty($Filtres))
            {
                $sheet->setAutoFilter($firstCell.':'.$lastCell);
                $autoFilter=$sheet->getAutoFilter();
                foreach($Filtres as $colonne=>$filtres)
                {
                    $columnFilter = $autoFilter->getColumn($colonne);
                    $columnFilter->setFilterType(
                        \PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_CUSTOMFILTER
                    );
                    if(!empty($filtres))
                        foreach ($filtres as $filtre)
                        {
                            if ($filtre!='') {

                                if (in_array($filtre[0], $this->FILTER_TYPES)) {
                                    $columnFilter->createRule()
                                        ->setRule(
                                            $this->FILTERS[$filtre[0]],
                                            substr($filtre,1)
                                        );
                                } else {
                                    $columnFilter->createRule()
                                        ->setRule(
                                            $this->FILTERS['='],
                                            $filtre
                                        );
                                }
                            } else
                            {
                                $columnFilter->createRule()
                                    ->setRule(
                                        $this->FILTERS['='],
                                        $filtre
                                    );
                            }
                        }
                }
                $autoFilter->showHideRows();
                foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $rowi=>$row) {
                    if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
                        $rowData = $sheet->rangeToArray($firstCell[0].$rowi .':' . $lastCell[0]. $rowi,
                            NULL,
                            TRUE,
                            FALSE);
                        array_push($array, $rowData[0]);
                    }
                }
            }
            else {
                $array=$objPHPExcel->getActiveSheet()
                                   ->rangeToArray(
                                       $firstCell.':'.$lastCell,
                                       NULL,
                                       TRUE,
                                       TRUE,
                                       TRUE
                                       );
            }

            return $array;
        }
        catch(Exception $e) {
            die('Error loading file "'.pathinfo($this->file,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
    }


    public function setFile($file)
    {
        $this->file=$file;
    }
    
    public function writer()
    {
	    return new Xlsx($this);
	}
}