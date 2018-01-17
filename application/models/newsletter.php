<?php
class Newsletter extends CI_Model {

    public function registro($u) {
        //var_dump($u);die;
        
        $fecha = date('Y-m-d');
        $data = array(
            
            'titulo' => $u['titulo'],
            'subject' => $u['subject'],
            'texto' => $u['texto'],
            'fecha' => $fecha
            
        );
        
        $this->db->insert('newsletters', $data);
        
        
    }

    public function edicion() {
        $u = $this->input->post('item');
        
        $data = array(
            
            'titulo' => $u['titulo'],
            'subject' => $u['subject'],
            'texto' => $u['texto']
        );
        $this->db->where('id', $u['id']);
        $this->db->update('newsletters', $data);
    }
    
    public function envio1($id){
        foreach ($list as $name => $address)
        {
            $this->email->clear();

            $this->email->to($address);
            $this->email->from('your@example.com');
            $this->email->subject('Here is your info '.$name);
            $this->email->message('Hi '.$name.' Here is the info you requested.');
            $this->email->send();
        }

    }

    public function envio()
    {
        $u = $this->input->post('item');
        $args1=array('tabla'=>'newsletters','campo'=>'id','valor'=>$u['id']);
        $item = $this->varios->getItem($args1);
        $email['title'] = $item->titulo;
        $email['content'] = $item->texto;
        $message = $this->load->view('admin/newsletters/newsletter', $email, TRUE); // include the HTML code before send

        $config['mailtype'] = 'html';

        $this->email->initialize($config);

        $this->email->from('enerone@gmail.com');
        $this->email->to('enerone@gmail.com');
        
        $this->email->print_debugger();
    }  
	

    
}
