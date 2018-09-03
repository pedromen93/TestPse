<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class continuePayment extends CI_Controller {

	public function __construct() {
        parent::__construct();
		date_default_timezone_set('America/Bogota');
		$this->load->library("Nusoap_libr");
		$this->load->model("Auth");
		$this->load->model("Persona");
		$this->load->model("Transaccion");
    }

	public function index()
	{
		try
		{
			if(!is_null($this->input->post('interface')) && !is_null($this->input->post('interface')))
				$this->load->view('continuePayment_view', ["interface" => $this->input->post('interface'),
															"banco" => $this->input->post('banco'),
															"load_java" => 'onload = "base_site(\''. base_url() .'\');"' ]);
			else
				redirect('Welcom?msg=Debe diligenciar el formulario.');
		} 
		catch (Exception $e) 
		{
			$this->output->set_output($e->getMessage());
		}
	}

	/**
	* Gestiona la operación de registro de transacción y devuelve los 
	* datos de redirección al banco
	* @access public
	*/
	public function redireccionaBanco()
	{
		try 
		{
			$docuTypePagador  = $this->input->post('doc_type_payment');
			$numDocuPagador   = $this->input->post('num_doc_payment');			
			$nombresPagador   = $this->input->post('fist_name_payment');
			$apellidosPagador = $this->input->post('last_name_payment');
			$empresaPagador   = $this->input->post('company_payment');
			$correoPagador    = $this->input->post('mail_payment');
			$direccionPagador = $this->input->post('addres_payment');
			$ciudadPagador    = $this->input->post('city_payment');
			$provinciaPagador = $this->input->post('province_payment');
			$telefonoPagador  = $this->input->post('phone_payment');
			$celularPagador   = $this->input->post('mobile_payment');

			$docuTypeDestinatario  = $this->input->post('doc_type_shipping');
			$numDocuDestinatario   = $this->input->post('num_doc_shipping');			
			$nombresDestinatario   = $this->input->post('fist_name_shipping');
			$apellidosDestinatario = $this->input->post('last_name_shipping');
			$empresaDestinatario   = $this->input->post('company_shipping');
			$correoDestinatario   = $this->input->post('mail_shipping');
			$direccionDestinatario = $this->input->post('addres_shipping');
			$ciudadDestinatario    = $this->input->post('city_shipping');
			$provinciaDestinatario = $this->input->post('province_shipping');
			$telefonoDestinatario  = $this->input->post('phone_shipping');
			$celularDestinatario   = $this->input->post('mobile_shipping');

			$tipoPersona    = $this->input->post('interface');
			$banco          = $this->input->post('banco');
			$referencia     = $this->input->post('reference');
			$total          = $this->input->post('total_amount');
			$idPagador      = 0;
			$idDestinatario = 0;

			#VALIDA LA EXISTENCIA DEL PAGADOR
			$pagador = $this->Persona->obtenerPersonaPorDocumento([$docuTypePagador, $numDocuPagador]);
			
			if(!is_null($pagador))
			{
				$idPagador = $pagador->id;

				#ACTUALIZA LOS DATOS
				$this->Persona->actualizarPersona([$nombresPagador, 
													$apellidosPagador, 
													$empresaPagador, 
													$correoPagador, 
													$direccionPagador, 
													$ciudadPagador, 
													$provinciaPagador, 
													$telefonoPagador, 
													$celularPagador,
													$idPagador]);
			}
			else #REGISTRA LOS DATOS
				$idPagador = $this->Persona->registrarPersona([$docuTypePagador, 
																$numDocuPagador, 
																$nombresPagador, 
																$apellidosPagador, 
																$empresaPagador, 
																$correoPagador, 
																$direccionPagador, 
																$ciudadPagador, 
																$provinciaPagador, 
																"COLOMBIA", 
																$telefonoPagador, 
																$celularPagador,
																 "0"]);

			#VALIDA LA EXISTENCIA DEL PAGADOR
			$destinatario = $this->Persona->obtenerPersonaPorDocumento([$docuTypeDestinatario, $numDocuDestinatario]);
			
			if(!is_null($destinatario))
			{
				$idDestinatario = $destinatario->id;

				#ACTUALIZA LOS DATOS
				$this->Persona->actualizarPersona([$nombresDestinatario, 
													$apellidosDestinatario, 
													$empresaDestinatario, 
													$correoDestinatario, 
													$direccionDestinatario, 
													$ciudadDestinatario, 
													$provinciaDestinatario, 
													$telefonoDestinatario, 
													$celularDestinatario,
													$idDestinatario]);
			}
			else #REGISTRA LOS DATOS
				$idDestinatario = $this->Persona->registrarPersona([$docuTypeDestinatario, 
																$numDocuDestinatario, 
																$nombresDestinatario, 
																$apellidosDestinatario, 
																$empresaDestinatario, 
																$correoDestinatario, 
																$direccionDestinatario, 
																$ciudadDestinatario, 
																$provinciaDestinatario, 
																"COLOMBIA", 
																$telefonoDestinatario, 
																$celularDestinatario,
																 "0"]);

			if($idPagador <= 0 || $idDestinatario <= 0)
				$this->output->set_output("No se puede continuar la transacción, no se pudo registrar el pagador o destinatario");
			else
			{
				#REGISTRA LA TRANSACCIÓN
				$idPago = $this->Transaccion->registrarTransaccion([$tipoPersona, $banco, $referencia, ("Pago PSE " . date('Y-m-d h:i:s')), $total, $idPagador, $idDestinatario]);

				if($idPago > 0)
				{
					$fecha 	= $this->Auth->getFechaIso();
			        $client = new nusoap_client(DIR_WSDL, 'wsdl');
			        $param 	= ["auth" => ["login" 	=> $this->Auth->getLogin(),
						        		  "tranKey" => sha1($fecha . $this->Auth->getTransKey()),
						        		  "seed" 	=> $fecha],
						        "transaction" => ["bankCode" => $banco,
						    					  "bankInterface" => $tipoPersona,
						    					  "returnURL" => base_url()."statusPayment/".$idPago,
						    					  "reference" => $referencia,
						    					  "description" => "Pago PSE " . date('Y-m-d h:i:s'),
						    					  "language" => "ES",
						    					  "currency" => "COP", 
						    					  "totalAmount" => $total,
						    					  "taxAmount" => 0,
						    					  "devolutionBase" => 0,
						    					  "tipAmount" => 0, 
						    					  "payer" => ["documentType" => $docuTypePagador,
						    									"document" => $numDocuPagador,
							    								"firstName" => $nombresPagador,
							    								"lastName" => $apellidosPagador,
							    								"company" => $empresaPagador,
										    					"emailAddress" => $correoPagador,
											    				"address" => $direccionPagador,
												    			"city" => $ciudadPagador,
												    			"province" => $provinciaPagador,
						    									"country" => "COLOMBIA",
						    									"phone" => $telefonoPagador,
																"mobile" => $celularPagador,
																"postalCode" => "0"],
												  "shipping" => ["documentType" => $docuTypeDestinatario,
							    								  "document" => $numDocuDestinatario,
								    							  "firstName" => $nombresDestinatario,
								    							  "lastName" => $apellidosDestinatario,
								    							  "company" => $empresaDestinatario,
											    				  "emailAddress" => $correoDestinatario,
												    			  "address" => $direccionDestinatario,
													    		  "city" => $ciudadDestinatario,
													    		  "province" => $provinciaDestinatario,
							    								  "country" => "COLOMBIA",
							    								  "phone" => $telefonoDestinatario,
																  "mobile" => $celularDestinatario,
																  "postalCode" => "0"],
												  "ipAddress" => $this->input->ip_address(),
												  "userAgent" => $_SERVER['HTTP_USER_AGENT']
						    					]];
				  	$result = $client->call('createTransaction', $param, '', '', false, true);

				  	if(array_key_exists("faultstring", $result))
						$this->output->set_output($result["faultstring"]);
				  	else if(array_key_exists("createTransactionResult", $result))
				  	{
				  		#ACTUALIZA EL ID DE TRANSACCIÓN DE PSE
				  		$result = $result["createTransactionResult"];
				  		$this->Transaccion->actualizarIdTransaccion([$result["transactionID"], $result["returnCode"], $idPago]);

				  		#ENVIA LA URL A LA QUE DEBE REDIRECCIONAR
				  		$this->output->set_output(json_encode(["urlRedirect" => $result["bankURL"]]));
				  	}
				}
				else
					$this->output->set_output("No se pudo registrar el log de la transacción");
			}
		} 
		catch (Exception $e) {
			$this->output->set_output($e->getMessage());
		}
	}

	/**
	* Permite obtener el resultado de una transacción en pantalla
	*/
	public function informacionTransaccion($idTransaccion)
	{
		try {
			#CONSULTA EL Transaccion CON EL ID PROPORCIONADO
			$laTransaccion = $this->Transaccion->obtenerTransaccionPorId([$idTransaccion]);

			if(!is_null($laTransaccion))
			{
				$fecha 	= $this->Auth->getFechaIso();
		        $client = new nusoap_client(DIR_WSDL, 'wsdl');
		        $param 	= ["auth" => ["login" 	=> $this->Auth->getLogin(),
					        		  "tranKey" => sha1($fecha . $this->Auth->getTransKey()),
					        		  "seed" 	=> $fecha],
					        "transactionID" => $laTransaccion->id_transaccion
						  ];

				$result = $client->call('getTransactionInformation', $param, '', '', false, true);

			  	if(array_key_exists("faultstring", $result))
					$this->output->set_output($result["faultstring"]);
			  	else if(array_key_exists("getTransactionInformationResult", $result))
			  	{
			  		#ACTUALIZA EL ID DE TRANSACCIÓN DE PSE
			  		$result = $result["getTransactionInformationResult"];
			  		$this->load->view("infoTransaction_view", ["result" => $result]);
			  	}
			}
			else
	  			$this->load->view("infoTransaction_view", ["info_message" => "No se encontró la transacción en el sistema."]);
		}
		catch (Exception $e) {
			// $this->output->set_output($e->getMessage());	
  			$this->load->view("infoTransaction_view", ["err_message" => "Ocurrió un inconveniente!"]);
		}
	}

	/**
	* Devuelve la información completa de una persona dado el tipo de documento y numero
	*/
	public function obtenerInformacionPersona()
	{
		try 
		{
			if(!is_null($this->input->post('type')) && !is_null($this->input->post('docu'))){
				$laPersona = $this->Persona->obtenerPersona([$this->input->post('type'),
															$this->input->post('docu')]);
				$this->output->set_output(json_encode($laPersona));
			}
			else {
				$this->output->set_output("Parámetros no válidos para ejecutar el proceso.");
			}
		} 
		catch (Exception $e) {
			$this->output->set_output($e->getMessage());
		}
	}
}
?>