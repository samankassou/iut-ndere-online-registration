<?php
/**
 * Created by PhpStorm.
 * User: yttyyw
 * Date: 20/12/2017
 * Time: 19:50
 */

require_once APPPATH."third_party/PHPExcel.php";
require_once APPPATH."third_party/PHPExcel/IOFactory.php";

//define('FILTERS', array(
//    '='=>PHPExcel_Worksheet_AutoFilter_Column_Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
//    '!'=>PHPExcel_Worksheet_AutoFilter_Column_Rule::AUTOFILTER_COLUMN_RULE_NOTEQUAL,
//    '>'=>PHPExcel_Worksheet_AutoFilter_Column_Rule::AUTOFILTER_COLUMN_RULE_GREATERTHAN,
//    '<'=>PHPExcel_Worksheet_AutoFilter_Column_Rule::AUTOFILTER_COLUMN_RULE_LESSTHAN
//));
//
//define();

class CI_PHPExcel extends PHPExcel
{

    public function __construct()
    {
        parent::__construct();
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
    }

}