<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parametro extends CI_Model {

	/**
	* Permite obtener un parametro por codigo
	* @param array
	*/
	public function obtenerParametro($values)
	{
		$sql = "SELECT *
				FROM parametro
				WHERE codigo = ? 
				AND estado = 'A' ";

		return $this->db->query($sql, $values)->row();
	}

	/**
	* Permite la actualización de valor de un parámetro activo dado su codigo
	* @param array
	*/
	public function actualizarParametro($values)
	{
		$sql = "UPDATE parametro
				SET valor = ? 
				WHERE codigo = ? 
				AND estado = 'A' ";
		$this->db->query($sql, $values);
		return $this->db->affected_rows();
	}
}

?>