<?php

class Iconos extends CI_Model {

    public function get_iconos($indice=0, $busca = '') {
        $ind = $indice * 10;
        $Q = $this->db->get('iconos', 10, $ind);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $iconos[] = $row;
            }
        }
        if (isset($iconos)) {
            return $iconos;
        }
    }
    
    
    public function get_iconos_by_campa($id) {
        $this->db->where('id_campa',$id);
        $Q = $this->db->get('iconos');
        
        //var_dump($this->db->last_query());die;
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $iconos[] = $row;
            }
        }
        if (isset($iconos)) {
            return $iconos;
        }
    }

    public function get_all_iconos() {
        $Q = $this->db->get('iconos');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $iconos[] = $row;
            }
        }
        if (isset($iconos)) {
            return $iconos;
        }
    }
    
    public function get_all_iconos_campa($id) {
        $this->db->where('id_campa',$id);
        $Q = $this->db->get('iconos');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $iconos[] = $row;
            }
        }
        if (isset($iconos)) {
            return $iconos;
        }
    }

    public function get_icono($id) {
        $data = array('id' => $id);
        $Q = $this->db->get_where('iconos', $data);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $icono = $row;
            }
        }
        if(isset($icono)){
            return $icono;
        }
    }

    public function registro_icono() {
        $u = $this->input->post('iconos');
        if ($_FILES['userfile']['name'] != '') {
            $config['upload_path'] = './assets/iconos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            $subida = $this->upload->data();
            $config1['image_library'] = 'gd2';
            $config1['source_image'] = $subida['full_path'];
            $config1['maintain_ratio'] = TRUE;
            $config1['width'] = 16;
            $config1['height'] = 16;
            $this->load->library('image_lib', $config1);
            $this->image_lib->resize();
            $data = array(
                'icono' => $subida['file_name']
            );
        } else {
            $this->session->set_flashdata('message', 'El icono no se subio, intentelo nuevamente');
            redirect(base_url() . 'admin/admin/iconos', 'location');
        }
       
        
        $this->db->insert('iconos', $data);
    }

    public function editar_icono(){
        $u = $this->input->post('iconos');
        if ($_FILES['userfile']['name'] != '') {
            $config['upload_path'] = './assets/iconos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            $subida = $this->upload->data();
            $config1['image_library'] = 'gd2';
            $config1['source_image'] = $subida['full_path'];
            $config1['maintain_ratio'] = TRUE;
            $config1['width'] = 16;
            $config1['height'] = 16;
            $this->load->library('image_lib', $config1);
            $this->image_lib->resize();
            $data = array(
                'icono' => $subida['file_name']
            );
        } else {
            $this->session->set_flashdata('message', 'El icono no se subio, intentelo nuevamente');
            redirect(base_url() . 'admin/admin/iconos', 'location');
        }
        $icono = $this->iconos->get_icono($u['id']);
        if(is_file(base_url().'assets/iconos/'.$icono->icono)){
            unlink(base_url().'assets/iconos/'.$icono->icono);
        }
        $this->db->where('id',$u['id']);
        $this->db->update('iconos', $data);
    }
    
    public function borrar_icono($id) {
        $data = array('id'=>$id);
        $icono = $this->get_icono($id);
        if(is_file(base_url().'assets/iconos/'.$icono->icono)){
            unlink(base_url().'assets/iconos/'.$icono->icono);
        }
        $this->db->delete('iconos',$data);
    }

    public function registro_icono_campa() {
        $u = $this->input->post('iconos');
        $ancho = $this->input->post('ancho');
        $alto = $this->input->post('alto');
        $leyenda = $this->input->post('leyenda');
        $id_campa = $this->input->post('id_campa');
        //die(var_dump($ancho. ' - '.$alto));
        if ($_FILES['userfile']['name'] != '') {
            $config['upload_path'] = './assets/iconos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            $subida = $this->upload->data();
            $config1['image_library'] = 'gd2';
            $config1['source_image'] = $subida['full_path'];
            $config1['maintain_ratio'] = TRUE;
            $config1['width'] = (int)$ancho;
            $config1['height'] = (int)$alto;
            
            $this->load->library('image_lib', $config1);
            $this->image_lib->resize();
            $data = array(
                'icono' => $subida['file_name'],
                'alto' =>(int)$alto,
                'ancho' =>(int)$ancho,
                'leyenda' =>$leyenda,
                'id_campa' =>$id_campa
            );
        } else {
            $this->session->set_flashdata('message', 'El icono no se subio, intentelo nuevamente');
            redirect(base_url() . 'admin/admin/iconos', 'location');
        }
       
        
        $this->db->insert('iconos', $data);
    }
    
    public function editar_icono_campa(){
        $u = $this->input->post('iconos');
        $ancho = $this->input->post('ancho');
        $alto = $this->input->post('alto');
        $leyenda = $this->input->post('leyenda');
        $id_campa = $this->input->post('id_campa');
        //die(var_dump($ancho. ' - '.$alto));
        if ($_FILES['userfile']['name'] != '') {
            $config['upload_path'] = './assets/iconos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            $subida = $this->upload->data();
            $config1['image_library'] = 'gd2';
            $config1['source_image'] = $subida['full_path'];
            $config1['maintain_ratio'] = TRUE;
            $config1['width'] = (int)$ancho;
            $config1['height'] = (int)$alto;
            $this->load->library('image_lib', $config1);
            $this->image_lib->resize();
            $data = array(
                'icono' => $subida['file_name'],
                'alto' =>(int)$alto,
                'ancho' =>(int)$ancho,
                'leyenda' =>$leyenda,
                'id_campa' =>$id_campa
            );
        } else {
            $this->session->set_flashdata('message', 'El icono no se subio, intentelo nuevamente');
            redirect(base_url() . 'admin/admin/iconos', 'location');
        }
        $icono = $this->iconos->get_icono($u['id']);
        if(is_file(base_url().'assets/iconos/'.$icono->icono)){
            unlink(base_url().'assets/iconos/'.$icono->icono);
        }
        $this->db->where('id',$u['id']);
        $this->db->update('iconos', $data);
        //var_dump($this->db->last_query());die;
    }
    

}
