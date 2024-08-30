<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_barang extends CI_Controller{

  public function __construct(){
    parent::__construct();
    is_logged_in();
    $this->load->library('form_validation');
    $this->load->model(['permintaan_barang_model', 'master_barang_model', 'master_departement', 'master_gudang_model']);
  }

  public function index(){
    $data = [
      'title' => 'permintaan_barang',
      'permintaan_barang' => $this->permintaan_barang_model->get()->result(),
      'barang' => $this->master_barang_model->get()->result(),
      'departement' => $this->master_departement->get()->result(),
      'gudang' => $this->master_gudang_model->get()->result(),
    ];

    // print_r($data['permintaan_barang']);
    // die;

    $this->load->view('_partial/header', $data);
    $this->load->view('_partial/navbar', $data);
    $this->load->view('_partial/sidebar', $data);
    $this->load->view('permintaan_barang/index', $data);
    $this->load->view('_partial/footer', $data);
  }

  public function get_barang_by_area() {
    $id_area_gudang = $this->input->get('id_area_gudang');

    if ($id_area_gudang) {
      // Ambil data barang dari model berdasarkan id_area_gudang
      $barang = $this->master_barang_model->get_barang_by_area($id_area_gudang);
      
      // Kembalikan data dalam format JSON
      echo json_encode($barang);
    } 
    else{
      echo json_encode([]);
    }
  }

  public function get_stock_by_barang() {
    $id_barang = $this->input->get('id_barang');

    if ($id_barang) {
      // Ambil stok barang dari model berdasarkan id_barang
      $stock = $this->master_barang_model->get_stock_by_barang($id_barang);
      echo json_encode(['stock' => $stock]);
    } else {
      echo json_encode(['stock' => 0]);
    }
  }


  public function tambah(){
    $post = $this->input->post(null, TRUE);
    // print_r($post);
    // die;
    $id_permintaan_barang = $this->permintaan_barang_model->add($post);

    // Prepare data for insert
    $id_barang = $post['barang'];
    $qty = $post['qty'];

    $data = [];

    for ($i = 0; $i < count($id_barang); $i++) {
      $data[] = [
        'id_permintaan_barang' => $id_permintaan_barang,
        'id_barang' => $id_barang[$i],
        'qty' => $qty[$i],
      ];
    }


    // foreach ($post['barang'] as $no) {
		// 	$data[] = [
		// 		'id_permintaan_barang' => $id_permintaan_barang,
		// 		'id_barang' => $no,
		// 		'qty' => $post['qty']
		// 	];
    // }

    // Insert batch data ke dalam tbl_detail_permintaan
    $this->db->insert_batch('tbl_detail_permintaan', $data);

    // $this->permintaan_barang_model->insert_batch($data);

    if($this->db->affected_rows()){
      echo
        "<script>
          alert('Permintaan diproses');
          window.location = '".site_url('transaksi/permintaan_barang')."'
        </script>";
    }
    else{
      echo
        "<script>
          alert('Gagal proses!');
          window.location = '".site_url('transaksi/permintaan_barang')."'
        </script>";
    }
  }




}