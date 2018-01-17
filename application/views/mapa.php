<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mapa extends MY_Controller {

    public function index($id=0) {
        if ($id != 0) {
            $this->session->set_userdata('campa_id', $id);
        } else {
            $this->session->set_userdata('campa_id', 0);
        }
        $data['campa'] = $this->campaign->get_campa_by_usuario();
        if (isset($data['campa'][0]->id_cliente)) {
            $data['cia'] = $this->cia->get_cia($data['campa'][0]->id_cliente);
            $this->session->set_userdata('cia_id', $data['cia']->id);
        }
        if($id==0){
            foreach($data['campa'] as $cam){
                $ico[] = $this->iconos->get_iconos_by_campa($cam->id);
            }
        }else{
            $ico = $this->iconos->get_iconos_by_campa($id);
        }
        $data['id_campa'] = $id;
        $data['ico']=$ico;
        // var_dump($data['campa']);die;
        $this->load->view('mapa', $data);
    }

    public function camino($id=0) {
        if ($id != 0) {
            $this->session->set_userdata('campa_id', $id);
        } else {
            $this->session->set_userdata('campa_id', 0);
        }
        $data['campa'] = $this->campaign->get_campa_by_usuario();
        $data['cia'] = $this->cia->get_cia($data['campa'][0]->id_cliente);
        // var_dump($data['campa']);die;
        $this->load->view('mapa', $data);
    }

    public function trae_mapas($id_campa=0) {
        $this->load->model('Mapas');
        $this->load->model('Soportes');
        if ($id_campa == 0) {
            $campa = $this->campaign->get_primer_campa_by_user($this->session->userdata('id'));

            //$soportes = $this->soportes->get_all_soportes_front($campa->id);
            $usr = $this->session->userdata('id');
            $soportes = $this->soportes->get_all_soportes_front($usr);
        } else {
            $campa = $this->campaign->get_campa($id_campa);
            $soportes = $this->soportes->get_soportes_front($campa->id);
        }


        echo '{"places":' . json_encode($soportes) . '}';
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
