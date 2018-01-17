<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends MY_Controller {
    /* usuarios */

    public function index($indice=0, $criterio= '') {

        $admin = $this->user->is_admin($this->session->userdata('id'));
        if (!$admin) {
            redirect(base_url() . 'admin/admin', 'location');
        }
        $data = array();
        $data['menu_top'] = 'admin/menu_top';
        $data['menu_iz'] = 'admin/menu_iz';
        $data['col_derecha'] = 'admin/usuarios/col_derecha_usuarios';
        $data['listado'] = 'admin/usuarios/listado_usuarios';
        $data['menusel'] = "usuarios";
        $data['usuarios'] = $this->user->get_users($indice, urldecode($criterio));
        //$data['cias'] = $this->cia->get_all_cias();
        $data['pag_sel'] = $indice;
        $data['criterio'] = urldecode($criterio);
        $args = array('tabla'=>'barrios','campo_orden'=>'id','dir_orden'=>'asc');
        $data['barrios'] = $this->varios->getItems($args);
        $all = $this->user->get_all_users(urldecode($criterio));
        $data['cant'] = count($all);
        $data['admin'] = $this->user->is_admin($this->session->userdata('id'));
        $this->load->view('admin/admin_ancho', $data);
    }

    public function crear() {
        $submit = $this->input->post('submit');
        if ($submit != '') {
            $u = $this->input->post('user');
            $this->load->model('user');

            $existe = $this->user->email_exists($u['email']);
            if (!$existe) {
                $this->user->registro_usuario($u);
                $this->session->set_flashdata('message', 'El usuario ha sido creado');
                redirect(base_url() . 'admin/usuarios/index', 'location');
            } else {
                $this->session->set_flashdata('message', 'El usuario ya existe');
                redirect(base_url() . 'admin/usuarios/index', 'location');
            }
        }
        $data = array();
        $data['menu_top'] = 'admin/menu_top';
        $data['menu_iz'] = 'admin/menu_iz';
        
        $data['col_derecha'] = 'admin/usuarios/col_derecha_usuarios_form';
        $data['listado'] = 'admin/usuarios/form_usuario';
        $data['usuarios'] = $this->user->get_users();
        $args = array('tabla'=>'barrios','campo_orden'=>'id','dir_orden'=>'asc');
        $data['barrios'] = $this->varios->getItemsForDropdown($args);
        $data['admin'] = $this->user->is_admin($this->session->userdata('id'));
        $data['menusel'] = "usuarios";
        $this->load->view('admin/admin', $data);
    }

    public function editar($id=0) {
        $submit = $this->input->post('submit');
        
        if ($submit != '') {
            $this->user->editar_usuario();
            $this->session->set_flashdata('message', 'El usuario ha sido actualizado');
            redirect(base_url() . 'admin/usuarios/index', 'location');
        }
        $data['item'] = $this->user->get_user($id);
        $data['menu_top'] = 'admin/menu_top';
        $data['menu_iz'] = 'admin/menu_iz';
        $data['col_derecha'] = 'admin/usuarios/col_derecha_usuarios_form';
        $args = array('tabla'=>'barrios','campo_orden'=>'id','dir_orden'=>'asc');
        $data['barrios'] = $this->varios->getItemsForDropdown($args);
        $data['listado'] = 'admin/usuarios/form_usuario_edit';
        $data['admin'] = $this->user->is_admin($this->session->userdata('id'));
        $data['menusel'] = "usuarios";
        $this->load->view('admin/admin', $data);
    }

    public function borrar($id) {
        $this->user->borrar_usuario($id);
        $this->session->set_flashdata('message', 'El usuario eliminado');
        redirect(base_url() . 'admin/usuarios', 'location');
    }

    /* Fin usuarios */

   
}