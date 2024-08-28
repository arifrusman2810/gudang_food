<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_gudang_model extends CI_Model {

  public function get(){
    $this->db->select('*');
    $this->db->from('tbl_area_gudang');
    return $this->db->get();
  }





}