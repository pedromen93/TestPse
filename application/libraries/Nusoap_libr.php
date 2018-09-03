<?php
class Nusoap_libr
{
    function __construct()
    {
    	ini_set('error_reporting', E_STRICT);
        include(APPPATH.'libraries/lib/nusoap.php'); 
    }
}