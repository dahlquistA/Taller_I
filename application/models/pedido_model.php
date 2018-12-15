<?php
class Pedido_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_pedidos_id($id)
    {
        $this->db->select('*');
        $this->db->from('detalle_compra');
        $this->db->where('id_compra', $id);
        $this->db->join('compras', 'compras.id_compra = detalle_compra.id_compra');
        $this->db->join('producto', 'producto.id_producto = detalle_compra.id_producto');
        $this->db->join('personas', 'personas.id_persona = compras.id_persona');
        $query = $this->db->get();
        return $query->result();
    }

    public function select_pedidos()
    {
        $this->db->select('*');
        $this->db->from('compras');
        $this->db->order_by('id_compra', 'desc');
        $this->db->join('persona', 'persona.id_persona = compras.id_persona');
        $query = $this->db->get();
        return $query->result();
    }

    public function select_compras_id()
    {
        return $this->db->get_where('compras', ['id_persona' => $this->session->userdata['id']])->result();
    }

    public function paginas_mostra_pedidos($limit, $row)
    {
        $this->db->select('*');
        $this->db->from('compras');
        $this->db->limit($limit, $row);
        $query = $this->db->get();
        return $query->result();
    }

}
