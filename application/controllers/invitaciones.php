<?php

class Invitaciones extends CI_Controller {

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
         $this->config_editor['width']=950;
        $this->config_editor['toolbar'] = array(
            array('Bold', 'Italic', 'Underline', 'Strike')
        );
        $this->load->model('evento');
        $this->load->library('form_validation');
        $this->load->library('../controllers/push');

    }
    

  
    function changeState($id) {
        $this->varios->changeState($id, 'eventos');
        
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


    public function index(){
        $data1 = array();
                      
        
        $data1['listado'] =  "front/eventos/form";
        $data1['borra_invitado'] = 'borra';
        $data1['activos'] = $this->evento->traer_activos('activo');
        $data1['inactivos'] = $this->evento->traer_activos('inactivos');

        $this->load->vars($data1);
        
        $this->load->view('form');
    }

    public function guarda(){
     
       if ($this->input->post('submit')) {
            $ahora = date('Y-m-d H:i:s');

            $ni = $this->input->post('nombre');


            
            

            $this->form_validation->set_error_delimiters('<span class="has-warning" style="color:#f00;">', '</span>');    
            
            $this->form_validation->set_rules( 'nombre', 'Nombre de la visita', 'trim|required|min_length[3]|max_length[100]' );
            
            $this->form_validation->set_rules( 'dni', 'dni', 'trim|required|min_length[7]|max_length[30]' );
           
            $this->form_validation->set_rules( 'dominio', 'Dominio', 'trim|required' );
            
            $this->form_validation->set_message( 'required', 'El campo %s es obligatorio<br> ');
            $this->form_validation->set_message( 'min_length', 'La menor cantidad de caracteres para %s es %s <br>');
            $this->form_validation->set_message( 'max_length', 'La menor cantidad de caracteres para %s es %s <br>');

            if( $this->form_validation->run() === FALSE){ //si tiene errores

               
               
                $data1['title'] = "Bienvenido al panel de creacion de Invitaciones";
               
                $this->load->view('form', $data1, FALSE);

            } else { //si no tiene errores se graba

                $ip = $this->getIP();
//==================================================Cambiar para cada sede========================================================\\

               /*
                * 1 = Bascula garruchos,
                * 2 = Bascula gafosa,
                * 3 = Puerto Valle,
                * 4 = Villa oliveri,
                * 5 = Impregnadora
                */
                 $data=array(
                     'nombre'=>  $this->security->xss_clean( $this->input->post('nombre')),
                     'dni'=>  $this->security->xss_clean( $this->input->post('dni')),
                     'dominio'=>  $this->security->xss_clean( $this->input->post('dominio')),
                     'observaciones'=>  $this->security->xss_clean( $this->input->post('observaciones')),
                     'vivero'=>  $this->security->xss_clean( $this->input->post('vivero')),
                     'ingreso' => $ahora,
                     'forestal'=>  $this->security->xss_clean( $this->input->post('forestal')),
                     'ganaderia'=>  $this->security->xss_clean( $this->input->post('ganaderia')),
                     'hotel'=>  $this->security->xss_clean( $this->input->post('hotel')),
                     'yacare'=>  $this->security->xss_clean( $this->input->post('yacare')),
                     'otros'=>  $this->security->xss_clean( $this->input->post('otros')),
                     'status' => 'si',
                     'tipovisita' => $this->security->xss_clean( $this->input->post('tipovisita')),
                     'sede' => 3,
                     
                 );
                 $this->evento->insert_data($data);
                
                redirect('/invitaciones/index', 'refresh');
                        
                    
                
             }
         } else { //en caso de que no se haga submit


            $this->load->library('form_validation');
            
           
        }
        
    }
    
    public function salida($id){
       
        $ahora = date('Y-m-d H:i:s');
        $data =array('status'=>'no', 'salida'=>$ahora, 'patente_salida' => $this->input->post('patente_salida'));

        $id = (int)$id;
        $this->db->where('id',$id);
        $this->db->update('entradasalida',$data);
        redirect('/invitaciones/index', 'refresh');
    }

    function delete($id=null){
         if ($this->input->post('submit')) {
             $id= $this->input->post('id');
             $this->evento->delite_data($id);
             $this->session->set_flashdata('message', 'evento eliminado');
             redirect(base_url() . 'admin/eventos/index', 'refresh');

         } else {
            $data['title'] = "Eliminar evento";
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
                 'titulo'=>  $this->input->post('titulo'),
                 'lugar'=>  $this->input->post('lugar'),
                 'texto'=>  $this->input->post('texto'),
                 'fecha_inicio'=>  $this->input->post('fecha_inicio'),
                 'fecha_fin'=>  $this->input->post('fecha_fin')
             );
             $this->evento->edit_data($data);
             $this->session->set_flashdata('message', 'evento modificado');
             redirect(base_url() . 'admin/eventos/index', 'refresh');

         } else {
            $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => "../../assets/ckeditor/", 'outPut' => true));
            $data = array();
            $data['config'] = $this->config_editor;
            $data['menusel'] = "eventos";
            $data['title'] = "Administracion de eventos";
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

    public function get_invitados(){

        $invitados = $this->evento->getInvitados($criterios);
        $data = array();
        foreach($invitados as $i ){
            $data[] = array('nombre' => $i['nombre'], 'foto'=>$i['foto'], 'id'=>$i['id']);
           
        }
        $final = json_encode($data);
        echo $final;
    }


    function get_invitados1(){
        
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->evento->get_inv($q);
        }
      }
}

?>


