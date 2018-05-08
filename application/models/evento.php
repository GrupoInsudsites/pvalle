<?php

class Evento extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function getAllEvents() {
        $data = array();
        $this->db->order_by('ingreso','desc');
        $Q = $this->db->get('invitados');
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    } 

    public function getInvitados($criterio){
        $this->db->like('nombre',$criterio);
        $Q = $this->db->get('externos');
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function get_inv($q){
        $this->db->select('nombre,dni');
        $this->db->like('nombre', $q);
        $query = $this->db->get('entradasalida');
        if($query->num_rows > 0){
          foreach ($query->result_array() as $row){
            
            $new_row['nombre']=htmlentities(stripslashes(utf8_decode($row['nombre'])));
            $new_row['dni']=htmlentities(stripslashes(utf8_decode($row['dni'])));
           
            $row_set[] = $new_row; //build an array


          }
          echo json_encode($row_set); //format the array into json data
        }
      }


    public function record_count() {
        return $this->db->count_all("invitados");
    }

   

   public function fetch_invitados( $criterio) {
        $this->db->select('invitados.id as idi, nombre_empleado, nombre_invitado,ingreso,interno,status,aclaracion,
            empresa,quien,externos.id as ide, hora');
        $this->db->from('invitados');

        $this->db->order_by('ingreso', 'desc');
        if($criterio != ''){
            $this->db->like('nombre_empleado',$criterio);
            $this->db->or_like('nombre_invitado', $criterio);
            $this->db->or_like('fecha', $criterio);

        }
        $this->db->join('externos','externos.id=invitados.id_invitado','left');
        $date = date( "Y-m-d" );
        $ayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $date ) ) );  
        //$this->db->where('ingreso >','$ayer');
        $this->db->order_by('ingreso asc, nombre_empleado asc');
        
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   public function fetch_invitados_historial($limit, $start, $criterio) {
        $this->db->order_by('ingreso', 'desc');
        if($criterio != ''){
            $this->db->like('nombre_empleado',$criterio);
            $this->db->or_like('nombre_invitado', $criterio);

        }

        
        
        $this->db->limit($limit, $start);
        $query = $this->db->get("invitados");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }




    public function fetch_invitados_hoy( $criterio) {
        $this->db->select('invitados.id as idi, nombre_empleado, nombre_invitado,ingreso,interno,status,aclaracion,
            empresa,quien,externos.id as ide, 
            nombre,hora ');
        $this->db->from('invitados');
        $this->db->join('externos','externos.id=invitados.id_invitado','left');
        $this->db->order_by('nombre_empleado asc, empresa asc, hora asc');
        
        $hoy = date('Y-m-d');
        $this->db->where('ingreso ', $hoy );
        $this->db->where('ingreso ', $hoy );

        $this->db->where('status','no');
        
        
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

public function fetch_invitados_hoy_llegaron( $criterio='') {
        $this->db->select('invitados.id as idi, nombre_empleado, nombre_invitado,ingreso,interno,status,aclaracion,
            empresa,quien,externos.id as ide, 
            nombre,hora,llegada ');
        $this->db->from('invitados');
        $this->db->join('externos','externos.id=invitados.id_invitado','left');
        $this->db->order_by('nombre_empleado asc, empresa asc, hora asc');
        
        $hoy = date('Y-m-d');
        $this->db->where('ingreso ', $hoy );
        $this->db->where('ingreso ', $hoy );

        $this->db->where('status','si');
        
        
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   public function llego($id){
        $ahora = date('H:i:s');
        $data = array('status'=>'si', 'llegada'=>$ahora);
        $this->db->where('id',$id);
        $this->db->update('invitados',$data);
   }

   function getAllEventsByDate($desde='', $hasta='') {
        if($desde==''){
            $desde =  date('Y-m-d H:i:s');
        }

        $data = array();
        $this->db->select('nombre_invitado, ingreso, nombre_empleado, interno, empresa');
        $this->db->from('invitados');
        $this->db->where('ingreso >',$desde);
        $this->db->where('ingreso <',$hasta);
        $this->db->order_by('ingreso','desc');
        $Q = $this->db->get();
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    public function traer_activos($act){
        $act = ($act=='activo')?'si':'no';
        $date = getdate();
        $filter = $date['mon'] - 3;
        if($filter <= 0){
            $year = $date['year'] - 1;
            $filter = $filter + 12;
        }else {
            $year = $date['year'];
        }
        $leftDate =  $year. '-' . str_pad($filter, 2, 0, STR_PAD_LEFT) . '-' . str_pad($date ['mday'], 2, 0, STR_PAD_LEFT);

        $this->db->order_by('ingreso', 'desc');
        $this->db->where('ingreso >', $leftDate);
	    $this->db->limit(500);
        $this->db->where('status',$act);
        //==================================================================================*/
        /*||     CAMBIAR PARA CADA SEDE ESTO SOLO DEBE ESTAR HABILITADO PARA PUERTO VALLE ||
        /*||*/$this->db->where('sede', 3);//                                             ||
        //==================================================================================*/
        $res= $this->db->get('entradasalida')->result();
        return $res;
    }

    function insert_data($data){

        
        $this->db->insert('entradasalida',$data);
    }

    function getEvent($id){
        $data = array();
        $this->db->where('id',$id);
        $Q = $this->db->get('invitados');
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    function delete_data($id,$proviene){
        $this->db->where('id', $id);
        $this->db->delete('invitados');
        if($proviene==1){
            redirect(base_url() . 'admin/eventos/index', 'refresh');
        }else if ($proviene==2){
            redirect(base_url() . 'admin/eventos/busca', 'refresh');
        }else{
            redirect(base_url() . 'admin/eventos/historial', 'refresh');
        }   
    }
    function edit_data($data){
        $this->db->where('id',$data['id']);
        $this->db->update('invitados',$data);
    }

    function edit_img($data){
        $this->db->where('id',$data['id']);
        $this->db->update('externos',$data);
    }

    public function getExterno($nombre){
        $this->db->where('nombre',$nombre);
        $Q=$this->db->get('externos');
        
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
             return $data;
        }else{
             return false;
        }
       
    }

    public function getExternoById($id){
        $this->db->where('id',$id);
        $Q=$this->db->get('externos');
        
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
             return $data;
        }else{
             return false;
        }
       
    }
    public function disableImporter(){ 
        $this->db->where('exportado', 0);
        $this->db->set('exportado', 1);
        $this->db->update('entradasalida');
    }
    public function insertBySede ($data){
        if($data->salida != null){
            $this->db->insert('entradasalida', $data);
        }else{
            $this->db->insert('data', $data);
        }
    }
    public function exportData(){
        $this->db->where('exportado', 0);
        $this->db->select('nombre, dni, ingreso, dominio,
            salida, status, observaciones,
            quien, vivero, forestal, ganaderia, 
            hotel, yacare, otros, tipovisita, sede, exportado');
        $res= $this->db->get('entradasalida')->result();
        return $res;
    }
    public function getSedesByAdmon($arraySede){
        foreach ($arraySede as $sede) {
            $this->db->or_where('id', $sede);
        }
        $query = $this->db->get('sedes')->result();

        return $query;
    }
    public function proccessData(){
        $this->db->select('nombre, dni, ingreso, dominio,
            salida, status, observaciones,
            quien, vivero, forestal, ganaderia, 
            hotel, yacare, otros, tipovisita, sede, exportado');
        $res = $this->db->get('data')->result();
        var_dump($res);
        foreach ($res as $value) {
            if($value->salida != null)
            {
                $this->db->insert('entradasalida', $value);
            }
        }
        return $res;
    }
}

?>
