<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente_model extends CI_Model
{
    /*Crea un arreglo y guarda en variables los valores pasados por parametros del controlador, se inserta ese arreglo en la base de datos en la tabla "persona"*/
    public function guardar_cliente($nombre, $apellido, $email, $telefono, $password, $passconf, $perfil)
    {
        $data = array(
            'nombre'    => $nombre,
            'apellido'  => $apellido,
            'email'     => $email,
            'telefono'  => $telefono,
            'password'  => md5($password),
            'passconf'  => md5($passconf),
            'id_perfil' => $perfil,
        );
        $this->db->insert('persona', $data);
    }

    /*En una variable se guarda el ID del ultimo usuario creado*/
    public function recuperar_ultimo_id()
    {
        $id_persona = $this->db->insert_id();
        return $id_persona;
    }

    /*public function consultar_cliente($email, $password)
{
return $this->db->get_where('usuario', ['email' => $email, 'password' => $password])->result();
}*/

}
