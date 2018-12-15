 <?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{

    //Guarda en la tabla de usuario el nuevo cliente registrado
    public function guardar_usuario($email, $password, $id_persona)
    {
        $data = array(
            'email'      => $email,
            'password'   => md5($password),
            'id_persona' => $id_persona);

        $this->db->insert('usuario', $data);
    }

    public function consultar_usuario($email, $password)
    {
        return $this->db->get_where('usuario', ['email' => $email, 'password' => $password])->result();
    }

    public function consultar_persona($data)
    {
        $email = $data['email'];
        if ($query = $this->db->query("SELECT * FROM persona WHERE email = '$email'")) {
            $retorno = $query->row();
        } else {
            $retorno = false;
        }
        return $retorno;
    }

    public function select_usuario($id)
    {
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->where('id_persona', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function actualizar_usuario($data, $id)
    {
        $this->db->where('id_persona', $id);
        return $this->db->update('persona', $data);
    }

    public function guardar_usuario_modificado($data, $id)
    {
        $this->db->where('id_persona', $id);
        return $this->db->update('usuario', $data);
    }

    // Funcion que trae el arreglo de cada fila de "persona"
    public function traerUsuarios()
    {
        return $this->db->get('persona')->result();
    }

    public function activar_cuenta($data)
    {
        $this->db->where('id_persona', $data);
        return $this->db->update('persona', ['estado' => 1]);
    }

    public function borrar_cuenta($data)
    {
        $this->db->where('id_persona', $data); //el where trae todo el arreglo de la tabla "persona" cuando el id_persona = $data
        return $this->db->update('persona', ['estado' => 0]);
    }

    public function modificar_cuenta($data)
    {
        $this->db->where('id_persona', $data['id']); //
        return $this->db->update('persona', $data);
    }

    public function hacer_administrador($id)
    {
        $this->db->where('id_persona', $id);
        return $this->db->update('persona', ['id_perfil' => 1]);

    }

}
