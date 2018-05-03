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
    	foreach ($data as $value) {
            
            $value->id = $value->sede . $value->id;
    		$this->evento->insertBySede($value);
    		$status = "exito";
    	}

    	echo "exito";
       	
	}
}

