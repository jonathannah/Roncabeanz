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
    private $totalViews = array("0"=>1, "1"=>1, "2"=>1, "3"=>1, "4"=>1);
    private $viewName = "";

    function __construct()
    {
        $cn = "RoncabeanzUser";
        if(isset($_COOKIE[$cn])) {
            $replace = array(' ', '.');
            $name = str_replace($replace, '_', $_COOKIE[$cn]);
            $this->viewName = "RoncabeanzTotalViews"."_".$name;
        } else {
            $this->viewName = "RoncabeanzTotalViews";
        }

        if(isset($_COOKIE[$this->viewName]))
        {
            $this->totalViews = explode(',', $_COOKIE[$this->viewName]);
        }
     }

    function put($productCode)
    {
        $idx = (string) $productCode;

        if($this->totalViews[$idx] == null)
        {
            $this->totalViews[$idx] = 0;
        }
        $this->totalViews[$idx] = intval($this->totalViews[$idx]) + 1;


        $cookVal = implode(',', $this->totalViews);
        setcookie($this->viewName, $cookVal, time() + (86400 * 30), "/");
    }

    function getValues()
    {
        return $this->totalViews;
    }

    function size()
    {
        return count($this->totalViews);
    }

    function get($idx)
    {
        if($idx >= 0 && $idx < count($this->totalViews))
        {
            return $this->totalViews[$idx];
        }

        return -1;
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
        foreach ($this->totalViews as $key => $value)
        {
            $ret[$i] = $key;
            if(++$i >= MAX_VIEWS){
                break;
            }

        }
        return $ret;
    }
}