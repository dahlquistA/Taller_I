<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Filtro_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function buscar($data)
    {
        //$this->db->where('nombre', $data)       
        $this->db->like('descripcion', $data);
        return $this->db->get('producto')->result();
    }    

   /* public function buscar2($data, $number_per_page)
    {
        //$this->db->or_like('nombre', '%$data');
        $this->db->or_like('descripcion', '%$data%');
        return $this->db->get("producto", $number_per_page, $this->uri->segment(3));
    }*/

    public function paginas_mostrar($limit, $row)
    {
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->limit($limit, $row);
        $this->db->join('categoria', 'categoria.categoria_id = producto.categoria_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function num_post($data)
    {
        $number = $this->db->query("SELECT count('$data') as number FROM producto")->row()->number;
        return intval($number);
    }

    public function buscar_pagination($data, $inicio = FALSE, $cantidad = FALSE)
    {
        $this->db->like('descripcion', $data); //$this->db->or_like('descripcion', $data);

        if ($inicio !== FALSE && $cantidad !== FALSE) {
            $this->db->limit($cantidad, $inicio);
        }
        return $this->db->get('producto');
    }




}
