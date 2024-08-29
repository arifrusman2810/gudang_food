<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model(['master_barang_model', 'master_satuan_model', 'master_rack_model']);
	}

	public function index()
{
	$data = [
		'title' => 'Master_barang',
		'barang' => $this->master_barang_model->get()->result(),
		'satuan' => $this->master_satuan_model->get()->result(),
		'lokasi' => $this->master_rack_model->get()->result(),
	];

	// print_r($data['barang']);
	// die;

	$this->load->view('_partial/header', $data);
	$this->load->view('_partial/navbar', $data);
	$this->load->view('_partial/sidebar', $data);
	$this->load->view('master_barang/index', $data);
	$this->load->view('_partial/footer', $data);
}

	function get_byId()
	{
		$id =  $this->input->post('Id');
		$usr = $this->Master_model->get_data_byId('user','id_pengguna',$id);
		echo json_encode($usr);
	}

	public function tambah(){
		$post = $this->input->post(null, TRUE);
		// print_r($post);
		// die;
    $this->master_barang_model->add($post);

    if($this->db->affected_rows()){
      echo
        "<script>
          alert('Data berhasil ditambahkan');
          window.location = '".site_url('master/master_barang')."'
        </script>";
    }
    else{
      echo
        "<script>
          alert('Gagal tambah data!');
          window.location = '".site_url('master/master_barang')."'
        </script>";
    }

	}

	// function tambah()
	// {  
	// 	$this->form_validation->set_rules('nama_departement', 'Nama Departement', 'trim|is_unique[departement.nama_departement]',
	// 		[
	// 			'trim'       => 'Input dengan benar',
	// 			'is_unique'  => '%s sudah ada!!!.'
	// 		]
	// 	);
	
	// 	if($this->form_validation->run() == false)
	// 	{
	// 		$output['status'] = 201;
	// 		$output['message'] = validation_errors(); 
	// 		echo json_encode($output);
	// 	}
	// 	else
	// 	{
	// 		$data = [
	// 			'id_departement'   =>  $this->input->post('id_departement'),
	// 			'nama_departement' => $this->input->post('nama_departement'), 
	// 			'keterangan'       => $this->input->post('keterangan'), 
	// 			// Tambahkan field lain yang diperlukan sesuai dengan struktur tabel `departement`
	// 		];
	
	// 		$this->db->insert('departement', $data);
	
	// 		$output['status'] = 200;
	// 		$output['message'] = 'Data berhasil ditambahkan';
	// 		echo json_encode($output);
	// 	}
	// }
	

	function hapus()
	{   
		
		$data = file_get_contents('php://input');
		$id = json_decode($data, TRUE);

		$this->Master_model->hapus_data('user','id_pengguna',$id);
		redirect('master/pengguna');
	}

	function edit()
	{
		$id =  $this->input->post('id_pengguna');
		$data['usr'] = $this->Master_model->get_data_byId('user','id_pengguna',$id);
		$nama_pengguna = $this->input->post('nama_pengguna');

		if($nama_pengguna == $data['usr']['nama_pengguna']){
			$this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'trim',
				[
					'trim'      => 'Input dengan benar'
				]
			);
		}else{
			$this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'trim|is_unique[user.nama_pengguna]',
				[
					'trim'      => 'Input dengan benar',
					'is_unique'     => '%s Sudah ada!!!.'
				]
			);
		}

		if($this->form_validation->run() == false)
		{
			$output['status'] = 201;
			$output['message'] = validation_errors();; 
			echo json_encode($output);
		}else
		{
			$id = $this->input->post('id_pengguna');
			$data = [
				'id_pengguna'   =>  $this->input->post('id_pengguna'),
				'nama_pengguna'   => $this->input->post('nama_pengguna'), 
				'nama_lengkap'    => $this->input->post('nama_lengkap'),
				'status'          => $this->input->post('status')
			];

			$this->Master_model->edit_data('user','id_pengguna',$id,$data);

			$output['status'] = 200;
			$output['message'] = 'Data berhasil diedit';
			echo json_encode($output);

		}

	}
}