<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Producto_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //En una variable se guarda el ID del ultimo producto cargado
    public function recuperar_ultimo_id()
    {
        $id_producto = $this->db->insert_id();
        return $id_producto;
    }

    public function guardar_producto($data)
    {
        return $this->db->insert('producto', $data);
    }

    public function editar($data)
    {
        $this->db->where('id_producto', $data['id_producto']);
        return $this->db->update('producto', $data);
    }

    public function actualizar_producto($data, $id)
    {
        $this->db->where('id_producto', $id);
        return $this->db->update('producto', $data);
    }

    public function select_producto($id)
    {
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->where('id_producto', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function producto($data)
    {
        $this->db->where('id_producto', $data);
        return $this->traerProductos()[0];
    }

    public function traerProd($data)
    {
        return $this->db->get_where('producto', ['id_producto' => $data])->result()[0];
    }
/*-----------------------------------------------------*/
    public function prod($data)
    {
        $this->db->where('id_producto', $data);
        return $this->traerProductos();
    }

    public function traerProductos()
    {
        return $this->db->get('producto')->result();
    }
/*------------------------------------------------------*/    
    public function select_categoria()
    {
        $query = $this->db->get('categoria');
        return $query->result();
    }   

    public function misCompras()
    {
        $this->db->where('id_persona',
                         $this->session->userdata('id'));
        return $this->db->get('compras')->result();
    }

    public function detalle($idCompra)
    {
        return $this->db->get_where('detalle_compra', ['id_compra' => $idCompra])->result();
    }

    public function select_productos()
    {
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->join('categoria', 'categoria.categoria_id = producto.categoria_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function paginas_mostrar($limit, $row)
    {
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->limit($limit, $row);
        $query = $this->db->get();
        return $query->result();
    }

    public function num_post()
    {
        $number = $this->db->query("SELECT count(*) as number FROM producto")->row()->number;
        return intval($number);
    }

    public function get_pagination($number_per_page)
    {
        return $this->db->get("producto", $number_per_page, 
                              $this->uri->segment(3));
    }

    public function detalleBuzon($idBuzon)
    {
        return $this->db->get_where('buzon', ['id_buzon' => $idBuzon])->result();
    }

    public function paginas_mostra_personar($limit, $row)
    {
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->limit($limit, $row);
        $query = $this->db->get();
        return $query->result();
    }

}
