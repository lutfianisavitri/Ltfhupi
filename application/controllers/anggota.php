<?php

class Anggota extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index(){
        $data['anggota'] = $this->db->get('anggota')->result();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('anggota/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah(){
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('anggota/tambah');
        $this->load->view('templates/footer');
    }

    public function simpan(){

        $this->form_validation->set_rules('nomor_anggota','Nomor Anggota','required');
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('telepon','Telepon','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('tanggal_daftar','Tanggal Daftar','required');

        if($this->form_validation->run() == FALSE){
            $this->tambah();
        } else {
            $data = [
                'nomor_anggota' => $this->input->post('nomor_anggota'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'email' => $this->input->post('email'),
                'tanggal_daftar' => $this->input->post('tanggal_daftar'),
                'status' => 'Aktif'
            ];

            $this->db->insert('anggota', $data);
            $this->session->set_flashdata('success','Data berhasil ditambahkan');
            redirect('anggota');
        }
    }

    public function hapus($id){
        $this->db->where('id', $id);
        $this->db->delete('anggota');

        $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
        redirect('anggota');
    }

    public function edit($id){
        $data['anggota'] = $this->db->get_where('anggota', ['id'=>$id])->row();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('anggota/edit',$data);
        $this->load->view('templates/footer'); 
    }

    public function update($id){

        $this->form_validation->set_rules('nama','Nama','required');

        if($this->form_validation->run() == FALSE){
            $this->edit($id);
        } else {
            $data = [
                'nomor_anggota' => $this->input->post('nomor_anggota'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'email' => $this->input->post('email'),
                'tanggal_daftar' => $this->input->post('tanggal_daftar'),
                'status' => $this->input->post('status')
            ];

            $this->db->where('id', $id);
            $this->db->update('anggota', $data);

            $this->session->set_flashdata('success','Data Berhasil diupdate');
            redirect('anggota');
        }
    }
}