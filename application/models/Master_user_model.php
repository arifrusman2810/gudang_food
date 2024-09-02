<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_user_model extends CI_Model{

  public function get($id = null){
    $this->db->select('user.*, tbL_role.nama_role, tbl_departement.nama_departement');
    $this->db->from('user');
    $this->db->join('tbL_role', 'tbl_role.id_role = user.id_role');
    $this->db->join('tbL_departement', 'tbl_departement.id_department = user.id_departement');
    if($id != null){
      $this->db->where('id_user', $id_pengguna);
    }
    return $this->db->get();
  }

  public function get_pengguna_by_id($id){
    $this->db->select('user.*, tbL_role.nama_role, tbl_departement.nama_departement');
    $this->db->from('user');
    $this->db->join('tbL_role', 'tbl_role.id_role = user.id_role');
    $this->db->join('tbL_departement', 'tbl_departement.id_department = user.id_departement');
    $this->db->where('id_pengguna', $id);
    return $this->db->get()->row_array();

    // $this->db->where('id_rack', $id_rack);
    // $query = $this->db->get('tbl_rack');
    // return $query->row_array();
	}

  public function get_atasan(){
    $this->db->select('user.id_pengguna, user.nama_lengkap, tbl_departement.nama_departement');
    $this->db->from('user');
    $this->db->join('tbl_role', 'tbl_role.id_role = user.id_role');
    $this->db->join('tbl_departement', 'tbl_departement.id_department = user.id_departement');
    $this->db->where('nama_role', 'atasan');
    return $this->db->get();
  }

  public function getAtasanByDepartement($id_departement){
    $this->db->select('user.id_pengguna, user.nama_lengkap, tbl_departement.nama_departement');
    $this->db->from('user');
    $this->db->join('tbl_departement', 'tbl_departement.id_department = user.id_departement');
    $this->db->join('tbl_role', 'tbl_role.id_role = user.id_role');
    $this->db->where('user.id_departement', $id_departement);
    $this->db->where('tbl_role.nama_role', 'atasan');
    return $this->db->get()->result();


    // $this->db->where('id_departement', $id_departement);
    // return $this->db->get('user')->result(); 
    // Sesuaikan dengan nama tabel yang Anda gunakan
  }


  public function add($post){
    $params = array(
      'id_pengguna'    => $post['id_pengguna'],
      'nama_pengguna'  => $post['nama_pengguna'],
      'nama_lengkap'   => $post['nama_lengkap'],
      'password'       => password_hash($post['password'], PASSWORD_DEFAULT),
      'id_role'        => $post['id_role'],
      'id_departement' => $post['id_departement'],
    );

    // Cek apakah id_atasan tidak kosong
    if (!empty($post['id_atasan'])) {
      $params['id_atasan'] = $post['id_atasan'];
    }

    $this->db->insert('user', $params);
  }

  public function edit($post){
    $params = array(
      'nama_pengguna'  => $post['nama_pengguna'],
      'nama_lengkap'   => $post['nama_lengkap'],
      'id_role'        => $post['id_role'],
      'id_departement' => $post['id_departement'],
    );

    // Cek apakah id_atasan tidak kosong
    if (!empty($post['id_atasan'])) {
      $params['id_atasan'] = $post['id_atasan'];
    }
    
    // Cek apakah id_area_gudang tidak kosong
    if (!empty($post['id_area_gudang'])) {
      $params['id_area_gudang'] = $post['id_area_gudang'];
    }

    // Cek apakah password_baru tidak kosong
    if (!empty($post['password_baru'])) {
      $params['password'] = password_hash($post['password_baru'], PASSWORD_DEFAULT);
    }

    $id = $post['id_pengguna'];
    $this->db->where('id_pengguna', $id);
    $this->db->update('user', $params);
  }



}