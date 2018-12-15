<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'bootstrap_controller/index';

//RUTAS DE LA BARRA DE NAVEGACION DEL CONTROLADOR BOOTSTRAP
$route['index']            = 'bootstrap_controller';
$route['productos']        = 'producto_controller/productos';
$route['productos/pagina/(:num)'] = 'producto_controller/productos/$1';
$route['quienes_somos']    = 'bootstrap_controller/quienes_somos';
$route['comercializacion'] = 'bootstrap_controller/comercializacion';
$route['contacto']         = 'bootstrap_controller/contacto';
$route['terminos_y_usos']  = 'bootstrap_controller/terminos_y_usos';
$route['registrate']       = 'cliente_controller/index';
$route['buscar']           = 'bootstrap_controller/buscar'; 
$route['buscar/pagina/(:num)']  = 'bootstrap_controller/buscar/$1'; 
$route['envCon']           = 'bootstrap_controller/buzon'; 
$route['busqueda']         = 'bootstrap_controller/busqueda'; 

//-----------------------------------------------------------------------------------//
//RUTAS DE LA BARRA DE NAVEGACION DEL CONTROLADOR USUARIO
$route['inicio_user']               = 'usuario_controller/index';
$route['quienesSomos_user']         = 'usuario_controller/quienes_somos';
$route['terminos_y_usos_usuario']   = 'usuario_controller/terminos_y_usos';
$route['comer_user']                = 'usuario_controller/comercializacion';
$route['contacto_user']             = 'usuario_controller/contacto';
$route['agrega_carrito']            = 'usuario_controller/agrega_carrito';
$route['mi_cuenta']                 = 'usuario_controller/mi_cuenta';
$route['eliminar_del_carrito']      = 'usuario_controller/eliminar_del_carrito';
$route['misDatos']                  = 'usuario_controller/mis_datos';
$route['actualizar_usuario/(:num)'] = 'usuario_controller/actualizar_usuario/$1';
$route['miCarrito']                 = 'carrito_controller/index';
$route['agregar_al_carrito']        = 'carrito_controller/agregar_al_carrito';
$route['historialMisCompras']       = 'usuario_controller/historial';
$route['vista_detalle']             = 'carrito_controller/vista_detalle';
$route['buscarProducto']            = 'usuario_controller/buscarProducto';
$route['catalogo']                  = 'producto_controller/paginacion';
$route['login']                     = 'login_controller/login';
$route['modifPass']                 = 'usuario_controller/mi_clave';
$route['actualizarPass/(:num)']     = 'usuario_controller/actualizar_contraseña/$1';
$route['consulta']                  = 'usuario_controller/contacto';
$route['sendCons']                  = 'usuario_controller/buzon_user';
$route['buscarCateg']               = 'producto_controller/buscar2';

$route['generarCompra'] = 'carrito_controller/generarCompra';

//------------------------------------------------------------------------------------//
//RUTAS DE LA BARRA DE NAVEGACION DEL CONTROLADOR ADMINISTRADOR
$route['inicio_admin']           = 'admin_controller/index';
$route['buzon']                  = 'admin_controller/buzon';
$route['alta_producto']          = 'producto_controller/index';
$route['listar_productos']       = 'producto_controller/listar_productos';
$route['listar_usuarios']        = 'admin_controller/listar_usuarios';
$route['usuarios_inactivos']     = 'admin_controller/usuarios_inactivos';
$route['facturacion']            = 'admin_controller/facturacion';
$route['ventas']                 = 'admin_controller/ventas';
$route['mis_datos']              = 'admin_controller/mis_datos';
$route['baja']                   = 'admin_controller/baja';
$route['carrito_admin']          = 'admin_controller/carrito';
$route['activar']                = 'admin_controller/activar';
$route['borrar']                 = 'admin_controller/borrar';
$route['historialCompras']       = 'admin_controller/ventas';
$route['actualizarDatos/(:num)'] = 'admin_controller/actualizar_admin/$1';
$route['actualizarClave/(:num)'] = 'admin_controller/actualizar_contraseña/$1';
$route['misDatosAdmin']          = 'admin_controller/mis_datos';
$route['modifClave']             = 'admin_controller/mi_clave';
$route['selectImg/(:num)']       = 'producto_controller/editar_imagen/$1';

$route['validarProducto'] = 'producto_controller/validar_registro_producto';

$route['actualizar/(:num)']    = 'producto_controller/actualizar_producto/$1';
$route['actualizarImg/(:num)'] = 'producto_controller/actualizar_imagen/$1';
//$route['editar/(:num)']     = 'producto_controller/editar_producto/$1';
$route['admin'] = 'admin_controller/hacer_admin';

$route['vista_buzon'] = 'admin_controller/vista_buzon';
$route['msjVisto']    = 'admin_controller/mensaje_visto';
//------------------------------------------------------------------------------------//
//RUTAS DEL REGISTRO Y DEL LOGIN
$route['validar_registro'] = 'cliente_controller/validar_registro';
$route['validInicio']      = 'login_controller/validar_inicio_sesion';
$route['salir']            = 'login_controller/cerrar_sesion';

//------------------------------------------------------------------------------------//

$route['404_override']         = '';
$route['translate_uri_dashes'] = false; 