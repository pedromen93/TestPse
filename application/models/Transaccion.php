<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaccion extends CI_Model {

	public function registrarTransaccion($values)
	{
		$sql = "INSERT INTO transaccion(tipo_persona, banco, referencia, descripcion, total, pagador, comprador)
				VALUES(?,?,?,?,?,?,?) ";
		$this->db->query($sql, $values);
		return $this->db->insert_id();
	}

	public function actualizarIdTransaccion($values)
	{
		$sql = "UPDATE transaccion
				SET id_transaccion = ?,
					estado_transaccion = ?
				WHERE id = ? ";
		$this->db->query($sql, $values);
		return $this->db->affected_rows();
	}

	public function obtenerTransaccionPorId($values)
	{
		$sql = "SELECT *
				FROM transaccion
				WHERE id = ? ";
		return $this->db->query($sql, $values)->row();
	}
}
?>