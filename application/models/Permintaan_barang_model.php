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

  public function get_permintaan_by_id($id){
    // Ambil data permintaan berdasarkan ID
    $this->db->select('
      tbl_permintaan_barang.*, 
      tbl_departement.nama_departement'
    );
    $this->db->from('tbl_permintaan_barang');
    $this->db->join('tbl_departement', 'tbl_departement.id_department = tbl_permintaan_barang.id_departement');
    $this->db->where('id_permintaan_barang', $id);
    $permintaan = $this->db->get()->row_array();

    // Ambil detail permintaan berdasarkan ID permintaan
    $this->db->select('tbl_detail_permintaan.*, tbl_barang.kode_barang, tbl_barang.nama_barang, tbl_area_gudang.jenis_gudang, tbl_area_gudang.nama_area');
    $this->db->from('tbl_detail_permintaan');
    $this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_detail_permintaan.id_barang');
    $this->db->join('tbl_area_gudang', 'tbl_area_gudang.id_area_gudang = tbl_barang.id_area_gudang');
    $this->db->where('id_permintaan_barang', $id);
    $details = $this->db->get()->result_array();

    // Gabungkan data permintaan dengan detailnya
    $permintaan['details'] = $details;

    return $permintaan;
	}

  public function approve($post){
    $id = $post['id_permintaan_barang'];

    if(!empty($post['approved_by'])){
      $params = array(
        'status' => 'Diterima',
        'gudang_by' => $this->session->userdata('name'),
        'waktu_gudang' => date('Y-m-d H:i:s'),
        'tgl_gudang' => date('Y-m-d')
      );

      // Kurangi stok barang berdasarkan qty dari tbl_detail_permintaan
      $this->db->select('id_barang, qty');
      $this->db->from('tbl_detail_permintaan');
      $this->db->where('id_permintaan_barang', $id);
      $details = $this->db->get()->result();

      foreach ($details as $detail) {
        // Kurangi stok barang di tabel barang
        $this->db->set('stock', 'stock - ' . $detail->qty, FALSE);
        $this->db->where('id_barang', $detail->id_barang);
        $this->db->update('tbl_barang');
      }
    }
    else{
      $params = array(
        'status' => 'Diapprove',
        'approved_by' => $this->session->userdata('name'),
        'waktu_approve' => date('Y-m-d H:i:s'),
        'tgl_approve' => date('Y-m-d')
      );
    }

    $this->db->where('id_permintaan_barang', $id);
    $this->db->update('tbl_permintaan_barang', $params);
  }





}