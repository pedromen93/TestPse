<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Model {

	public function getLogin()
	{
		return LOGIN_WSDL;
	}

	public function getTransKey()
	{
		return TRANSKEY_WSDL;
	}

	public function getFechaIso()
	{
		date_default_timezone_set('America/Bogota');
		return date('c');
	}
}

?>