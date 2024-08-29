<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang_model extends CI_Model {

  public function get($id = null){
    $this->db->select('tbl_barang.*, tbl_satuan.satuan, tbl_rack.id_area_gudang, tbl_rack.nama_rack, tbl_rack.no_rack, tbl_area_gudang.jenis_gudang, tbl_area_gudang.nama_area');
    $this->db->from('tbl_barang');
    $this->db->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_barang.id_satuan');
    $this->db->join('tbl_rack', 'tbl_rack.id_rack = tbl_barang.id_rack');
    $this->db->join('tbl_area_gudang', 'tbl_area_gudang.id_area_gudang = tbl_rack.id_area_gudang');
    if($id != null){
      $this->db->where('id_barang', $id);
    }
    return $this->db->get();
  }

  public function add($post){
    $params = array(
      'kode_barang' => $post['kode_barang'],
      'nama_barang' => $post['nama_barang'],
      'id_satuan'   => $post['id_satuan'],
      'id_rack'     => $post['id_rack'],
      'stock'       => $post['stock']
    );
    $this->db->insert('tbl_barang', $params);
  }





}