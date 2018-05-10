<?php
class Informes extends MY_Controller {

    public function __construct() {
        parent::__construct();
         
        $this->load->model('informe');
    }
    
    /**
     * informe de accesos
     * @param  integer $pag [description]
     * @return [type]       [description]
     */
    public function index() {
        

        $fechas['desde']                = (isset($_POST['desde']))?$_POST['desde']:'';
        $fechas['hasta']                = (isset($_POST['hasta']))?$_POST['hasta']:'';
        $fechas['tipovisita']           = (isset($_POST['tipovisita']))?$_POST['tipovisita']:'';
        if($this->typeLogin == 1){
            $fechas['sedes']            = (isset($_POST['sedes']))?$_POST['sedes']:'';
            $data['sedes']              = $this->informe->getSedes();
            $data['select'] = $fechas['sedes'];
            
        }elseif($this->typeLogin == 2){
            $fechas['sedes'] = $this->sedeLogin;
            //$data['sede']                   =  $fechas['sedes']  ;
        }elseif($this->typeLogin == 4){
            $userSedes = explode('-', $this->sedeLogin);
            $fechas['sedes']            = (isset($_POST['sedes']))?$_POST['sedes']:'';
            $data['select'] = $fechas['sedes'];
            
            $data['sedes']              = $this->evento->getSedesByAdmon($userSedes);
            //$data['sede']                   =  $fechas['sedes']  ;
        }
        if ($fechas['sedes'] != '') {
            $this->db->where('id', $fechas['sedes']);
            $sede = $this->db->get('sedes')->result();
            if(isset($sede[0])){
                $data['sede'] = $sede[0]->nombre;
            }else {
                $data['sede'] = '';
            }
        }else {
            $data['sede'] = 'Seleccione una sede';
        }
        $data['admin'] = $this->typeLogin;
        $data['hasta']                  = $fechas['hasta'];
        $data['desde']                  = $fechas['desde'];
        $data['tipovisita']             = $fechas['tipovisita'];

        
        $filtros                        = array(
                                            'desde'         => $fechas['desde'], 
                                            'hasta'         => $fechas['hasta'],
                                            'tipovisita'    => $fechas['tipovisita'], 
                                            'sedes'          => $fechas['sedes'], 
                                            'loginSede'     => $this->sedeLogin,                               

                                        );
        
        
        $data['menusel']                = "informes";
        $data['listado']                = 'admin/informe';
        $data['entradassalidas']        = $this->informe->getEntradas($filtros);
        $empresas = '';
        $emp=array(
            'vivero' => 0,
            'forestal' => 0,
            'ganaderia' => 0,
            'hotel' => 0,
            'yacare' => 0,
            'otros' =>0
            );
       
        foreach ($data['entradassalidas'] as $es) {
            $validation = true;
            if($es->vivero == 1){
                $emp['vivero'] += 1;
                $validation = false;
            }
            if($es->forestal == 1){
               $emp['forestal'] += 1;
               $validation = false;
            }
            if($es->ganaderia == 1){
                $emp['ganaderia'] += 1;
                $validation = false;
            }
            if($es->hotel == 1){
                $emp['hotel'] += 1;
                $validation = false;
            }
            if($es->yacare == 1){
                $emp['yacare'] += 1;
                $validation = false;
            }
            if($es->otros == 1){
                $emp['otros'] += 1;
                $validation = false;
            }
            if($validation){
                $emp['otros'] += 1;
            }



        }
        $data['emp'] =  $emp;

        $data['empresas'] = $empresas;
        $tot = 0;
        foreach ($emp as $key => $value) {
            $tot += $value; 
        }
        $por = array();
        foreach ($emp as $key => $value) {
            if($tot>0){
                $por[$key] = round(($value * 100) /$tot);
            }
        }

        $data['total'] =$tot;
        $data['por'] =$por;

        $data['menu_top'] = 'admin/menu_top';
         $this->load->view('admin/admin_info', $data);
    }

	public function borra_linea($id=0){
		if($this->session->userdata['id']==14 || $this->session->userdata['id']==1){
			$this->db->where('id', $id);
			$this->db->delete('entradasalida');
		}
		redirect(base_url() . 'admin/informes/index', 'location');
	}

}
