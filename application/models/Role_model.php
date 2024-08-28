<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {
    public function get_roles() {
        return $this->db->get('tbl_role')->result_array();
    }
    
}