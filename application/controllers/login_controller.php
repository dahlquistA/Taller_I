<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
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
        $this->load->view('contenido/login');
        $this->load->view('plantillas/footer');
    }

    public function login()
    {
        $this->load->view('plantillas/head');
        $this->load->view('plantillas/header');
        $this->load->view('plantillas/nav');
        $this->load->view('contenido/login');
        $this->load->view('plantillas/footer');
    }

    /*Aca se valida que los datos sean correctos.*/
    public function validar_inicio_sesion()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_existe_correo',
            array(
                'required'    => 'El campo Correo electrónico no puede estar vacio.',
                'valid_email' => 'El campo Correo electrónico debe contener una dirección de correo electrónico válida.')
        );

        /* Aca en "callback_existe_en_database" llama a una regla de validacion propia*/
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]|callback_existe_en_database',
            array(
                'required'   => 'El campo Clave no puede estar vacio.',
                'min_length' => 'La Clave debe tener 5 caracteres como minimo.',
                'max_length' => 'La Clave no debe superar los 15 caracteres.')
        );

        if ($this->form_validation->run() == false) {
            $this->login();

        } else {
            //Una vez q este todo ok, va a llamar a "usuario_logueado":
            $this->usuario_logueado();
        }
    }

    public function usuario_logueado()
    {
        if ($this->session->userdata('login')) {

            $perfil_usuario = $this->session->userdata('perfil');

            //SE VERIFICA EL PERFIL DEL USUARIO PARA REDIRECCIONAR A LA PAGINA CORRESPONDIENTE
            switch ($perfil_usuario) {
                case '1':
                    redirect('admin_controller');
                    break;
                case '2':
                    redirect('inicio_user');
                    break;
            }
        }
    }

/* Esta regla de validacion llama al modelo para que consulte en la base de datos si existe el correo ingresado.*/
    public function existe_correo()
    {
        $data = array(
            'email' => $this->input->post('email'));

        $this->load->model('Usuario_model');
        $dato_usuario = $this->Usuario_model->consultar_persona($data);

        if (empty($dato_usuario)) {
            $this->form_validation->set_message('existe_correo', 'El Correo no existe');
            return false;
        } else {
            return true;
        }
    }

/* Esta regla de validacion llama al modelo para que consulte en la base de datos si existe la contraseña ingresada.*/
    public function existe_en_database()
    {
        $data = array(
            'email'    => $this->input->post('email'),
            'password' => md5($this->input->post('password')));

        $this->load->model('Usuario_model');
        $dato_usuario = $this->Usuario_model->consultar_persona($data);

        if ($dato_usuario) {
            if (!empty($dato_usuario) && ($dato_usuario->email == $data['email']) && ($dato_usuario->password == $data['password'])) {

                $session_usuario = array(
                    'id'       => $dato_usuario->id_persona,
                    'nombre'   => $dato_usuario->nombre,
                    'apellido' => $dato_usuario->apellido,
                    'email'    => $dato_usuario->email,
                    'telefono' => $dato_usuario->telefono,
                    'perfil'   => $dato_usuario->id_perfil,
                );

                $this->session->set_userdata($session_usuario);

                $this->session->set_flashdata('login_success', 'AHORA ESTAS CONECTADO');

                redirect('inicio_user');

                return true;

            } else {
                //Si no concuerda la contraseña, retorna el msj de error correspondiente:
                $this->form_validation->set_message('existe_en_database', 'La contraseña es invalida');
                return false;
            }
        } else {
            //Este mensaje me toca colocar para que no genere error en el "callback_existe_en_database"
            $this->form_validation->set_message('existe_en_database', 'Por favor, intente nuevamente');
            return false;
        }
    }

    public function cerrar_sesion()
    {
        $this->session->sess_destroy();
        redirect(site_url());
    }

}
/* End of file login_controller.php */
/* Location: ./application/controllers/back/login_controller.php */
