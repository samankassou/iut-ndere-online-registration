<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

if ( ! function_exists('randomPassword')) {
    function randomPassword($charNbr = 12)
    {
        $pwd = "";

        $string = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789+@!$%?&";
        $stringLength= strlen($string);

        for($i = 1; $i <= $charNbr; $i++)
        {
            $randomPos = mt_rand(0,($stringLength-1));
            $pwd .= $string[$randomPos];
        }

        return $pwd;
    }
}
if ( ! function_exists('caractere')) {
    function caractere($str, $l = 76, $e = "\r\n")
    {
        $tmp = array_chunk(
            preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $l);
        $str = "";
        foreach ($tmp as $t) {
            $str .= join("", $t) . $e;
        }
        return $str;
    }
}
if ( ! function_exists('castNumberId')) {
    function castNumberId($number, $ent=3, $dec=0)
    {
        if ($dec==0) {
            $strNbr = "";
            $strNbr .= $number;
            if (strpos($strNbr, '.')!=false) {
                $tmp=explode('.', $strNbr);
                $strNbr="".$tmp[0];
            }

            $strSize = strlen($strNbr);
            $strFinal = array();
            for ($k = 1; $k <= $ent; $k++)
                array_push($strFinal, 0);
            for ($i = 0; $i < $strSize; $i++) {
                $strFinal[$ent - (1 + $i)] = $strNbr[$strSize - (1 + $i)];
            }
            $castedNbr = "";
            for ($j = 0; $j < $ent; $j++)
                $castedNbr .= $strFinal[$j];
            return $castedNbr;
        } else if ($dec!=0 and is_integer($dec))
        {
            $nt="";
            $nt.=$number;
            $fnt="";
            if (strpos($nt, '.')==false) {
                $strNbr = $nt;
                $strSize = strlen($strNbr);
                $strFinal = array();
                for ($k = 1; $k <= $ent; $k++)
                    array_push($strFinal, 0);
                for ($i = 0; $i < $strSize; $i++) {
                    $strFinal[$ent - (1 + $i)] = $strNbr[$strSize - (1 + $i)];
                }
                $castedNbr = "";
                for ($j = 0; $j < $ent; $j++)
                    $castedNbr .= $strFinal[$j];
                $int=$castedNbr;

                $fnt = $int . '.';
                for ($i = 1; $i <= $dec; $i++) $fnt .= '0';
                return $fnt;
            }
            else
            {
                $tmp=explode('.', $nt);
                //Partie entière
                $strNbr = "";
                $strNbr .= $tmp[0];
                $strSize = strlen($strNbr);
                $strFinal = array();
                for ($k = 1; $k <= $ent; $k++)
                    array_push($strFinal, 0);
                for ($i = 0; $i < $strSize; $i++) {
                    $strFinal[$ent - (1 + $i)] = $strNbr[$strSize - (1 + $i)];
                }
                $castedNbr = "";
                for ($j = 0; $j < $ent; $j++)
                    $castedNbr .= $strFinal[$j];
                $int=$castedNbr;

                //Partie décimale
                $strNbr = "";
                $strNbr .= $tmp[1];
                $strSize = strlen($strNbr);
                $strFinal = array();
                for ($k = 1; $k <= $dec; $k++)
                    array_push($strFinal, 0);
                for ($i = 0; $i < $strSize; $i++) {
                    $strFinal[$i] = $strNbr[$i];
                }
                $castedNbr = "";
                for ($j = 0; $j < $ent; $j++)
                    $castedNbr .= $strFinal[$j];
                $flt=$castedNbr;

                return $int.'.'.$flt;
            }
        } else return $number;
    }
}



if(!function_exists('formatNumber')){
    function formatNumber($nombre){
        return number_format($nombre,0,'',' ');
    }
}

if(!function_exists('formatMonnaie')){
    function formatMonnaie($nombre){
        return number_format($nombre,0,'',' ')." ".DEVISE_GROSSISTE;
    }
}

if ( ! function_exists('getWeek')) {
    function getWeek($dayDate, $format='Y-m-d')
    {
        $date = explode("-", $dayDate);

        $time = strtotime($date[0].'-'.$date[1].'-'.$date[2]);
        //var_dump($time); die();

        $day = date("w", "$time");
        $jourdeb=0;
        $jourfin=0;

        switch ($day) {
            case "0":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-6,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2],$date[0]);
                break;

            case "1":
                $jourdeb = mktime(0,0,0,$date[1],$date[2],$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+6,$date[0]);
                break;

            case "2":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-1,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+5,$date[0]);
                break;

            case "3":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-2,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+4,$date[0]);
                break;

            case "4":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-3,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+3,$date[0]);
                break;

            case "5":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-4,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+2,$date[0]);
                break;

            case "6":
                $jourdeb = mktime(0,0,0,$date[1],$date[2]-5,$date[0]);
                $jourfin = mktime(0,0,0,$date[1],$date[2]+1,$date[0]);
                break;
        }
        $date=date_create(date('d-m-Y', $jourfin));
        date_sub($date,date_interval_create_from_date_string("1 days"));
        $week=new stdClass();
        $week->start=date($format,$jourdeb);
        $week->end=date_format($date, $format);

        //$week=array('debut'=>date('d/m/Y',$jourdeb), 'fin'=>date_format($date, 'd/m/Y'));
        return $week;
    }
}
if (!function_exists('textClass'))
{
    function textClass($value,$comp,$egal=0)
    {
        if($value<$comp)
            return "text-danger ";
        elseif($value>$comp)
            return "text-success ";
        elseif($egal)
            return 'text-warning ';
        else
            return '';
    }
}


if (!function_exists('toHtmlTable'))
{
    function toHtmlTable($array=array(), $fRow=0, $fCol=0, $lRow=null, $lCol=null)
    {
        $table="<table border=1>";
        $row=($lRow==null?count($array):$lRow);
        $nbr=0;
        for ($i=$fRow; $i<$row; $i++)
        {
            $table.="<tr>";
            $rw=$array[$i];
            $col=($lCol==null?count($rw):$fCol);
            $table.="<td>".(++$nbr)."</td>";
            for ($j=$fCol; $j<$col; $j++){
                $table.="<td>".($rw[$j]!=null?$rw[$j]:"")."</td>";
            }
            $table.="</tr>";
        }
        $table.="</table>";
        return $table;
    }
}

if (!function_exists('error_tag'))
{
    function error_tag($tag)
    {
        return "<p class='errors text-danger' id='error$tag'></p>";
    }
}

if (!function_exists('selected'))
{
    function selected($tag, $set)
    {
        foreach ($set as $s)
        {
            if ($s->id==$tag)
                return "selected";
        }
        return "";
    }
}

if (!function_exists('value'))
{
    function value($tag, $set, $field)
    {
        foreach ($set as $s)
        {
            if ($s->id==$tag)
                $s->$field;
        }
        return "";
    }
}
?>

