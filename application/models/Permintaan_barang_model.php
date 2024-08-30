<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_barang_model extends CI_Model {

  public function get($id = null){
    $this->db->select('
      tbl_permintaan_barang.*, 
      tbl_departement.nama_departement'
    );
    $this->db->from('tbl_permintaan_barang');
    $this->db->join('tbl_departement', 'tbl_departement.id_department = tbl_permintaan_barang.id_departement');
    if($id != null){
      $this->db->where('id_permintaan_barang', $id);
    }
    return $this->db->get();
  }

  public function add($post){
    $params = array(
      'nomor_resi'     => $post['nomor_resi'],
      'id_departement' => $post['id_departement'],
      'inputed_by'     => $post['inputed_by'],
      'note'           => $post['note']
    );
    $this->db->insert('tbl_permintaan_barang', $params);
    return $this->db->insert_id();
  }

  public function insert_batch($data){
		$this->db->insert_batch('tbl_detail_permintaan', $data);
	}





}