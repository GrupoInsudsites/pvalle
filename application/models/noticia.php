<?php
class Noticia extends CI_Model {

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
        }
        $fecha = date('Y-m-d');
        
        $fec =  explode('/',$u['fecha1']);
        $f1 = $fec[2].'-'.$fec[1].'-'.$fec[0];
        
        
        $data = array(
            
            'titulo' => $u['titulo'],
            'subtitulo' => $u['subtitulo'],
            'texto' => $u['texto'],
            'fecha' => $fecha,
            'fecha1' => $f1,
            'galerias'=>$gal
        );
        
        $this->db->insert('noticias', $data);
        
        
    }

    public function edicion() {
        $u = $this->input->post('item');
        if(is_array($u['galerias'])){
            $gal='';
            foreach($u['galerias'] as $g){
                $gal .= ','.$g;
            }
        }else{
            $gal='';
        }
        $fec =  explode('/',$u['fecha1']);
        $f1 = $fec[2].'-'.$fec[1].'-'.$fec[0];
        
        $data = array(
            
            'titulo' => $u['titulo'],
            'subtitulo' => $u['subtitulo'],
            'texto' => $u['texto'],
            'fecha1' => $f1,
            'galerias'=>$gal
        );
        $this->db->where('id', $u['id']);
        $this->db->update('noticias', $data);
    }

    
    
}
