<?php

class Varios extends CI_Model {

    /**
     * function getItems 
     * trae todos los items de una tabla
     * recibe un array con parametros 
     * @param tabla*
     * @param campo_orden
     * @param dir_orden
     * @param campo_where
     * @param valor_where
     * @param limite
     */
    function getItems($args=array()) {
        $arg = $args;

        $tabla = $arg['tabla'];
        $campo_orden = (isset($arg['campo_orden'])) ? $arg['campo_orden'] : '';
        $dir_orden = (isset($arg['dir_orden'])) ? $arg['dir_orden'] : 'asc';

        $campo_where = (isset($arg['campo_where'])) ? $arg['campo_where'] : '';
        $valor_where = (isset($arg['valor_where'])) ? $arg['valor_where'] : '';
        $limite = (isset($arg['limite'])) ? $arg['limite'] : '';

        if ($limite != '') {
            $this->db->limit($limite);
        }

        if ($campo_where != '' && $valor_where != '') {


            $this->db->where($campo_where, $valor_where);
        }

        if ($campo_orden != '') {
            $this->db->order_by($campo_orden, $dir_orden);
        }
        $Q = $this->db->get($tabla);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $items[] = $row;
            }
        }
        //var_dump($this->db->last_query());die;
        if (isset($items)) {
            return $items;
        }
    }

    /**
     * function getItems 
     * trae todos los items de una tabla
     * recibe un array con parametros 
     * @param tabla*
     * @param campo_orden
     * @param dir_orden
     * @param campo_where
     * @param valor_where
     * @param limite
     */
    function getItemsArray($args=array()) {
        $arg = $args;

        $tabla = $arg['tabla'];
        $campo_orden = (isset($arg['campo_orden'])) ? $arg['campo_orden'] : '';
        $dir_orden = (isset($arg['dir_orden'])) ? $arg['dir_orden'] : 'asc';

        $campo_where = (isset($arg['campo_where'])) ? $arg['campo_where'] : '';
        $valor_where = (isset($arg['valor_where'])) ? $arg['valor_where'] : '';
        $limite = (isset($arg['limite'])) ? $arg['limite'] : '';
        $campos = (isset($arg['campos'])) ? $arg['campos'] : '';
        if ($campos != '') {
            $this->db->select($campos);
        }
        if ($limite != '') {
            $this->db->limit($limite);
        }

        if ($campo_where != '' && $valor_where != '') {


            $this->db->where($campo_where, $valor_where);
        }

        if ($campo_orden != '') {
            $this->db->order_by($campo_orden, $dir_orden);
        }
        $Q = $this->db->get($tabla);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $items[] = $row;
            }
        }
        //var_dump($this->db->last_query());die;
        if (isset($items)) {
            return $items;
        }
    }

    /**
     * function getItem 
     * trae todos los datos de un registro
     * recibe un array con parametros 
     * @param tabla
     * @param campo
     * @param valor
     */
    public function getItem($args = array()) {

        $arg = $args;
        $tabla = $arg['tabla'];
        $campo = $arg['campo'];
        $valor = $arg['valor'];

        $data = array($campo => $valor);
        $Q = $this->db->get_where($tabla, $data);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $items = $row;
            }
        }
        if (isset($items)) {
            return $items;
        }
    }

    /**
     * function borraItem 
     * borra un registro
     * recibe un array con parametros 
     * @param tabla
     * @param campo
     * @param valor
     */
    public function borraItem($args=array()) {
        $arg = $args;
        $tabla = $arg['tabla'];
        $campo = $arg['campo'];
        $valor = $arg['valor'];
        $data = array($campo => $valor);
        $this->db->delete($tabla, $data);
    }

    public function getItemsForDropdown($args=array()) {
        $arg = $args;
        $tabla = $arg['tabla'];
        $campo_orden = (isset($arg['campo_orden'])) ? $arg['campo_orden'] : '';
        $dir_orden = (isset($arg['dir_orden'])) ? $arg['dir_orden'] : 'asc';

        $campo_where = (isset($arg['campo_where'])) ? $arg['campo_where'] : '';
        $valor_where = (isset($arg['valor_where'])) ? $arg['valor_where'] : '';
        $limite = (isset($arg['limite'])) ? $arg['limite'] : '';

        if ($limite != '') {
            $this->db->limit($limite);
        }

        if ($campo_where != '' && $valor_where != '') {
            $this->db->where($campo_where, $valor_where);
        }

        if ($campo_orden != '') {
            $this->db->order_by($campo_orden, $dir_orden);
        }
        $Q = $this->db->get($tabla);
        foreach ($Q->result_array() as $row) {
            $data[$row['id']] = $row['titulo'];
        }
        return $data;
    }

    /**
     * function objectToArray
     * convierte un objeto en un array
     * recibe un array con parametros 
     *
     * @param type $obj
     * @return array 
     */
    function Obj2ArrRecursivo($Objeto) {
        if (is_object($Objeto))
            $Objeto = get_object_vars($Objeto);
        if (is_array($Objeto))
            foreach ($Objeto as $key => $value)
                $Objeto [$key] = $this->Obj2ArrRecursivo($Objeto [$key]);
        return $Objeto;
    }

    /**
     * function objectToArray
     * convierte un objeto en un array
     * recibe un array con parametros 
     *
     * @param type $args
     *         path
     *         ancho
     *         alto
     *         tabla
     *         campo
     *         valor
     *         campo_imagen
     *           
     * @return string 
     */
    public function addImage($args=array()) {

        $path = $args['path'];
        $max_width = $args['ancho'];
        $max_height = $args['alto'];
        $tabla = $args['tabla'];
        $campo = (isset($args['campo'])) ? $args['campo'] : 'id';
        $valor = $args['valor'];
        $nombre_campo_imagen = (isset($args['campo_imagen'])) ? $args['campo_imagen'] : 'img';
        $campos = $args['campos'];


        $cont = 0;
        if ($_FILES['fileField']['name'] != "") {
            $this->load->library('upload');
            $_FILES['fileField']['name'] = str_replace(' ', '_', $_FILES['fileField']['name']);
            $cont += 1;
            $ahora = strtotime("now");
            $exten = strrchr($_FILES['fileField']['name'], ".");
            $nomm = str_replace($exten, '', $_FILES['fileField']['name']);
            $nomm = str_replace(' ', '_', $_FILES['fileField']['name']);
            $nombre_ext = md5($nomm . '_' . $ahora . $cont) . $exten;
            $nombre = md5($nomm . '_' . $ahora . $cont);
            $asset_type = array(
                'type' => 'image',
                'mimes' => 'gif|jpg|png'
            );
            $config['file_name'] = $nombre;
            $config['upload_path'] = $path;
            $config['allowed_types'] = $asset_type['mimes'];
            $this->upload->initialize($config);
            $this->upload->do_upload('fileField');
            $property = getimagesize($path . $nombre_ext);
            if ($property[0] > $property[1]) {
                $width = ceil($property[0] * $max_height / $property[1]);
                $height = $max_height;
            } else {
                $width = ceil($property[0] * $max_width / $property[1]);
                $height = $max_width;
            }
            $config['image_library'] = 'gd2';
            $config['source_image'] = $path . $nombre_ext;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $width;
            $config['height'] = $height;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $data = array();
            foreach ($campos as $k => $v) {
                $data[$k] = $this->input->post($v);
            }
            $data['path'] = $nombre_ext;
            if ($valor > 0) {
                $this->db->where($campo, $valor);
                $this->db->update($tabla, $data);
            } else {
                $this->db->insert($tabla, $data);
            }
            $pp = $this->db->last_query();

            return $nombre_ext;
        } else {

            foreach ($campos as $k => $v) {
                $data[$k] = $this->input->post($v);
            }

            if ($valor > 0) {
                $this->db->where($campo, $valor);
                $this->db->update($tabla, $data);
            } else {
                $this->db->insert($tabla, $data);
            }

            return false;
        }
    }

    public function email_exists($tabla='', $email='') {
        $data = array('email' => $email);
        $Q = $this->db->get_where($tabla, $data);
        if ($Q->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function formatTree($tree, $parent) {
        $tree2 = array();
        foreach ($tree as $i => $item) {
            if ($item['id_seccion'] == $parent) {
                $tree2[$item['id']] = $item;
                $tree2[$item['id']]['submenu'] = $this->formatTree($tree, $item['id']);
            }
        }

        return $tree2;
    }
    public function tieneAdentro($id){
        $args1 = array(
                    'tabla'=>'secciones',
                    'campo_orden'=>'orden',
                    'dir_orden'=>'asc',
                    'campo_where'=>'id_seccion',
                    'valor_where'=>$id
            
                    );
        $tiene = $this->getItemsArray($args1);
        if(is_array($tiene) && count($tiene)>0){
            return true;
        }else{
            return false;
        }
    }
    public function arma_menu($tree, $parent,$datos='') {
       // $tree2 = array();
        $datos2 = '';
        $datos2 .= $datos;
        $datos2 .= '<ul>';
        foreach ($tree as $i => $item) {
            
                if ($item['id_seccion'] == $parent ) {
                     if($this->tieneAdentro($item['id'])){
                        //$datos2 .= '<li><span class="toggle menu" rel="address:/'.$item['seccion'].'"  onclick="change(\''.$item['titulo'].'\',\''.$item['seccion'].'\')" >'. $item['titulo'].'</span>';
                        $datos2 .= '<li><span href="'.base_url().'home/index/'.$item['seccion'].'"   rel="'.$item['titulo'].'"  alt="'.$item['seccion'].'"  class="toggle menu" >'. $item['titulo'].'</span>';
                     }else{
                         //$datos2 .= '<li><a href="#" rel="address:/'.$item['seccion'].'" onclick="change(\''.$item['titulo'].'\',\''.$item['seccion'].'\')" id="item'.$item['id'].'">'. $item['titulo'].'</a>';
                         $datos2 .= '<li><a href="'.base_url().'home/index/'.$item['seccion'].'" class="menu" rel="'.$item['titulo'].'"  alt="'.$item['seccion'].'"  id="item'.$item['id'].'">'. $item['titulo'].'</a>';
                     }
                     $datos2 .= $this->arma_menu($tree, $item['id'], $datos);
                     $datos2 .= '</li>';
                }
            
        }
        $datos2 .= '</ul>';
        //return $tree2;
        return $datos2;
    }
    
    public function arma_menu_b($tree, $parent,$datos='') {
       // $tree2 = array();
        $datos2 = '';
        $datos2 .= $datos;
        $datos2 .= '<ul>';
        foreach ($tree as $i => $item) {
            
                if ($item['id_seccion'] == $parent ) {
                     if($this->tieneAdentro($item['id'])){
                        $datos2 .= '<li><span class="toggle" rel="address:/'.$item['seccion'].'"  onclick="change(\''.$item['titulo'].'\',\''.$item['seccion'].'\')" >'. $item['titulo'].'</span>';
                     }else{
                         $datos2 .= '<li><a href="javascript:void(0)" rel="address:/'.$item['seccion'].'" onclick="change(\''.$item['titulo'].'\',\''.$item['seccion'].'\')" id="item'.$item['id'].'">'. $item['titulo'].'</a>';
                     }
                     $datos2 .= $this->arma_menu($tree, $item['id'], $datos);
                     $datos2 .= '</li>';
                }
            
        }
        $datos2 .= '</ul>';
        //return $tree2;
        return $datos2;
    }
    
    public function arma_menu1($tree, $parent, $datos = '') {
        $datos .= '<ul>';
        foreach ($tree as $i => $t) {
            $datos .= '<li>' . $t['titulo'];


            if ($parent>0  && count($t['submenu'])>0) {
                $datos .= $this->arma_menu($tree, $t['id'], $datos);
            }
            $datos .= '</li>';
        }
        $datos .= '</ul>';
        return $datos;
    }

}
