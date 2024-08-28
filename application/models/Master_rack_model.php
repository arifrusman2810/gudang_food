<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_rack_model extends CI_Model {

	public function get(){
		$this->db->select('*');
		$this->db->from('tbl_rack');
		return $this->db->get();
	}

	public function add($post){
		$params = array(
      'area_rack'   => $post['area_rack'],
      'kode_rack'   => $post['kode_rack'],
      'no_rack'   => $post['no_rack'],
    );
    $this->db->insert('tbl_rack', $params);
	}

	public function get_rack_by_id($id_rack) {
    $this->db->where('id_rack', $id_rack);
    $query = $this->db->get('tbl_rack');
    return $query->row_array(); // Mengembalikan data dalam bentuk array asosiatif
	}

	public function edit($post){
    $params = array(
      'area_rack'   => $post['area_rack'],
      'kode_rack'   => $post['kode_rack'],
      'no_rack'   => $post['no_rack'],
    );
    $id = $post['id_rack'];
    $this->db->where('id_rack', $id);
    $this->db->update('tbl_rack', $params);
  }


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
