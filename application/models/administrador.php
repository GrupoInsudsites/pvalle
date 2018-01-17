<?php

class Administrador extends CI_Model {

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
            $Q = $this->db->get_where('administradores', array('email' => $email, 'hash' =>$hash));
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
            $Q = $this->db->get_where('administradores', array('type' => 1));
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
        $this->db->select('administradores.*, clientes.cia');
        $this->db->order_by('administradores.id','desc');
        $this->db->from('users');
        
        if($busca!=''){
        
            $this->db->or_like('email',urldecode($busca));
           ////falta!!!!!!!!!
        }
        if($this->session->userdata('type')!=10){
            $this->db->where('type <','9');
            $this->db->where('type !=','1');
            
        }
        
        $this->db->limit(10,$ind);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $users[] = $row; 
                }
            }
        if(isset($users)){    
            return $users;   
        }
    }
    
    public function get_all_users($criterio=''){
        $this->db->select('administradores.*, clientes.cia');
        $this->db->from('administradores');
        
        
        if($criterio!=''){
        
            $this->db->or_like('email',urldecode($criterio));
        
        }
       
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $users[] = $row; 
                }
            }
        if(isset($users)){    
            return $users;   
        }
    }
    
    public function get_user($id){
        $data = array('id'=>$id);
        $Q = $this->db->get_where('administradores',$data);
        if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $users = $row; 
                }
            }
        return $users;   
    }
    
    public function get_user_by_email($email){
        $data = array('email'=>$email);
        $Q = $this->db->get_where('administradores',$data);
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
        $Q = $this->db->get_where('administradores',$data);
        if ($Q->num_rows() > 0) {
                return true;
            }
        return false;   
    }
    public function get_all_clients($criterio=''){
        if($criterio !=''){
            //$this->db->like('company',$criterio);
            //$this->db->or_like('email',$criterio);
        }
        
        $Q = $this->db->get('clientes');
        if ($Q->num_rows() > 0) {
                foreach ($Q->result() as $row) {
                    $users[] = $row; 
                }
            }
        if(isset($users)){    
            return $users;   
        }
    }
    
    public function registro(){
         $u = $this->input->post('user');   
         $hash = $this->_prep_password($u['password']);
            $data = array(
                
                'email' => $u['email'],
                'nombre' => $u['nombre'],
                'apellido' => $u['apellido'],
                'password' => $u['password'],
                'hash' => $hash
            );

            $this->db->insert('administradores', $data);
           
    }
    
    public function edicion(){
        $u = $this->input->post('user');
        $hash = $this->_prep_password($u['password']);
        $data = array(
                
                'email' => $u['email'],
                'nombre' => $u['nombre'],
                'apellido' => $u['apellido'],
                'password' => $u['password'],
                'hash' => $hash
            );
        $this->db->where('id', $u['id']);
        $this->db->update('administradores', $data);
        
    }
    
    public function borrar($id){
        $data = array('id'=>$id);
        $this->db->delete('administradores',$data);
    }

}
