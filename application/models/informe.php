<?php
class Informe extends CI_Model {

	public function getEntradas($filtros){
		if($filtros['desde'] != $filtros['hasta']){
            if($filtros['desde'] !=''){
                $this->db->where('entradasalida.ingreso >=',$filtros['desde']);
            }
            if($filtros['hasta'] !=''){
                $this->db->where('entradasalida.ingreso  <=',$filtros['hasta']);
            }
        }else if($filtros['desde'] == $filtros['hasta'] && $filtros['desde']!=''){
            $this->db->like('entradasalida.ingreso ',$filtros['desde']);
        }

        if($filtros['tipovisita']!='' && $filtros['tipovisita']!='todos'){
            $this->db->where('tipovisita', $filtros['tipovisita']);
        }
        if($filtros['sedes'] != ''){
            $this->db->where('sede', $filtros['sedes']);
        }

       

        $res = $this->db->get('entradasalida')->result();
        
       
        return $res;
	}
    public function getSedes(){

        $query = $this->db->get('sedes')->result();
        return $query;
    }


}