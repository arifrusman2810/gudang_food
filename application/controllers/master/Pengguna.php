<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller{

	public function __construct(){
		parent::__construct();
		is_logged_in();
		$this->load->model(['Master_model', 'Role_model', 'master_user_model', 'master_departement', 'master_gudang_model']);
		// $this->load->model('Role_model');
	}

	public function index(){
		$data = [
			'title' => 'Pengguna',
			'user' =>  $this->master_user_model->get()->result(),
			'atasan' =>  $this->master_user_model->get_atasan()->result(),
			'auto_kode' => $this->Master_model->auto_kode('user',
			'id_pengguna', 'USER'),
			'roles' =>  $this->Role_model->get()->result(),
			'departements' =>  $this->master_departement->get()->result(),
			'gudang' =>  $this->master_gudang_model->get()->result(),
		];

		// print_r($data['atasan']);

		$this->load->view('_partial/header', $data);
		$this->load->view('_partial/navbar', $data);
		$this->load->view('_partial/sidebar', $data);
		$this->load->view('master/pengguna/index',$data);
		$this->load->view('_partial/footer', $data);
	}

	function get_byId()
	{
		$id =  $this->input->post('Id');
		$usr = $this->Master_model->get_data_byId('user','id_pengguna',$id);
		echo json_encode($usr);
	}

	public function getAtasanByDepartement(){
    $id_departement = $this->input->post('id_departement');
    $atasan = $this->master_user_model->getAtasanByDepartement($id_departement); // Sesuaikan nama model dan metodenya

    $options = '<option disabled selected value="">-- Pilih Atasan --</option>';
    foreach ($atasan as $data) {
			$options .= '<option value="'.$data->id_pengguna.'">'.$data->nama_lengkap.' ('.$data->nama_departement.')</option>';
    }
    echo $options;
  }


	public function tambah(){
		$post = $this->input->post(null, TRUE);
		// print_r($post);
		// die;

		$this->master_user_model->add($post);
      if($this->db->affected_rows() > 0){
        echo "<script>alert('Data berhasil disimpan');</script>";
      }
      echo "<script>window.location='". site_url('master/pengguna') ."';</script>";
	}
	
	function hapus(){   
		$data = file_get_contents('php://input');
		$id = json_decode($data, TRUE);

		$this->Master_model->hapus_data('user','id_pengguna',$id);
		redirect('master/pengguna');
	}

	public function get_pengguna(){
		$id = $this->input->post('id_pengguna');

    $pengguna_data = $this->master_user_model->get_pengguna_by_id($id);

    echo json_encode($pengguna_data);
	}

	public function edit(){
		$post = $this->input->post(null, TRUE);
    // print_r($post);
    // die;
    $this->master_user_model->edit($post);

    if($this->db->affected_rows()){
      echo
        "<script>
          alert('Data berhasil diubah');
          window.location = '".site_url('master/pengguna')."'
        </script>";
    }
    else{
      echo
        "<script>
          alert('Gagal ubah data!');
          window.location = '".site_url('master/pengguna')."'
        </script>";
    }
	}

	// function edit(){
	// 	$id =  $this->input->post('id_pengguna');
	// 	$data['usr'] = $this->Master_model->get_data_byId('user','id_pengguna',$id);
	// 	$nama_pengguna = $this->input->post('nama_pengguna');

	// 	if($nama_pengguna == $data['usr']['nama_pengguna']){
	// 		$this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'trim',
	// 			[
	// 				'trim'      => 'Input dengan benar'
	// 			]
	// 		);
	// 	}else{
	// 		$this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'trim|is_unique[user.nama_pengguna]',
	// 			[
	// 				'trim'      => 'Input dengan benar',
	// 				'is_unique'     => '%s Sudah ada!!!.'
	// 			]
	// 		);
	// 	}

	// 	if($this->form_validation->run() == false)
	// 	{
	// 		$output['status'] = 201;
	// 		$output['message'] = validation_errors();; 
	// 		echo json_encode($output);
	// 	}else
	// 	{
	// 		$id = $this->input->post('id_pengguna');
	// 		$data = [
	// 			'id_pengguna'   =>  $this->input->post('id_pengguna'),
	// 			'nama_pengguna'   => $this->input->post('nama_pengguna'), 
	// 			'nama_lengkap'    => $this->input->post('nama_lengkap'),
	// 			'status'          => $this->input->post('status')
	// 		];

	// 		$this->Master_model->edit_data('user','id_pengguna',$id,$data);

	// 		$output['status'] = 200;
	// 		$output['message'] = 'Data berhasil diedit';
	// 		echo json_encode($output);

	// 	}

	// }
}