<?php

class Venta extends CI_Model {

    
    
    
    public function get_ventas($indice=0, $busca = '') {
        $ind = $indice * 10;
        //$this->db->select('criterios_bar.id as id_crit,criterios_bar.criterio as criterio, stock_bar.*');
        
        if ($busca != '') {
            $this->db->like('criterio', $busca);
        }
        //$this->db->where('menu',1);
        $this->db->join('criterios_driving','criterios_driving.id=ventas.id_crit');
        $this->db->join('criterios_bar','criterios_bar.id=ventas.id_crit');
        $this->db->order_by('fecha','desc');
        
        $Q = $this->db->get('ventas');
        $pp=$this->db->last_query();
        //var_dump($pp);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $items[] = $row;
            }
        }
        if (isset($items)) {
            return $items;
        }
    }
    
    public function get_listado_d($indice=0, $busca = '') {
        $ind = $indice * 10;
        //$this->db->select('criterios_bar.id as id_crit,criterios_bar.criterio as criterio, stock_bar.*');
        
        if ($busca != '') {
            $this->db->like('criterio', $busca);
        }
        $this->db->where('menu',1);
        
        $Q = $this->db->get('criterios_driving');
        $pp=$this->db->last_query();
        //var_dump($pp);die;
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $items[] = $row;
            }
        }
        if (isset($items)) {
            return $items;
        }
    }
    
    public function get_all($indice=0, $busca = '') {
        
        $this->db->select('criterios_bar.id as id_crit,criterios_bar.criterio as criterio, stock_bar.*');
        if ($busca != '') {
            $this->db->like('criterio', $busca);
        }
        $this->db->order_by('criterios_bar.id', 'desc');
        $this->db->join('stock_bar','stock_bar.id_criterio=criterios_bar.id', 'left');
        $this->db->where('criterios_bar.tipo','ingreso');
        $this->db->where('menu','1');
        $Q = $this->db->get('criterios_bar');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $items[] = $row;
            }
        }
        if (isset($items)) {
            return $items;
        }
    }

    
    public function actualiza_cant($id=0,$cant=0){
       
        $data = array( 'cant'=>$cant );
        $this->db->where('id',$id);
        $this->db->update('stock_bar',$data);
    }
    
    
    public function actualiza_precio($id=0,$cant=0){
        $data = array( 'precio'=>$cant );
        $this->db->where('id',$id);
        $this->db->update('stock_bar',$data);
    }
    public function get_all_criterios_driving($criterio='') {
        if ($criterio != '') {
            $this->db->like('criterios_driving', $criterio);
        }
        $Q = $this->db->get('criterios_driving');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $items[] = $row;
            }
        }
        if (isset($items)) {
            return $items;
        }
    }

    public function get_criterios_bar($indice=0, $busca = '') {
        $ind = $indice * 10;
        if ($busca != '') {
            $this->db->like('criterio', $busca);
        }
        $this->db->order_by('criterios_bar.id', 'desc');
        $Q = $this->db->get('criterios_bar', 10, $ind);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $users[] = $row;
            }
        }
        if (isset($users)) {
            return $users;
        }
    }

    public function get_all_criterios_bar($criterio='') {
        if ($criterio != '') {
            $this->db->like('criterios_bar', $criterio);
        }
        $Q = $this->db->get('criterios_bar');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $cias[] = $row;
            }
        }
        if (isset($cias)) {
            return $cias;
        }
    }

    public function get_criterio($id) {
        $data = array('id' => $id);
        $Q = $this->db->get_where('criterios_driving', $data);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $cias = $row;
            }
        }
        if (isset($cias)) {
            return $cias;
        }
    }

    public function get_criterio_bar($id) {
        $data = array('id' => $id);
        $Q = $this->db->get_where('criterios_bar', $data);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $item = $row;
            }
        }

        if (isset($item)) {
            return $item;
        }
    }

    public function get_criterio_driving_name_by_id($id=0) {

        $data = array('id' => $id);
        $Q = $this->db->get_where('criterios_driving', $data);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $items = $row->criterio;
            }
        }
        if (isset($items)) {
            return $items;
        }
    }

    public function get_criterio_bar_name_by_id($id=0) {

        $data = array('id' => $id);
        $Q = $this->db->get_where('criterios_bar', $data);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $items = $row->criterio;
            }
        }
        if (isset($items)) {
            return $items;
        }
    }

    public function criterio_driving_exists($item) {
        $data = array('criterio' => $item);
        $Q = $this->db->get_where('criterios_driving', $data);
        if ($Q->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function criterio_bar_exists($item) {
        $data = array('criterio' => $item);
        $Q = $this->db->get_where('criterios_bar', $data);
        if ($Q->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function registro_criterios_driving($u) {


        $data = array(
            'criterio' => $u['criterio'],
            'comp' => $u['comp'],
            'tipo' => $u['tipo']
        );
        if (isset($u['almenu'])) {
            $data['menu'] = $u['almenu'];
        }

        $this->db->insert('criterios_driving', $data);
    }

    public function editar_criterios_driving() {
        $u = $this->input->post('item');

        $data = array(
            'criterio' => $u['criterio'],
            'comp' => $u['comp'],
            'tipo' => $u['tipo']
        );
        if (isset($u['almenu'])) {
            $data['menu'] = $u['almenu'];
        }
        $this->db->where('id', $u['id']);
        $this->db->update('criterios_driving', $data);
    }

    public function borrar_criterios_driving($id) {
        $data = array('id' => $id);

        $this->db->delete('criterios_driving', $data);
    }

    public function registro_criterio_bar($u) {


        $data = array(
            'criterio' => $u['criterio'],
            'comp' => $u['comp'],
            'tipo' => $u['tipo']
        );
        if (isset($u['almenu'])) {
            $data['menu'] = $u['almenu'];
        }
        $this->db->insert('criterios_bar', $data);
    }

    public function editar_criterios_bar() {
        $u = $this->input->post('item');

        $data = array(
            'criterio' => $u['criterio'],
            'comp' => $u['comp'],
            'tipo' => $u['tipo']
        );
        if (isset($u['almenu'])) {
            $data['menu'] = $u['almenu'];
        }
        $this->db->where('id', $u['id']);
        $this->db->update('criterios_bar', $data);
        //  $pp = $this->db->last_query();
        //var_dump($pp);die;
    }

    public function borrar_criterios_bar($id) {
        $data = array('id' => $id);

        $this->db->delete('criterios_bar', $data);
    }

}
