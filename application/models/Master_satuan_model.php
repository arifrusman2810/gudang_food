<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_satuan_model extends CI_Model {

  public function get(){
    $this->db->select('*');
    $this->db->from('tbl_satuan');
    return $this->db->get();
  }


}