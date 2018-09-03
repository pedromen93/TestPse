<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
        parent::__construct();
		date_default_timezone_set('America/Bogota');
		$this->load->library("Nusoap_libr");
		$this->load->model("Auth");
		$this->load->model("Banco");
		$this->load->model("Parametro");
    }

	public function index()
	{
		$elParametro = $this->Parametro->obtenerParametro(["FECHA_ACT_BANCO"]);

		if(!is_null($elParametro))
		{
			if($elParametro->valor != date('Y-m-d'))
			{
				#CONSULTA LOS BANCOS
				$listaBancos = $this->obtenerListaBancos();

				#PRIMERA VEZ QUE REGISTRA BANCOS
				$this->db->trans_begin();
				$this->Banco->vaciarListaBancos();

				if(count($listaBancos) > 0) {
					foreach ($listaBancos as $banco) {
						$this->Banco->registrarbanco([$banco["bankCode"], utf8_encode($banco["bankName"])]);
					}
				}

				$this->Parametro->actualizarParametro([date('Y-m-d'), "FECHA_ACT_BANCO"]);
				$this->db->trans_commit();
			}
		}
		else
		{
			$this->db->trans_rollback();
			$this->output->set_output("Falta parámetro FECHA_ACT_BANCO");
		}

		$this->load->view('welcome_message', ["bancos" => $this->Banco->obtenerListaBancos()]);
	}

	/**
	* Obtiene el listado de bancos del WS
	* @return array listado de bancos devueltos por el servicio web
	*/
	public function obtenerListaBancos()
	{
		try 
		{
			$fecha 	= $this->Auth->getFechaIso();
	        $client = new nusoap_client(DIR_WSDL, 'wsdl');
	        $param 	= ["auth" => ["login" 	=> $this->Auth->getLogin(),
				        		  "tranKey" => sha1($fecha . $this->Auth->getTransKey()),
				        		  "seed" 	=> $fecha]];
		  	$result = $client->call('getBankList', $param, '', '', false, true);
			return array_shift($result)["item"];
		} 
		catch (Exception $e) 
		{
			$this->output->set_output("Falta parámetro FECHA_ACT_BANCO");
			return [];			
		}
	}
}
