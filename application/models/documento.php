<?php
class Documento extends CI_Model {

    public function registro($u) {


      $config['upload_path'] = './assets/imagenes';
      $config['allowed_types'] = 'pdf|xls|ppt|zip|gif|jpg|jpeg|png|txt|rtf|doc|docx|xlsx';

      $this->load->library('upload', $config);
       $this->upload->do_upload('userfile');
      $upload =$this->upload->data();


        $data = array(

            'titulo' => $u['titulo'],
            'texto' => $upload['file_name']


        );

        $this->db->insert('documentos', $data);


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
