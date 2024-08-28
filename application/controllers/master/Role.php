<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('Master_model');
        $this->load->model('Role_model');
    }

    public function index()
    {

        $data = [
            'title' => 'Role',
            'role' =>  $this->Role_model->get_roles(),
            'auto_kode' => $this->Master_model->auto_kode('user',
            'id_pengguna', 'USER')
        ];

        $this->load->view('_partial/header', $data);
        $this->load->view('_partial/navbar', $data);
        $this->load->view('_partial/sidebar', $data);
        $this->load->view('master/role/index',$data);
        $this->load->view('_partial/footer', $data);
    }

    function get_byId()
    {
        $id =  $this->input->post('Id');
        $usr = $this->Master_model->get_data_byId('user','id_pengguna',$id);
        echo json_encode($usr);
    }

    function tambah()
    {  

        return "test";
        // // $data['roles'] = $this->Role_model->get_roles();
        // // var_dump($data['roles']);
        
        // // $this->form_validation->set_rules('nama_role', 'Nama Role', 'trim|is_unique[role.nama_role]',
        // //     [
        // //         'trim'      => 'Input dengan benar',
        // //         'is_unique' => '%s Sudah ada!!!.'
        // //     ]
        // // );
    
        // // if ($this->form_validation->run() == false) {
        // //     $output['status'] = 201;
        // //     $output['message'] = validation_errors(); 
        // //     echo json_encode($output);
        // // } else {
        //     $data = [
        //         'nama_role'   => $this->input->post('nama_role'),
        //     ];
    
        //     try {
        //         $this->db->insert('user', $data);
        //         $output['status'] = 200;
        //         $output['message'] = 'Data berhasil ditambahkan';
        //     } catch (Exception $e) {
        //         $output['status'] = 500;
        //         $output['message'] = 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage();
        //     }
        //     echo json_encode($output);
        // }
    }
    
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