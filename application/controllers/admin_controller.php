<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_controller extends CI_Controller
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
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/inicio');
        $this->load->view('plantillas/footer');
    }

    public function buzon()
    {
        $this->load->library('pagination'); //Se carga la librería de paginación

        $config['base_url'] = base_url() . 'admin_controller/buzon';

        $config['first_link']      = 'Primero';
        $config['last_link']       = 'Último';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '&laquo';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&raquo';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        //integratción con bootstrap
        $config['full_tag_open']  = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open']   = '<li class="active"><a href="#">';
        $config['cur_tag_close']  = '</a></li>';
        $config['num_tag_open']   = '<li>';
        $config['num_tag_close']  = '</li>';
        //$config['display_pages']  = false;
        $config['total_rows']  = $this->producto_model->num_post();
        $config['per_page']    = 6; //Número de registros a mostrar
        $config['num_links']   = 1; //Número de links a mostrar
        $config['uri_segment'] = 3; //el segmento de la paginación

        $this->pagination->initialize($config);

        $page          = $this->uri->segment(3);
        $data['buzon'] = $this->buzon_model->paginas_mostra_buzon(6, $page);

        $this->load->view('plantillas/head');
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/buzon', $data);
        $this->load->view('plantillas/footer');

    }

    public function listar_usuarios()
    {
        $this->load->library('pagination'); //Se carga la librería de paginación

        $config['base_url'] = base_url() . 'admin_controller/listar_usuarios';

        $config['first_link']      = 'Primero';
        $config['last_link']       = 'Último';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '&laquo';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&raquo';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<div>';
        $config['last_tag_close']  = '</div>';
        //integratción con bootstrap
        $config['full_tag_open']  = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open']   = '<li class="active"><a href="#">';
        $config['cur_tag_close']  = '</a></li>';
        $config['num_tag_open']   = '<li>';
        $config['num_tag_close']  = '</li>';
        //$config['display_pages']  = false;
        $config['total_rows']  = $this->producto_model->num_post();
        $config['per_page']    = 6; //Número de registros a mostrar
        $config['num_links']   = 2; //Número de links a mostrar
        $config['uri_segment'] = 3; //el segmento de la paginación

        $this->pagination->initialize($config);

        $page             = $this->uri->segment(3);
        $data['usuarios'] = $this->producto_model->paginas_mostra_personar(6, $page);

        $this->load->view('plantillas/head');
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/listar_usuarios', $data);
        $this->load->view('plantillas/footer');

    }

    public function usuarios_inactivos()
    {
        $this->load->model('usuario_model');
        $data['usuarios'] = $this->usuario_model->traerUsuarios();

        $this->load->view('plantillas/head');
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/usuarios_inactivos');
        $this->load->view('plantillas/footer');
    }

    public function ventas()
    {

        $data['compras'] = $this->pedido_model->select_pedidos();

        $this->load->view('plantillas/head');
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/historial_compras', $data);
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
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/mis_datos', $data);
        $this->load->view('plantillas/footer');
    }

    public function actualizar_admin($id) /*Hay q validar estos nuevos datos que se modifican*/
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
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/mi_clave', $data);
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

    public function baja()
    {
        $this->load->view('plantillas/head');
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/baja');
        $this->load->view('plantillas/footer');
    }

    public function hacer_admin()
    {
        $id = $this->input->post('admin');

        $this->load->model('Usuario_model');
        $this->Usuario_model->hacer_administrador($id);
        $this->listar_usuarios();
    }

    public function eliminar_consulta($id)
    {
        $this->load->model('buzon_model');
        $this->buzon_model->eliminar_consulta($id);
        $this->buzon();
    }

    //Llama a la funcion "activar_cuenta" del modelo del usuario y Activa (cambia de estado a '1') la cuenta del usuario
    public function activar()
    {
        $id = $this->input->post('activar');
        $this->load->model('Usuario_model');
        $this->Usuario_model->activar_cuenta($id);
        $this->listar_usuarios();
    }

    //Llama a la funcion "borrar_cuenta" del modelo del usuario y Borra (cambia de estado a '0') la cuenta del usuario
    public function borrar()
    {
        $id = $this->input->post('borrar');
        $this->Usuario_model->borrar_cuenta($id);
        $this->listar_usuarios();
    }

    public function vista_buzon()
    {
        $model           = new producto_model();
        $data['detalle'] = $model->detalleBuzon($this->input->post('id'));
        $this->load->view('contenido/admin/vista_buzon', $data);
    }

    public function mensaje_visto()
    {
        $id = $this->input->post('msjVisto');
        $this->buzon_model->mensaje_leido($id);
        $this->buzon();
    }

}
