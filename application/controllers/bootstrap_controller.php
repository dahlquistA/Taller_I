<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bootstrap_controller extends CI_Controller
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
        if (!is_null($this->session->id)) {
            redirect('inicio_user');
        }
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('plantillas/nav');
        $this->load->view('contenido/inicio');
        $this->load->view('plantillas/footer');
    }

    public function filtro()
    {
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('plantillas/nav');
        $this->load->view('contenido/filtro');
        $this->load->view('plantillas/footer');
    }    

    public function quienes_somos()
    {
        if (!is_null($this->session->id)) {
            redirect('quienesSomos_user');
        }
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('plantillas/nav');
        $this->load->view('contenido/nosotros');
        $this->load->view('plantillas/footer');
    }

    public function comercializacion()
    {
        if (!is_null($this->session->id)) {
            redirect('comer_user');
        }
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('plantillas/nav');
        $this->load->view('contenido/comercializacion');
        $this->load->view('plantillas/footer');
    }

    public function contacto()
    {
        if (!is_null($this->session->id)) {
            redirect('contacto_user');
        }
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('plantillas/nav');
        $this->load->view('contenido/contacto');
        $this->load->view('plantillas/footer');
    }

    public function terminos_y_usos()
    {
        if (!is_null($this->session->id)) {
            redirect('terminos_y_usos_usuario');
        }
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('plantillas/nav');
        $this->load->view('contenido/terminos_y_usos');
        $this->load->view('plantillas/footer');
    }

    public function buscar($num_pagina = FALSE)
    {        
        $inicio = 0;
        $mostrarpor = 8;

        $busqueda = "";
        if ($this->session->userdata("buscador")){
            $busqueda = $this->session->userdata("buscador");
        }

        if ($num_pagina) {
            $inicio = ($num_pagina - 1) * $mostrarpor;
        }
        $config['base_url']    = base_url() . 'buscar/pagina/';
        $config['total_rows']  = count($this->filtro_model->buscar($busqueda));
        $config['per_page']    = $mostrarpor; //Número de registros a mostrar
        $config['uri_segment'] = 3; //el segmento de la paginación
        $config['num_links']   = 2; //Número de links a mostrar
        $config['use_page_numbers']   = TRUE;
        $config['first_url']   = base_url() . 'buscar';

        $this->pagination->initialize($config);

        $result             = $this->filtro_model->buscar_pagination($busqueda, $inicio, $mostrarpor);
        $query['producto']  = $result->result();
        $query['pagination'] = $this->pagination->create_links();

        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('plantillas/nav');
        $this->load->view('contenido/buscar', $query);
        $this->load->view('plantillas/footer');   
    }

    public function busqueda() 
    {
        $buscador = $this->input->post("buscar");
        $this->session->set_userdata("buscador", $buscador);
        redirect(base_url()."buscar");
    }

    public function buzon()
    {
        //$data['titulo'] = 'Consultas';
        $this->load->model('buzon_model'); /** CARGO MODELO DE CONSULTAS */

        $this->form_validation->set_rules('nombreB', 'Nombre', 'required|min_length[3]|max_length[15]',
            array(
                'required'   => 'El campo Nombre no puede quedar vacio.',
                'min_length' => 'El Nombre debe tener 3 caracteres como minimo.',
                'max_length' => 'El Nombre no debe superar los 15 caracteres.')
        );
        $this->form_validation->set_rules('apellidoB', 'Apellido', 'required|max_length[20]',
            array(
                'required'   => 'El campo Apellido no puede quedar vacio',
                'max_length' => 'El Apellido no debe superar los 15 caracteres.')
        );
        $this->form_validation->set_rules('emailB', 'Email', 'required|valid_email',
            array(
                'required'    => 'El campo Correo electrónico no puede quedar vacio.',
                'valid_email' => 'El campo  debe tener un e-mail válido. (Ejemplo:nombre@hotmail.com)')
        );

        $this->form_validation->set_rules('mensajeB', 'Mensaje', 'required|min_length[15]|max_length[160]',
            array(
                'required'   => 'El campo Mensaje no puede quedar vacio.',
                'min_length' => 'El Mensaje debe tener 15 caracteres como minimo.',
                'max_length' => 'El Mensaje no debe superar los 160 caracteres.')
        );

        if ($this->form_validation->run() == false) {
            return $this->contacto();
        } else {
            $data = array(/** CARGAMOS LOS DATOS OBTENIDOS EN EL FORMULARIO DE CONSULTAS */
                'nombre'   => $this->input->post('nombreB'),
                'apellido' => $this->input->post('apellidoB'),
                'email'    => $this->input->post('emailB'),
                'mensaje'  => $this->input->post('mensajeB'),
                'fecha'    => date("Y-m-d"),
                'estado'   => 1,
            );
            $this->buzon_model->alta_consulta($data); /** DAMOS DE ALTA UNA CONSULTA */
            echo "<script type=\"text/javascript\">alert('Su consulta se realizo con exito.');</script>";
        }
        $this->contacto();
    }
}
