<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Secciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('varios');
    }

    public function get_secciones($sec) {

    }

    public function get_menu() {

    }

    public function get_seccion($sec) {
        $arg = array('tabla' => 'secciones', 'campo' => 'seccion', 'valor' => $sec);
        $seccion = $this->varios->getItem($arg);
        //echo $seccion->texto;
        echo json_encode($seccion);
    }

    public function get_listado($sec){
        if($sec=='noticomarcas'){
            $tabla='newsletters';
        }else if($sec == 'noticias'){
            $tabla='noticias';
        }else if($sec == 'documentacion'){
            $tabla='documentos';
        }else if('eventos'){
            $tabla='eventos';
        }
        $args = array('tabla'=>$tabla,'campo_orden'=>'id','dir_orden'=>'asc');
        $items = $this->varios->getItems($args);


        echo json_encode($items);
    }


    public function get_rotador($sec){
         $args = array('tabla'=>'rotador_secciones','campo_orden'=>'id','dir_orden'=>'asc','campo_where'=>'id_sec','valor_where'=>$sec);
        $imgs = $this->varios->getItemsArray($sec);
        return $imgs;
    }

    public function get_galeria($sec=0) {
        $arg = array('tabla' => 'secciones', 'campo' => 'seccion', 'valor' => $sec);
        $seccion = $this->varios->getItem($arg);
        $galerias = explode(',', $seccion->galerias);
        foreach ($galerias as $g) {
            if ($g > 0) {
                $args = array();
                $args = array('tabla' => 'assets_galerias', 'campo' => 'id_gal', 'valor' => $g);
                $gals[$g] = $this->varios->getItems($args);

            }
        }

        if (isset($gals)) {
            $galeria = '';
            foreach ($gals as $k => $g1) {
                $galtype = $this->varios->getGaleryType($k);
                if($galtype=='foto'){
                    $cuenta = 0;
                    foreach ($g1 as $gg) {


                        if ($gg->id_gal == $k) {

                            if ($cuenta == 0) {
                                if ($gg->path != '') {
                                    $galeria .= '<a rel="images_group' . $k . '" class="item_gal"  href="' . base_url() . 'assets/imagenes/' . $gg->path . '" '. $gg->titulo .'"><img alt="" src="' . base_url() . 'assets/imagenes/' . $gg->path . '"  width="50" /></a>';
                                }
                            } else {
                                if ($gg->path != '') {
                                    $galeria .= '<a rel="images_group' . $k . '"  class="item_gal" href="' . base_url() . 'assets/imagenes/' . $gg->path . '" title="'. $gg->titulo .'" style="display:none;"><img alt="" src="' . base_url() . 'assets/imagenes/' . $gg->path . '"  width="50" /></a>';
                                }
                            }
                            $cuenta+=1;
                        }
                    }
                }else{
                    $cuenta = 0;
                    foreach ($g1 as $gg) {


                        if ($gg->id_gal == $k) {

                            if ($cuenta == 0) {
                                if ($gg->link != '') {
                                    $galeria .= '<a href="http://www.youtube.com/v/' . $gg->link . '" rel="video_group' . $k . '" ><img src="' . base_url() . 'assets/imagenes/video_icon_full.jpg"   width="50" /> </a>';
                                }
                            } else {
                                if ($gg->link != '') {
                                    $galeria .= '<a href="http://www.youtube.com/v/' . $gg->link . '" rel="video_group' . $k . '" style="display:none;" ><img src="' . base_url() . 'assets/imagenes/video_icon_full.jpg"   width="50" /> </a>';
                                }
                            }
                            $cuenta+=1;
                        }
                    }
                }
            }

            echo $galeria;
        } else {
            echo '';
        }
    }

}

