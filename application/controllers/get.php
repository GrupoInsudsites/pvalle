<?php


class Get extends CI_Controller {

	public function __construct() {
        parent::__construct();
        
        $this->load->model('evento');
    }
    

    public function getData($posValue = '') {

    	//$data = $posValue;
    	//var_dump($data);
    	$data = json_decode($_POST['token']);
    	//$data
    	$data = (array)$data ;
        $status = "";
    	foreach ($data as $value) {
    		$this->evento->insertBySede($value);
    		$status = "exito";
    	}
        if ($status== "exito"){ 
    	   echo "exito";
        }else{
            echo "No hay archivos para importar";
        }
       	
	}
    public function proccessData()
    {
        $this->evento->proccessData();
        
    }
}

