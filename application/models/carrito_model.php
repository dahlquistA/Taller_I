<?php
class Carrito_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function traerCompras()
    {
        return $this->db->get('compras')->result();
    }

    public function traerCompra($data)
    {
        $this->db->where('id_compra', $data);
        return $this->compras()[0];
    }

    public function traerCompraUsuario($data)
    {
        $this->db->where('id_persona', $data);
        return $this->db->get('compras', $data);
    }

    public function nuevaCompra($data)
    {
        return $this->db->insert('compras', $data);
    }

    public function nuevoDetalle($data)
    {
        return $this->db->insert('detalle_compra', $data);
    }

    public function registrar_compra($data)
    {
        $this->db->where('id_compra', $data);
        return $this->db->update('compras', ['id_compra' => 0]);
    }

}
