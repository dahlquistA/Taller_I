<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_controller extends CI_Controller
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
        if ($this->session->userdata('perfil') == 1) {
            redirect('buzon');
        }
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/inicio');
        $this->load->view('plantillas/footer');
    }

    public function catalogo()
    {
        $data['productos'] = $this->producto_model->traerProductos();

        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/usuario/productos', $data);
        $this->load->view('plantillas/footer');
    }

    public function quienes_somos()
    {
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/nosotros');
        $this->load->view('plantillas/footer');
    }

    public function comercializacion()
    {
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/comercializacion');
        $this->load->view('plantillas/footer');
    }

    public function contacto()
    {
        if ($this->session->userdata('perfil') == 1) {
            redirect('contacto_admin');
        }
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/usuario/contacto');
        $this->load->view('plantillas/footer');
    }

    public function buzon_user()
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
            );
            $this->buzon_model->alta_consulta($data); /** DAMOS DE ALTA UNA CONSULTA */
            echo "<script type=\"text/javascript\">alert('Su consulta se realizo con exito.');</script>";
        }
        $this->contacto();
    }

    public function terminos_y_usos()
    {
        if ($this->session->userdata('perfil') == 1) {
            redirect('terminos_admin');
        }
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/terminos_y_usos');
        $this->load->view('plantillas/footer');
    }

    public function historial()
    {
        $this->load->model('pedido_model');
        $data['compras'] = $this->pedido_model->select_compras_id();

        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/usuario/historial', $data);
        $this->load->view('plantillas/footer');
    }

    public function buscarProducto()
    {
        $data = $this->input->post('busca');
        
        $query['producto'] = $this->filtro_model->buscar($data);

        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/usuario/buscar_user', $query);
        $this->load->view('plantillas/footer');

    }

    public function mis_datos()
    {
        $id = $this->session->userdata('id');
        $this->load->model('usuario_model');
        $query = $this->usuario_model->select_usuario($id);

        $data['id_persona'] = $query[0]->id_persona;
        $data['nombre']     = $query[0]->nombre;
        $data['apellido']   = $query[0]->apellido;
        $data['email']      = $query[0]->email;
        $data['telefono']   = $query[0]->telefono;

        $this->load->view('plantillas/head');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/usuario/mis_datos', $data);
        $this->load->view('plantillas/footer');
    }

    public function actualizar_usuario($id) /*Hay q validar estos nuevos datos que se modifican*/
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required',
            array('required' => 'El campo Nombre no puede estar vacio.')
        );
        $this->form_validation->set_rules('apellido', 'Apellido', 'required',
            array('required' => 'El campo Nombre no puede estar vacio')
        );
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
            array('required' => 'El campo Correo electrónico no puede estar vacio.',
                'valid_email'    => 'El campo Correo electrónico debe contener una dirección de correo electrónico válida. (Ejemplo: nombre@hotmail.com)',
                'is_unique'      => 'El Correo ya se encuentra registrado')
        );
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|integer',
            array(
                'required' => 'El campo Teléfono no puede estar vacio.',
                'integer'  => 'El campo Teléfono debe contener solo números enteros.')
        );

        if ($this->form_validation->run() == false) {
            $this->mis_datos();
        } else {

            $data = array(
                'nombre'   => $this->input->post('nombre'),
                'apellido' => $this->input->post('apellido'),
                'email'    => $this->input->post('email'),
                'telefono' => $this->input->post('telefono'));

            $this->load->model('Usuario_model');
            $this->Usuario_model->actualizar_usuario($data, $id);
            $this->guardar_email($id);

            echo "<script type=\"text/javascript\">alert('Ha modificado su cuenta con exito!');</script>";
            $this->mis_datos();
        }
    }

    public function mi_clave()
    {
        $id = $this->session->userdata('id');
        $this->load->model('usuario_model');
        $query = $this->usuario_model->select_usuario($id);

        $data['id_persona'] = $query[0]->id_persona;
        $data['email']      = $query[0]->email;
        $data['password']   = $query[0]->password;

        $this->load->view('plantillas/head');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/usuario/mi_clave', $data);
        $this->load->view('plantillas/footer');
    }

    public function actualizar_contraseña($id) /*Hay q validar estos nuevos datos que se modifican*/
    {
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[15]',
            array(
                'required'   => 'El campo Clave no puede estar vacio.',
                'min_length' => 'La Clave debe tener 8 caracteres como minimo.',
                'max_length' => 'La Clave no debe superar los 15 caracteres.')
        );
        $this->form_validation->set_rules('passconf', 'Passconf', 'required|matches[password]',
            array(
                'required' => 'Este campo no puede quedar vacío.',
                'matches'  => 'Las contraseñas no coinciden.')
        );
        if ($this->form_validation->run() == false) {
            $this->mi_clave();
        } else {

            $data = array(
                'password' => md5($this->input->post('password')));

            $this->load->model('Usuario_model');
            $this->Usuario_model->actualizar_usuario($data, $id);
            $this->guardar_clave($id);

            echo "<script type=\"text/javascript\">alert('Modificacion exitosa!');</script>";
            $this->mis_datos();
        }
    }

    public function guardar_clave($id)
    {
        $data = array(
            'password' => md5($this->input->post('password')),
        );
        $this->load->model('Usuario_model');
        $this->Usuario_model->guardar_usuario_modificado($data, $id);
    }

    public function guardar_email($id)
    {
        $data = array(
            'email' => $this->input->post('email'),
        );
        $this->load->model('Usuario_model');
        $this->Usuario_model->guardar_usuario_modificado($data, $id);
    }

    public function modificar() //Modifica los datos del usuario

    {
        $data = array(
            'nombre'   => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'email'    => $this->input->post('email'),
            'telefono' => $this->input->post('telefono'),
            'password' => md5($this->input->post('password')),
            'passconf' => md5($this->input->post('passconf')),
            'id'       => $this->session->userdata('id'));

        $this->load->model('usuario_model');
        $this->usuario_model->modificar_cuenta($data);
    }

    public function mi_carrito()
    {
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('contenido/usuario/nav_usuario');
        $this->load->view('contenido/usuario/carrito');
        $this->load->view('plantillas/footer');
    }

}
