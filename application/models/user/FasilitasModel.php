<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class FasilitasModel extends CI_Model {

    public function get_fasilitas_single($id)
    {
        return $this->db->get_where('data_fasilitas', array('no' => $id));
    }

    public function get_fasilitas()
    {
        return $this->db->get('data_fasilitas');
    }

}

/* End of file ModelName.php */


