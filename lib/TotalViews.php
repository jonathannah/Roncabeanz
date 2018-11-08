<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/1/18
 * Time: 8:11 AM
 */
include_once 'lib/Cookies.php';

define('MAX_VIEWS', 5);

class TotalViews
{
    private $totalViews = array('P_0'=>1, 'P_1'=>1, 'P_2'=>1, 'P_3'=>1, 'P_4'=>1);
    private $viewName_keys = "";
    private $viewName_vals = "";

    private function getIndex($productCode)
    {
        return "P_"."$productCode";
    }

    private function fromIndex($index)
    {
        return substr($index, 2);
    }

    function __construct()
    {
        $cn = "RoncabeanzUser";
        if(isset($_COOKIE[$cn])) {
            $replace = array(' ', '.');
            $name = str_replace($replace, '_', $_COOKIE[$cn]);
            $this->viewName_keys = "RoncabeanzTotalViews_keys"."_".$name;
            $this->viewName_vals= "RoncabeanzTotalViews_vals"."_".$name;
        } else {
            $this->viewName_keys = "RoncabeanzTotalViews_keys"."_";
            $this->viewName_vals= "RoncabeanzTotalViews_vals"."_";
        }

        if(isset($_COOKIE[$this->viewName_keys]) && isset($_COOKIE[$this->viewName_vals]))
        {
            $keys = explode(',', $_COOKIE[$this->viewName_keys]);
            $vals = explode(',',  $_COOKIE[$this->viewName_vals]);

            for($i=0; $i < min(count($keys), count($vals)); ++$i){
                $this->totalViews[$keys[$i]] = $vals[$i];
            }
        }

        $ak = array_keys($this->totalViews);
        $av = array_values($this->totalViews);
        /*
        for($i = 0; $i < count($av); ++$i){
            error_log("(Key: ".$ak[$i]." Value: ".$av[$i].") ");
        }*/
     }

    function put($productCode)
    {
        $idx = $this->getIndex($productCode);

        if($this->totalViews[$idx] == null)
        {
            $this->totalViews[$idx] = 0;
        }
        $this->totalViews[$idx] = intval($this->totalViews[$idx]) + 1;

        $ak = array_keys($this->totalViews);
        $av = array_values($this->totalViews);


        $cookVal = implode(',', $ak);
        setcookie($this->viewName_keys, $cookVal, time() + (86400 * 30), "/");

        $cookVal = implode(',', $av);
        setcookie($this->viewName_vals, $cookVal, time() + (86400 * 30), "/");

    }

    function getValues()
    {
        return $this->totalViews;
    }

    function size()
    {
        return count($this->totalViews);
    }

    function viewName()
    {
        return $this->viewName;
    }

    function topFive()
    {
        arsort($this->totalViews);

        $ret = array();
        $i = 0;
        $ak = array_keys($this->totalViews);
        foreach ($ak as $key)
        {
            $ret[$i] = $this->fromIndex($key);
            if(++$i >= MAX_VIEWS){
                break;
            }

        }
        return $ret;
    }
}