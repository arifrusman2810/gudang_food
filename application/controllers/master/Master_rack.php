<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_rack extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model(['Master_rack_model', 'master_gudang_model']);
	}

	public function index(){
	$data = [
		'title' => 'Master_rack',
		'area_gudang' => $this->master_gudang_model->get()->result(),
		'rack' => $this->Master_rack_model->get()->result()
	];

	// print_r($data['rack']);
	// die;

	$this->load->view('_partial/header', $data);
	$this->load->view('_partial/navbar', $data);
	$this->load->view('_partial/sidebar', $data);
	$this->load->view('master_rack/index', $data);
	$this->load->view('_partial/footer', $data);
}

	// function get_byId()
	// {
	// 	$id =  $this->input->post('Id');
	// 	$usr = $this->Master_model->get_data_byId('user','id_pengguna',$id);
	// 	echo json_encode($usr);
	// }

	function tambah(){ 
		$post = $this->input->post(null, TRUE);
		// print_r($post);
		// die;

		// Prepare data for insert
    $data = [];
    foreach ($post['no_rack'] as $no) {
			$data[] = [
				'id_area_gudang' => $post['id_area_gudang'],
				'nama_rack' => $post['nama_rack'],
				'no_rack' => $no,
			];
    }

    $this->Master_rack_model->insert_batch($data);

    if($this->db->affected_rows()){
      echo
        "<script>
          alert('Data berhasil ditambahkan');
          window.location = '".site_url('master/master_rack')."'
        </script>";
    }
    else{
      echo
        "<script>
          alert('Gagal tambah data!');
          window.location = '".site_url('master/master_rack')."'
        </script>";
    }
	}

	public function get_rack() {
    $id_rack = $this->input->post('id_rack');

    $rack_data = $this->Master_rack_model->get_rack_by_id($id_rack);

    echo json_encode($rack_data);

		// Mengirim keview
		// $data['rack_json'] = json_encode($rack_data);
		// $this->load->view('master_rack/index', $data);
	}

	public function edit(){
		$post = $this->input->post(null, TRUE);
    // print_r($post);
    // die;
    $this->Master_rack_model->edit($post);

    if($this->db->affected_rows()){
      echo
        "<script>
          alert('Data berhasil diubah');
          window.location = '".site_url('master/master_rack')."'
        </script>";
    }
    else{
      echo
        "<script>
          alert('Gagal ubah data!');
          window.location = '".site_url('master/master_rack')."'
        </script>";
    }
	}

	

	function hapus(){   
		
		$data = file_get_contents('php://input');
		$id = json_decode($data, TRUE);

		$this->Master_model->hapus_data('user','id_pengguna',$id);
		redirect('master/pengguna');
	}

}