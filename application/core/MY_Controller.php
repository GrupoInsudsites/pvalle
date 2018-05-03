<?php

class MY_Controller extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('administrador');
        $this->load->model('seccion');
        $this->load->model('varios');
        $this->load->model('galeria');
        $this->load->model('noticia');
        $this->load->model('newsletter');
        $this->load->model('documento');
        $this->load->model('evento');
        
        
        
        
        $this->typeLogin = $this->session->userdata('type');
        $this->sedeLogin = $this->session->userdata('sede');
        
        if (!$this->session->userdata('loggedin'))
        {
            
            $front = $this->input->post('user');
            
			$this->session->set_flashdata('message', 'Su usuario o password son incorrectos, intente nuevamente');
            if(isset($front['front']) && $front['front']==1){
                redirect('login');
            }else{
                
                redirect('sessions/login');
                
            }
        }else{
            
            if((int)$this->session->userdata('type')==3){
                redirect('mapa');
            }
        }
    }
}