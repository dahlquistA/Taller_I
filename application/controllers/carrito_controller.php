<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carrito_controller extends CI_Controller
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

    public function index()
    {
        if (!$this->cart->contents()) {
            $data['message'] = 'El carrito está vacío!';
        } else {
            $data['message'] = '';
        }
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/carrito/carrito_view', $data);
        $this->load->view('plantillas/footer');
    }

    public function agregar_al_carrito()
    {
        $this->load->model('producto_model');
        $producto = $this->producto_model->select_producto($this->input->post('id'));

        $data = array(
            'id'      => $producto[0]->id_producto,
            'qty'     => 1,
            'price'   => $producto[0]->precio,
            'name'    => $producto[0]->descripcion,
            'options' => array('codigo' => $producto[0]->codigo),
        );

        $this->cart->insert($data);
        $this->index();
    }

    public function generarCompra()
    {
        $compra   = new Carrito_model();
        $producto = new Producto_model();

        $usuario = array(
            'id_persona' => $this->session->userdata('id'),
            'fecha'      => date('Y-m-d H:i:s'),
        );

        if ($compra->nuevaCompra($usuario)) {
            $id = $this->db->insert_id();

            foreach ($this->cart->contents() as $item) {
                $data = array(
                    'id_compra'   => $id,
                    'id_producto' => $item['id'],
                    'cantidad'    => $item['qty'],
                    'precio'      => $item['price'],
                );

                if ($compra->nuevoDetalle($data)) {
                    $prod            = $producto->producto($item['id']);
                    $cant_disponible = $prod->stock - $item['qty'];

                    $data = array(
                        'id_producto' => $item['id'],
                        'stock'       => $cant_disponible,
                    );

                    $producto->editar($data);
                    $this->cart->destroy();
                }

            }
        } else {
            echo "<script type=\"text/javascript\">alert('No se puede comprar porque supera el stock!');</script>";
        }
        echo "<script type=\"text/javascript\">alert('Gracias por su compra!');</script>";
        $this->index();

    }

    public function misCompras()
    {
        $this->load->model('carrito_model');

        $usuario = $this->session->userdata('id');
        $this->carrito_model('traerCompras', $usuario->id);
    }

    public function realizar_pedido()
    {
        $this->load->view('carrito/comprar_carrito_view');
    }

    public function eliminar_del_carrito()
    {
        $this->cart->remove($this->input->post('id'));
        $this->mi_carrito();
    }

    public function borrar($id)
    {
        if ($id == "all") {
            $this->cart->destroy();
        } else {
            $data = array(
                'rowid' => $id,
                'qty'   => 0,
            );
            $this->cart->update($data);
        }
        redirect('carrito_controller');
    }

    public function vista_detalle()
    {

        $model           = new producto_model();
        $data['detalle'] = $model->detalle($this->input->post('id'));
        $this->load->view('contenido/usuario/ver_detalle', $data);
    }

}
