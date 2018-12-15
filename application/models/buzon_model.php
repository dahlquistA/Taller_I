<?php

class Buzon_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function alta_consulta($data)
    {
        $this->db->insert('buzon', $data);
    }

    public function eliminar_consulta($id)
    {
        $this->db->from('buzon');
        $this->db->where('id_buzon', $id);
        $this->db->delete();
    }

    public function listar_consultas()
    {
        $this->db->select('*');
        $this->db->from('buzon');
        $this->db->order_by('id_buzon', 'desc');

        $query = $this->db->get();
        return $query->result();

    }

    public function mensaje_leido($id)
    {
        $this->db->where('id_buzon', $id);
        return $this->db->update('buzon', ['estado' => 0]);
    }

    public function paginas_mostra_buzon($limit, $row)
    {
        $this->db->select('*');
        $this->db->from('buzon');
        $this->db->order_by('id_buzon', 'desc');
        $this->db->limit($limit, $row);
        $query = $this->db->get();
        return $query->result();
    }

}
