<?php

class Eventos extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->config_editor = array();
        //indicamos la ruta para ckFinder
        $this->config_editor['filebrowserBrowseUrl'] = base_url()."assets/ckeditor/kcfinder/browse.php";
        // indicamos la ruta para el boton de la toolbar para subir imagenes
        $this->config_editor['filebrowserImageBrowseUrl'] = base_url()."assets/ckeditor/kcfinder/browse.php?type=images";
        // indicamos la ruta para subir archivos desde la pestaña de la toolbar (Quick Upload)
        $this->config_editor['filebrowserUploadUrl'] = base_url()."assets/ckeditor/kcfinder/upload.php?type=files";
        // indicamos la ruta para subir imagenesdesde la pestaña de la toolbar (Quick Upload)
        $this->config_editor['filebrowserImageUploadUrl'] = base_url()."assets/ckeditor/kcfinder/upload.php?type=images";
        $this->config_editor['height']=50;
        $this->config_editor['toolbar'] = array(
            array('Bold', 'Italic', 'Underline', 'Strike')
        );
        $this->load->model('evento');
    }
    

    function index($pag=1) {

       

        if( $this->input->post('busca')){

            $criterio = $this->input->post('busca');
        }else{
            $criterio = '';
        }
        $data['menusel'] = "eventos";


        $dia = date('d/m/Y');
        $data['title'] = "Visitas del D&iacute;a de Hoy ( ".$dia." )";
        $data['admin'] = $this->administrador->is_admin($this->session->userdata('id'));
        
        $this->load->library('pagination');
        $data['col_derecha'] = 'admin/galerias/col_derecha';
        $data['menu_top'] = 'admin/menu_top';
        $data['menu_iz'] = 'admin/menu_iz';
        $data['listado'] =  "admin/eventos/listado";
        //$data['eventos'] = $this->evento->getAllEvents();

        $config['base_url'] = base_url().'admin/eventos/index';
        $config['total_rows'] = $this->evento->record_count();
        $config['per_page'] = 100; 
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $config['uri_segment'] = '4';


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
        $data["eventos"] = $this->evento->fetch_invitados_hoy($config["per_page"], $page, $criterio);

        $data["llegaron"] = $this->evento->fetch_invitados_hoy_llegaron();

        $data["links"] = $this->pagination->create_links();


        $this->load->vars($data);
        $this->load->view('admin/admin_ancho_refresh');
    }


   
    public function llego($id){
        if(is_numeric($id)){
            $this->evento->llego($id);
        }
    }

    function busca($pag=1) {

        if( $this->input->post('criterio')){
            $criterio = $this->input->post('criterio');
        }else{
            $criterio = '';
        }
        $data['menusel'] = "busqueda";
        $data['title'] = "Administraci&oacute;n de visitas";
        $data['admin'] = $this->administrador->is_admin($this->session->userdata('id'));
        $this->load->library('pagination');
        $data['col_derecha'] = 'admin/galerias/col_derecha';
        $data['menu_top'] = 'admin/menu_top';
        $data['menu_iz'] = 'admin/menu_iz';
        $data['listado'] =  "admin/eventos/listado_busqueda";
        $config['base_url'] = base_url().'admin/eventos/busca';
        $config['total_rows'] = $this->evento->record_count();
        $config['per_page'] = 50; 
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        //$data["eventos"] = $this->evento->fetch_invitados($config["per_page"], $page, $criterio);
        $data["eventos"] = $this->evento->fetch_invitados( $criterio);
        //var_dump($data['eventos']);die;
        $data["links"] = $this->pagination->create_links();
        $this->load->vars($data);
        $this->load->view('admin/admin_ancho');
    }




    function historial($pag=1) {



        if( $this->input->post('criterio')){

            $criterio = $this->input->post('criterio');
        }else{
            $criterio = '';
        }


        $data['menusel'] = "busqueda";
        $data['title'] = "Administracion de invitaciones";
        $data['admin'] = $this->administrador->is_admin($this->session->userdata('id'));
        
        $this->load->library('pagination');
        $data['col_derecha'] = 'admin/galerias/col_derecha';
        $data['menu_top'] = 'admin/menu_top';
        $data['menu_iz'] = 'admin/menu_iz';
        $data['listado'] =  "admin/eventos/listado_busqueda";
        //$data['eventos'] = $this->evento->getAllEvents();

        $config['base_url'] = base_url().'admin/eventos/busca';
        $config['total_rows'] = $this->evento->record_count();
        $config['per_page'] = 50; 
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $config['uri_segment'] = '4';


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
        $data["eventos"] = $this->evento->fetch_invitados_historial($config["per_page"], $page, $criterio);

        $data["links"] = $this->pagination->create_links();


        $this->load->vars($data);
        $this->load->view('admin/admin_ancho');
    }



    function changeState($id) {
        $this->varios->changeState1($id, 'invitados');
        
        $this->session->set_flashdata('message', 'Status cambiado');
        redirect(base_url() . 'admin/eventos/index', 'refresh');
    }
    function getIP() {
        $ip;
        if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
        else
        $ip = "UNKNOWN";
        return $ip;

    } 

    function crear(){
        if ($this->input->post('submit')) {
            $this -> load -> library( 'form_validation' );
            $this -> form_validation -> set_error_delimiters('<span class="error">', '</span>');    
            
            $this -> form_validation -> set_rules( 'nombre_empleado', 'Nombre Empleado', 'trim|required|min_length[3]|max_length[35]' );
            $this -> form_validation -> set_rules( 'nombre_invitado', 'Nombre Invitado', 'trim|required|min_length[4]|max_length[35]' );
            $this -> form_validation -> set_rules( 'ingreso', 'Ingreso', 'trim|required' );
            $this -> form_validation -> set_rules( 'interno', 'Interno', 'required' );
            $this -> form_validation -> set_rules( 'empresa', 'Empresa', 'required' );
            $this -> form_validation -> set_message( 'min_length', 'La menor cantidad de caracteres para %s es %s ');
            $this -> form_validation -> set_message( 'max_length', 'La menor cantidad de caracteres para %s es %s ');

            if( $this->form_validation->run() === FALSE){ //si tiene errores

                $_SESSION['KCFINDER'] = array();
                $_SESSION['KCFINDER']['disabled'] = false;
                $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => "../assets/ckeditor/", 'outPut' => true));
                $data1 = array();
                $data1['config'] = $this->config_editor;
                $data1['menusel'] = "eventos";
                $data1['title'] = "Bienvenido al panel de creacion de Invitaciones";
                $data1['col_derecha'] = 'admin/galerias/col_derecha';
                $data1['menu_top'] = 'admin/menu_top_front';
                $data1['menu_iz'] = 'admin/menu_iz';
                $this->load->view('form', $data1, FALSE);
            } else { //si no tiene errores se graba

                $ip = $this->getIP();
                 $data=array(
                     'nombre_empleado'=>  $this -> security -> xss_clean( $this->input->post('nombre_empleado')),
                     'nombre_invitado'=>  $this -> security -> xss_clean( $this->input->post('nombre_invitado')),
                     'aclaracion'=>  $this -> security -> xss_clean( $this->input->post('aclaracion')),
                     'ingreso'=>  $this -> security -> xss_clean( $this->input->post('ingreso')),
                     'ip'=>  $ip,
                     'interno'=>  $this -> security -> xss_clean( $this->input->post('interno')),
                     'empresa'=>$this -> security -> xss_clean( $this->input->post('empresa')),
                     'quien' => $this->input->post('quien')
                 );
                 
                
                 $this->evento->insert_data($data);
                 // $this -> load -> view( 'admin/eventos/success_view' );
                 $this->session->set_flashdata('message', 'evento creado');
                 redirect(base_url() . 'admin/eventos/index', 'refresh');
             }
         } else { //en caso de que no se haga submit


            $this->load->library('form_validation');
            
            $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => "../assets/ckeditor/", 'outPut' => true));
            $data = array();
            $data['config'] = $this->config_editor;
            $data['menusel'] = "eventos";
            $data['title'] = "Bienvenido al panel de creacion de Invitaciones";
        
        
            $data['col_derecha'] = 'admin/galerias/col_derecha';
            $data['menu_top'] = 'admin/menu_top_front';
            $data['menu_iz'] = 'admin/menu_iz';
            $data['listado'] =  "front/eventos/form";
        
            $this->load->vars($data);
            
            $this->load->view('admin/eventos/form');
            

            //$this->load->view('admin/admin_front');
        }
    }

   

    function delete($id=null){
        $this->evento->delete_data($id,1);
    }

    function delete_busqueda($id=null){
        $this->evento->delete_data($id,2);
    }
    function delete_historial($id=null){
        $this->evento->delete_data($id,3);
    }
    function delete1($id=null){
         if ($this->input->post('submit')) {
             $id= $this->input->post('id');
             $this->evento->delite_data($id);
             $this->session->set_flashdata('message', 'evento eliminado');
             redirect(base_url() . 'admin/eventos/index', 'refresh');

         } else {
            $data['title'] = "Eliminar invitado";
            $data['main'] = 'admin/eventos/admin_eventos_delete';
            $data['evento'] = $this->MEvents->getEvent($id);
            $this->load->vars($data);
            $this->load->view('admin/dashboard');
        }
    }
     function edit($id=null){
         $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => "../../assets/ckeditor/", 'outPut' => true));
            $data = array();
         if ($this->input->post('submit')) {
             $data=array(
                 'id'=>  $this->input->post('id'),
                 'nombre_empleado'=>  $this->input->post('nombre_empleado'),
                 'nombre_invitado'=>  $this->input->post('nombre_invitado'),
                 'ingreso'=>  $this->input->post('ingreso'),
                 'interno'=>  $this->input->post('interno'),
                 'aclaracion'=>  $this->input->post('aclaracion'),
                 'empresa'=>$this->input->post('empresa'),
                 'quien' => $this->input->post('quien')
             );
             $this->evento->edit_data($data);
             $this->session->set_flashdata('message', 'invitado modificado');
             redirect(base_url() . 'admin/eventos/index', 'refresh');

         } else {
            $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => "../../assets/ckeditor/", 'outPut' => true));
            $data = array();
            $data['config'] = $this->config_editor;
            $data['menusel'] = "eventos";
            $data['title'] = "Administracion de Invitados";
            $data['admin'] = $this->administrador->is_admin($this->session->userdata('id'));
            $data['col_derecha'] = 'admin/galerias/col_derecha';
            $data['menu_top'] = 'admin/menu_top';
            $data['menu_iz'] = 'admin/menu_iz';
            $data['listado'] =  "admin/eventos/form_edit";
            $data['evento'] = $this->evento->getEvent($id);
            
            
                        $this->load->vars($data);
            $this->load->view('admin/admin_ancho');
        }
    }



    function excel(){

        $desde = $this->input->post('fecha_desde');
        $hasta = $this->input->post('fecha_hasta');
        //$datos = $this->evento->getAllEventsByDate($desde,$hasta);
       
        $this->to_excel($this->evento->getAllEventsByDate($desde,$hasta));
    }

    function to_excel($array, $filename='out') {
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename.'.xls');
        
        // Filter all keys, they'll be table headers
        $h = array();
        foreach($array as $row)
            foreach($row as $key=>$val)
                if(!in_array($key, $h))
                    $h[] = $key;
        
        echo '<table><tr>';
        foreach($h as $key) {
            $key = ucwords($key);
            echo '<th>'.$key.'</th>';
        }
        echo '</tr>';
        
        foreach($array as $val)
            $this->_writeRow($val, $h);
        
        echo '</table>';
    }

function _writeRow($row, $h, $isHeader=false) {
    echo '<tr>';
    foreach($h as $r) {
        if($isHeader)
            echo '<th>'.utf8_decode(@$row[$r]).'</th>';
        else
            echo '<td>'.utf8_decode(@$row[$r]).'</td>';
    }
    echo '</tr>';
}

function update_externo(){
    $id = $this->input->post('id_externo');
   $dni = $this->input->post('dni');

    echo 'id:'.$id;

    $data = array('dni'=>$dni);
    $this->db->where('id',$id);
    $this->db->update('externos',$data);
}

function upload1($id=0){

    if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
        exit;
    }

    
    $filename = md5($_SERVER['REMOTE_ADDR'].rand()).'.jpg';
    $folder = realpath(APPPATH . '../assets/fotos_invitados/');

    chmod($folder, '0777');

    //$original = $folder.'\\'.$filename;
    
   // $original = realpath(APPPATH . '../assets/fotos_invitados/'.$filename);
    $original = $folder.'\\'.$filename;
    echo $original;

    
    // The JPEG snapshot is sent as raw input:
    $input = file_get_contents('php://input');

    if(md5($input) == '7d4df9cc423720b7f1f3d672b89362be'){
        // Blank image. We don't need this one.
        exit;
    }

    $result = file_put_contents($original, $input);

    if (!$result) {
        echo '{
            "error"     : 1,
            "message"   : "Failed save the image. Make sure you chmod the uploads folder and its subfolders to 777."
        }';
        exit;
    }

    $info = getimagesize($original);
    if($info['mime'] != 'image/jpeg'){
        unlink($original);
        exit;
    }

    // Moving the temporary file to the originals folder:
    rename($original,realpath(APPPATH . '../assets/fotos_invitados/').'\\'.$filename);
    $original = realpath(APPPATH . '../assets/fotos_invitados/').'\\'.$filename;

    $data = array('id'=>$id, 'foto'=>$filename);

    $this->evento->edit_img($data);
    // Using the GD library to resize 
    // the image into a thumbnail:

   // $origImage  = imagecreatefromjpeg($original);
    //$newImage   = imagecreatetruecolor(154,110);
    //imagecopyresampled($newImage,$origImage,0,0,0,0,154,110,520,370); 

    //imagejpeg($newImage,base_url().'assets/uploads/thumbs/'.$filename);
    
    echo '{"status":1,"message":"Success!","filename":"'.$filename.'"}';

}

function get_externo_by_id($id){
    $externo = $this->evento->getExternoById($id);
    echo json_encode($externo);
}
/*
    public function upload1() {
        $config['upload_path'] = realpath(APPPATH . '../assets/fotos_invitados');

        //var_dump($config['upload_path']);die;


        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_width']  = '500';
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            echo '{"status":1,"message":"'.$this->upload->display_errors().'","filename":"test.jpg"}';
        } else {
            $data = array('upload_data' => $this->upload->data());
            //echo '{"status":1,"message":"Success!","filename":"'.$filename.'"}';
            echo '{"status":1,"message":"Success!","filename":"test.jpg"}';
        }

    }
    */
}

?>
