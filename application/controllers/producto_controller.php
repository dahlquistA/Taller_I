<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Producto_controller extends CI_Controller
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
        $data['categoria'] = $this->producto_model->select_categoria();
        $this->load->view('plantillas/head');
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/alta_productos', $data);
        $this->load->view('plantillas/footer');
    }

    public function listar_productos()
    {
        $this->load->library('pagination'); //Se carga la librería de paginación

        $config['base_url'] = base_url() . 'producto_controller/listar_productos';

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
        $config['per_page']    = 8; //Número de registros a mostrar
        $config['num_links']   = 3; //Número de links a mostrar
        $config['uri_segment'] = 3; //el segmento de la paginación

        $this->pagination->initialize($config);

        $page              = $this->uri->segment(3);
        $data['productos'] = $this->producto_model->paginas_mostrar(8, $page);

        $data['categorias'] = $this->producto_model->select_categoria();

        $this->load->view('plantillas/head');
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/listar_productos', $data);
        $this->load->view('plantillas/footer');

    }

    public function buscar2()
    {
        $datas = $this->input->post('buscar');

        $query['productos']  = $this->filtro_model->buscar($datas);
        $query['categorias'] = $this->producto_model->select_categoria();

        if ($query['productos'] == null) {
            $query['productos'] = $this->producto_model->traerProductos();

            $this->load->view('plantillas/head');
            $this->load->view('contenido/admin/nav');
            $this->load->view('contenido/admin/listar_productos', $query);
            $this->load->view('plantillas/footer');
        } else {

            $this->load->view('plantillas/head');
            $this->load->view('contenido/admin/nav');
            $this->load->view('contenido/admin/listar_productos', $query);
            $this->load->view('plantillas/footer');
        }
    }

    public function editar_producto($id)
    {
        $query = $this->producto_model->select_producto($id);

        $data['id_producto'] = $query[0]->id_producto;
        $data['codigo']      = $query[0]->codigo;
        $data['nombre']      = $query[0]->nombre;
        $data['precio']      = $query[0]->precio;
        $data['stock']       = $query[0]->stock;
        $data['descripcion'] = $query[0]->descripcion;
        $data['imagen']      = $query[0]->img;
        $data['categoria']   = $this->producto_model->select_categoria();
        $data['cat_select']  = $query[0]->categoria_id;

        $this->load->view('plantillas/head');
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/editar_producto', $data);
        $this->load->view('plantillas/footer');
    }

    public function actualizar_producto($id) /*Hay q validar estos nuevos datos que se modifican*/
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required',
            array('required' => 'El campo Nombre no puede quedar vacio')
        );
        $this->form_validation->set_rules('precio', 'Precio', 'required|decimal',
            array(
                'required' => 'El campo Precio no puede estar vacio.',
                'decimal'  => 'Debe ingresar valores con decimales. (Ejemplo: 00.00)')
        );
        $this->form_validation->set_rules('stock', 'Stock', 'required|integer',
            array(
                'required' => 'El campo %s no puede quedar vacio.',
                'integer'  => 'El campo %s debe poseer solo numeros enteros')
        );
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required',
            array('required' => 'El campo Descripcion no puede quedar vacío.')
        );
        $this->form_validation->set_rules('categoria', 'Categoria', 'required|callback_select_validate',
            array('required' => 'Debe seleccionar una opcion.')
        );

        if ($this->form_validation->run() == false) {
            $this->editar_producto($id);
        } else {
            $data = array(
                'nombre'       => $this->input->post('nombre'),
                'precio'       => $this->input->post('precio'),
                'stock'        => $this->input->post('stock'),
                'descripcion'  => $this->input->post('descripcion'),

                'categoria_id' => $this->input->post('categoria'));

            $this->producto_model->actualizar_producto($data, $id);
            echo "<script type=\"text/javascript\">alert('Modificacion exitosa!');</script>";
            $this->listar_productos();
        }
    }

    public function editar_imagen($id)
    {
        $query = $this->producto_model->select_producto($id);

        $data['id_producto'] = $query[0]->id_producto;
        $data['codigo']      = $query[0]->codigo;
        $data['nombre']      = $query[0]->nombre;
        $data['precio']      = $query[0]->precio;
        $data['stock']       = $query[0]->stock;
        $data['descripcion'] = $query[0]->descripcion;
        $data['imagen']      = $query[0]->img;
        $data['categoria']   = $this->producto_model->select_categoria();
        $data['cat_select']  = $query[0]->categoria_id;

        //$data['img_select']  = $this->producto_model->select_categoria();

        $this->load->view('plantillas/head');
        $this->load->view('contenido/admin/nav');
        $this->load->view('contenido/admin/editar_imagen', $data);
        $this->load->view('plantillas/footer');
    }

    public function actualizar_imagen($id) /*Hay q validar estos nuevos datos que se modifican*/
    {
        $this->form_validation->set_rules('imagen', 'Imagen', 'callback_validar_imagen');

        if ($this->form_validation->run() == false) {
            $this->editar_imagen($id);
        } else {
            $data = array('img' => $_FILES['imagen']['name']);

            $this->producto_model->actualizar_producto($data, $id);
            echo "<script type=\"text/javascript\">alert('Modificacion exitosa!');</script>";
            $this->editar_producto($id);
        }
    }

    public function validar_registro_producto()
    {
        $this->form_validation->set_rules('codigo', 'Codigo', 'required|is_unique[producto.codigo]',
            array(
                'required'  => 'El campo Codigo no puede quedar vacio.',
                'is_unique' => 'El producto ya existe en la base de datos. Por favor ingrese otro diferente.')
        );
        $this->form_validation->set_rules('nombre', 'Nombre', 'required',
            array('required' => 'El campo Nombre no puede quedar vacio')
        );
        $this->form_validation->set_rules('precio', 'Precio', 'required|decimal',
            array(
                'required' => 'El campo Precio no puede estar vacio.',
                'decimal'  => 'Debe ingresar valores con decimales.')
        );
        $this->form_validation->set_rules('stock', 'Stock', 'required|integer',
            array(
                'required' => 'El campo %s no puede quedar vacio.',
                'integer'  => 'El campo %s debe poseer solo numeros enteros')
        );
        $this->form_validation->set_rules('categoria', 'Categoria', 'required|callback_select_validate',
            array('required' => 'Debe seleccionar una opcion o categoria.')
        );
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required',
            array('required' => 'El campo Descripcion no puede quedar vacío.')
        );

        $this->form_validation->set_rules('imagen', 'Imagen', 'callback_validar_imagen');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $this->guardar_producto();
            echo "<script type=\"text/javascript\">alert('Producto cargado con EXITO!');</script>";
            $this->index();
        }
    }

    public function guardar_producto()
    {
        $config['upload_path']   = './uploads/imagenes_producto';
        $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
        $config['remove_spaces'] = true;
        $config['max_size']      = '1024';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imagen')) {
            echo "<script type=\"text/javascript\">alert('No se pudo cargar el archivo');</script>";
            $this->index();
        } else {

            $data = array(
                'codigo'       => $this->input->post('codigo'),
                'nombre'       => $this->input->post('nombre'),
                'precio'       => $this->input->post('precio'),
                'stock'        => $this->input->post('stock'),
                'descripcion'  => $this->input->post('descripcion'),
                'img'          => $_FILES['imagen']['name'],
                'estado'       => 1,
                'categoria_id' => $this->input->post('categoria'));

            $this->producto_model->guardar_producto($data);}
    }

// verifica que se selecciono una categoria del libro
    public function select_validate($categoria)
    {
        if ($categoria == 0) {
            $this->form_validation->set_message('select_validate', 'Seleccione una categoria');
            return false;
        } else {
            return true;
        }
    }

//Verifica que se ingreso una imagen
    public function validar_imagen($imagen)
    {
        $imagen = $_FILES['imagen']['name']; //Obtiene el nombre de la imagen

        if (empty($imagen)) {
            $this->form_validation->set_message('validar_imagen', '* Debe seleccionar una imagen');
            return false;
        } else {
            return true;}
    }

    public function eliminar_producto($id)
    {
        $data = array(
            'estado' => '0',
        );
        $this->producto_model->actualizar_producto($data, $id);
        $this->listar_productos();
    }

    public function activar_producto($id)
    {
        $data = array(
            'estado' => '1',
        );
        $this->producto_model->actualizar_producto($data, $id);
        $this->listar_productos();
    }

    public function productos($num_pagina = FALSE)
    {
        $inicio = 0;
        $mostrarpor = 8;
        
        if ($num_pagina) {
            $inicio = ($num_pagina - 1) * $mostrarpor;
        }

        $config['base_url']    = base_url() . 'productos/pagina/';
        $config['total_rows']  = $this->producto_model->num_post();
        $config['per_page']    = 8; //Número de registros a mostrar
        $config['uri_segment'] = 3; //el segmento de la paginación
        $config['num_links']   = 3; //Número de links a mostrar
        
        $config['first_url']   = base_url() . 'productos';

        $this->pagination->initialize($config);

        $result             = $this->producto_model->get_pagination($config['per_page']);
        $data['productos']  = $result->result();
        $data['pagination'] = $this->pagination->create_links();

        //$page              = $this->uri->segment(3);
        //$data['productos'] = $this->producto_model->paginas_mostrar(8, $page);

        if (is_null($this->session->id)) {

            $this->load->view('plantillas/head');
            $this->load->view('plantillas/header');
            $this->load->view('plantillas/nav');
            $this->load->view('contenido/productos', $data);
            $this->load->view('plantillas/footer');

        } else {

            $this->load->view('plantillas/head');
            $this->load->view('plantillas/header');
            $this->load->view('contenido/usuario/nav_usuario');
            $this->load->view('contenido/usuario/productos', $data);
            $this->load->view('plantillas/footer');
        }

    }

}  
