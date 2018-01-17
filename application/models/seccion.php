<?php
class Seccion extends CI_Model {

    public function registro($u) {
        //var_dump($u);die;
        if(isset($u['galerias'])){
            if(is_array($u['galerias'])){
                $gal='';
                foreach($u['galerias'] as $g){
                    $gal .= ','.$g;
                }
            }else{
                $gal='';
            }
        }else{
            $gal='';
        }
        $data = array(
            'seccion' => $u['seccion'],
            'titulo' => $u['titulo'],
            'subtitulo' => $u['subtitulo'],
            'texto' => $u['texto'],
            'id_seccion' => $u['depende'],
            'rotador'=>$u['rotador'],
            'tipo'=>$u['tipo'],
            'galerias'=>$gal
        );
        
        $this->db->insert('secciones', $data);
        
        
    }

    public function edicion() {
        $u = $this->input->post('item');
        if(isset($u['galerias'])){
            if(is_array($u['galerias'])){
                $gal='';
                foreach($u['galerias'] as $g){
                    $gal .= ','.$g;
                }
            }else{
                $gal='';
            }
        }else{
            $gal='';
        }
        $data = array(
            'seccion' => $u['seccion'],
            'titulo' => $u['titulo'],
            'subtitulo' => $u['subtitulo'],
            'texto' => $u['texto'],
            'id_seccion' => $u['depende'],
            'rotador'=>$u['rotador'],
            'tipo'=>$u['tipo'],
            'galerias'=>$gal
        );
        $this->db->where('id', $u['id']);
        $this->db->update('secciones', $data);
    }

    public function borrar_seccion($id) {
        $data = array('id' => $id);
        $this->db->delete('seccion', $data);
    }
    
    
}
