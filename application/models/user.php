<?php

class User extends CI_Model {

    public function authenticate($email, $password) {
            $hash = $this->_prep_password($password);
            //var_dump($hash);die;
            $this->db->select('id,type,nombre,apellido');
            $Q = $this->db->get_where('administradores', array('email' => $email, 'hash' =>$hash));
          //var_dump($this->db->last_query());die;
            if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $user = $row;
                    
                }
                return $user;
            } else {
	 			$this->session->set_flashdata('message', 'Su usuario o password son incorrectos, intente nuevamente');
                return false;
            }
    }

    public function authenticate_cliente($email, $password) {
            $hash = $this->_prep_password($password);
            //var_dump($hash);die;
            $this->db->select('id,type ');
            $Q = $this->db->get_where('users', array('email' => $email, 'hash' =>$hash));
            if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $user = $row;
                    return $user;
                }
            } else {
				$this->session->set_flashdata('message', 'Su usuario o password son incorrectos, intente nuevamente');
                return false;
            }
    }

    public function _prep_password($password) {
        return sha1($password . $this->config->item('encryption_key'));
    }
    public function is_admin($id){
            
            $Q = $this->db->get_where('administradores', array('id' => $id));
            if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    
                    if($row->type==1 || $row->type == 10){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
    }
    
    public function get_all_admin(){
            $this->db->select('*');
            $Q = $this->db->get_where('users', array('type' => 1));
            if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $admin[] = $row;
                }
            }
            //var_dump($admin);die;
            if(isset($admin)){
                return $admin;
            }
    }
    
    
    public function get_users($indice=0, $busca = ''){
        $ind= $indice *10;
        $this->db->select('usuarios.*, barrios.titulo as barrio_titulo');
        $this->db->order_by('usuarios.id','desc');
        $this->db->from('usuarios');
        $this->db->join('barrios','barrios.id=usuarios.id_barrio','left');
        if($busca!=''){
            
            $this->db->like('titulo',urldecode($busca));
            $this->db->or_like('email',urldecode($busca));
            $this->db->or_like('apellido',urldecode($busca));
           
        }
        
        
        $this->db->limit(10,$ind);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $items[] = $row; 
                }
            }
        if(isset($items)){    
            return $items;   
        }
    }
    
    public function get_all_users($criterio=''){
        $this->db->select('usuarios.*');
        $this->db->from('usuarios');
        if($criterio!=''){
            $this->db->or_like('email',urldecode($criterio));       
        }
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $items[] = $row; 
                }
            }
        if(isset($items)){    
            return $items;   
        }
    }
    
    public function get_user($id){
        $data = array('id'=>$id);
        $Q = $this->db->get_where('usuarios',$data);
        if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $users = $row; 
                }
            }
        return $users;   
    }
    
    public function get_user_by_email($email){
        $data = array('email'=>$email);
        $Q = $this->db->get_where('usuarios',$data);
        if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $users = $row; 
                }
            }
        if(isset($users)){    
            return $users;   
        }else{
            return false;
        }
    }
    
    public function email_exists($email){
        $data = array('email'=>$email);
        $Q = $this->db->get_where('usuarios',$data);
        if ($Q->num_rows() > 0) {
                return true;
            }
        return false;   
    }
    
    
    public function registro_usuario(){
         $u = $this->input->post('user');   
         //$hash = $this->_prep_password($u['password']);
            $data = array(
                
                'email' => $u['email'],
                'nombre' => $u['nombre'],
                'apellido' => $u['apellido'],
                'telefono' => $u['telefono'],
                'mobil' => $u['mobil'],
                'id_barrio' => $u['barrio'],
                'lote' => $u['lote']
                
            );

            $this->db->insert('usuarios', $data);
           
    }
    
    public function editar_usuario(){
        $u = $this->input->post('user');
        $data = array(
                
                'email' => $u['email'],
                'nombre' => $u['nombre'],
                'apellido' => $u['apellido'],
                'telefono' => $u['telefono'],
                'mobil' => $u['mobil'],
                'id_barrio' => $u['barrio'],
                'lote' => $u['lote']
                
            );
        
        $this->db->where('id', $u['id']);
        $this->db->update('usuarios', $data);
        
    }
    
    public function borrar_usuario($id){
        $data = array('id'=>$id);
        $this->db->delete('users',$data);
    }

}
