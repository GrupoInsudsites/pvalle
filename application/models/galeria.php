<?php
class Galeria extends CI_Model {

    public function registro($u) {
        $data = array(
            'titulo' => $u['titulo'],
            'texto' => $u['texto'],
            'tipo' => $u['tipo']
            
        );
        $this->db->insert('galerias', $data);
    }

    public function edicion() {
        $u = $this->input->post('item');
        
            $data = array(
            'titulo' => $u['titulo'],
            'texto' => $u['texto'],
            'tipo' => $u['tipo']
        
        );
        $this->db->where('id', $u['id']);
        $this->db->update('galerias', $data);
    }

    public function borrar_galeria($id) {
        $data = array('id' => $id);
        $this->db->delete('galerias', $data);
    }
    
    
}
