<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller_front {

	function __construct()
        {
            parent::__construct();
            $this->load->model('varios');
        }
	public function index($seccion='')
	{

                $sec = ($seccion=='')?'home':$seccion;
                $args = array('tabla'=>'secciones', 'campo'=>'seccion', 'valor'=>$sec);
                $data['seccion']=$this->varios->getItem($args);

                $args1 = array(
                    'tabla'=>'secciones',
                    'campo_orden'=>'orden',
                    'dir_orden'=>'asc',
                    'campos'=>'id, titulo,seccion, id_seccion '
                    );

                 $args_rotador = array(
                    'tabla'=>'rotador_secciones',
                    'campo_orden'=>'id',
                    'dir_orden'=>'asc',
                    'campo_where'=>'id_sec',
                    'valor_where'=>$data['seccion']->id
                    );
            $data['imgs'] = $this->varios->getItemsArray($args_rotador);
               // var_dump($data['imgs'] );die;
                if(is_null($data['imgs'])){
                    $args_rotador = array(
                        'tabla'=>'rotador_secciones',
                        'campo_orden'=>'id',
                        'dir_orden'=>'asc',
                        'campo_where'=>'id_sec',
                        'valor_where'=>4
                    );
                    $data['imgs'] = $this->varios->getItemsArray($args_rotador);
                }

                $menues = $this->varios->getItemsArray($args1);
                $arg = array('tabla'=>'secciones','campo'=>'seccion','valor'=>'home');
                $seccion = $this->varios->getItem($arg);
                $data['galXsec'] = explode(',',$seccion->galerias);


                $data['menu']=$this->varios->arma_menu($menues,0);


                if(!is_array($data['seccion']) || count($data['seccion'])==0){
                    $args = array('tabla'=>'secciones', 'campo'=>'seccion', 'valor'=>'home');
                    $data['seccion']=$this->varios->getItem($args);
                }
		$this->load->view('front/home',$data);
	}


}
