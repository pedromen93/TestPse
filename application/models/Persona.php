<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona extends CI_Model {

	public function obtenerPersonaPorDocumento($values)
	{
		$sql = "SELECT *
				FROM Persona 
				WHERE tipo_documento = ?
				AND documento = ? ";
		return $this->db->query($sql, $values)->row();
	}

	public function registrarPersona($values)
	{
		$sql = "INSERT INTO persona(tipo_documento, documento, nombres, apellidos, empresa, correo, direccion, ciudad, provincia, pais, telefono, celular, codigo_postal)
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?) ";
		$this->db->query($sql, $values);
		return $this->db->insert_id();
	}

	public function actualizarPersona($values)
	{
		$sql = "UPDATE persona
				SET nombres = ?, 
					apellidos = ?, 
					empresa = ?, 
					correo = ?, 
					direccion = ?, 
					ciudad = ?, 
					provincia = ?,  
					telefono = ?, 
					celular = ?
				WHERE id = ? ";
		$this->db->query($sql, $values);
		return $this->db->affected_rows();
	}	

	public function obtenerPersona($values)
	{
		$sql = "SELECT *
				FROM persona
				WHERE tipo_documento = ? 
				AND documento = ? ";
		return $this->db->query($sql, $values)->row();
	}
}
?>