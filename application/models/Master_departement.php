<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_departement extends CI_Model {

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
