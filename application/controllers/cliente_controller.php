<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente_controller extends CI_Controller
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
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('plantillas/nav');
        $this->load->view('contenido/registrarse');
        $this->load->view('plantillas/footer');
    }

    public function validar_registro()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[15]',
            array(
                'required'   => 'El campo Nombre no puede quedar vacio.',
                'min_length' => 'El Nombre debe tener 3 caracteres como minimo.',
                'max_length' => 'El Nombre no debe superar los 15 caracteres.')
        );
        $this->form_validation->set_rules('apellido', 'Apellido', 'required|max_length[20]',
            array(
                'required'   => 'El campo Apellido no puede quedar vacio',
                'max_length' => 'El Apellido no debe superar los 15 caracteres.')
        );
        $this->form_validation->set_rules('emailB', 'Email', 'required|valid_email|is_unique[persona.email]',
            array('required' => 'El campo Correo electrónico no puede estar vacio.',
                'valid_email'    => 'El campo Correo electrónico debe contener una dirección de correo electrónico válida.',
                'is_unique'      => 'El Correo ya existe')
        );
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|integer|max_length[15]',
            array('required' => 'El campo Teléfono no puede estar vacio.',
                'integer'        => 'El campo Teléfono debe contener solo números enteros.',
                'max_length'     => 'El Telefono no debe superar los 15 caracteres.')
        );
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[15]',
            array('required' => 'El campo Clave no puede estar vacio.',
                'min_length'     => 'La Clave debe tener 8 caracteres como minimo.',
                'max_length'     => 'La Clave no debe superar los 15 caracteres.')
        );
        $this->form_validation->set_rules('passconf', 'Passconf', 'required|matches[password]',
            array('required' => 'Este campo no puede quedar vacío.',
                'matches'        => 'Las contraseñas no coinciden.')
        );

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $this->insertar_cliente();
        }
    }

    /* Se inserta en variables los datos que se obtienen al "Crear Usuario Nuevo"*/
    public function insertar_cliente()
    {
        $nombre   = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $email    = $this->input->post('emailB');
        $telefono = $this->input->post('telefono');
        $password = $this->input->post('password');
        $passconf = $this->input->post('passconf');
        $perfil   = 2;

        $this->load->model('Cliente_model');
        $this->Cliente_model->guardar_cliente($nombre, $apellido, $email, $telefono, $password, $passconf, $perfil);

        $id_persona = $this->Cliente_model->recuperar_ultimo_id();

        $this->load->model('Usuario_model');
        $this->Usuario_model->guardar_usuario($email, $password, $id_persona);

        redirect('validInicio');
    }

}
