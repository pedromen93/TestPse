<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banco extends CI_Model {

	public function registrarbanco($values)
	{
		$sql = "INSERT INTO banco(codigo, nombre) 
				VALUES(?, ?) ";
		$this->db->query($sql, $values);
		return $this->db->affected_rows();
	}

	public function vaciarListaBancos()
	{
		$sql = "DELETE FROM banco ";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function obtenerListaBancos()
	{
		$sql = "SELECT *
				FROM banco
				WHERE estado = 'A' ";
		return $this->db->query($sql)->result();
	}
}

?>