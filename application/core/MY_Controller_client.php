<?php

class MY_Controller extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('campaign');
        $this->load->model('cia');
        $this->load->model('soportes');
        $this->load->model('iconos');
        $this->load->model('caminos');
        //$this->load->library('session');
        //var_dump($this->session->userdata('loggedin'));
        
        if (!$this->session->userdata('loggedin'))
        {
            redirect('sessions/login');
        }else{
            //var_dump((int)$this->session->userdata('type'));die();
            if((int)$this->session->userdata('type')>2){
                redirect('mapa');
            }
        }
    }
}