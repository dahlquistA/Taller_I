<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos_controler extends CI_Controller
{
   public function __construct()
    {
        parent::__construct();
        $this->load->model('buzon_model');
        $this->load->model('carrito_model');
        $this->load->model('cliente_model');
        $this->load->model('filtro_model');
        $this->load->model('login_model');
        $this->load->model('pedido_model');
        $this->load->model('producto_model');
        $this->load->model('Usuario_model');
        $this->load->library('pagination');
        $this->load->helper('url');
    }

    public function listar_pedidos()
    {
        $data['pedidos'] = $this->pedidos_model->select_pedidos();
        $this->load->view('plantillas/header');
        $this->load->view('pedidos/listar_pedidos_view', $data);
        $this->load->view('plantillas/footer');
    }

    public function seleccionar_pedidos_por_id($id = null)
    {
        $data['pedidos'] = $this->pedidos_model->select_pedidos_id($id);
        $this->load->view('plantillas/head');
        $this->load->view('pedidos/listar_pedidos_detalle_view', $data);
        $this->load->view('plantillas/footer');
    }

}
