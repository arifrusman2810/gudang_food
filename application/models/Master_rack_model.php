<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_rack_model extends CI_Model {

	public function get(){
		$this->db->select('tbl_rack.*, tbl_area_gudang.jenis_gudang, tbl_area_gudang.nama_area');
		$this->db->from('tbl_rack');
		$this->db->join('tbl_area_gudang', 'tbl_area_gudang.id_area_gudang = tbl_rack.id_area_gudang');
		return $this->db->get();
	}

	public function add($post){
		$params = array(
      'id_area_gudang' => $post['id_area_gudang'],
      'nama_rack'      => $post['nama_rack'],
      'no_rack'  		   => $post['no_rack'],
    );
    $this->db->insert('tbl_rack', $params);
	}

	public function insert_batch($data){
		$this->db->insert_batch('tbl_rack', $data);
	}

	public function get_rack_by_id($id_rack){
    $this->db->where('id_rack', $id_rack);
    $query = $this->db->get('tbl_rack');
    return $query->row_array(); // Mengembalikan data dalam bentuk array asosiatif
	}

	public function edit($post){
    $params = array(
      'id_area_gudang' => $post['id_area_gudang'],
      'nama_rack'      => $post['nama_rack'],
      'no_rack'        => $post['no_rack'][0],
    );
    $id = $post['id_rack'];
    $this->db->where('id_rack', $id);
    $this->db->update('tbl_rack', $params);
  }
	
	// public function edit($post){
  //   $params = array(
  //     'id_area_gudang' => $post['id_area_gudang'],
  //     'nama_rack'      => $post['nama_rack'],
  //     'no_rack'        => $post['no_rack'],
  //   );
  //   $id = $post['id_rack'];
  //   $this->db->where('id_rack', $id);
  //   $this->db->update('tbl_rack', $params);
  // }

	public function get_departments() {
		return $this->db->get('tbl_departement')->result_array();
	}

	public function get_department($table, $order_by) {
		return $this->db->order_by($order_by, 'ASC')->get($table)->result_array();
	}

	public function insert_department($data) {
		return $this->db->insert('tbl_departement', $data);
	}

	public function update_department($id, $data) {
		$this->db->where('id_department ', $id);
		return $this->db->update('tbl_departement', $data);
	}

	public function delete_department($id) {
		$this->db->where('id_department ', $id);
		return $this->db->delete('tbl_departement');
	}
}
