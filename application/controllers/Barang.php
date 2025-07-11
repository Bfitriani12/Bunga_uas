<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
    }

    // Daftar semua barang
    public function index() {
        $data['title'] = 'Data Barang/Alat';
        $data['barang'] = $this->Barang_model->get_all_barang();
        $this->load->view('barang/index', $data);
    }

    // Tambah barang
    public function add() {
        $data['title'] = 'Tambah Barang/Alat';
        if ($this->input->post()) {
            $this->form_validation->set_rules('nama', 'Nama Barang', 'required|trim|is_unique[tb_barang.nama]');
            $this->form_validation->set_rules('harga', 'Biaya Tambahan', 'required|numeric');
            if ($this->form_validation->run() == TRUE) {
                $data_barang = array(
                    'nama' => $this->input->post('nama'),
                    'harga' => $this->input->post('harga')
                );
                if ($this->Barang_model->insert_barang($data_barang)) {
                    $this->session->set_flashdata('success', 'Barang berhasil ditambahkan!');
                    redirect('barang');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan barang!');
                }
            }
        }
        $this->load->view('barang/form', $data);
    }

    // Edit barang
    public function edit($id = null) {
        if (!$id) redirect('barang');
        $data['title'] = 'Edit Data Barang';
        $data['barang'] = $this->Barang_model->get_barang_by_id($id);
        if (!$data['barang']) {
            $this->session->set_flashdata('error', 'Data barang tidak ditemukan!');
            redirect('barang');
        }
        if ($this->input->post()) {
            $this->form_validation->set_rules('nama', 'Nama Barang', 'required|trim');
            $this->form_validation->set_rules('harga', 'Biaya Tambahan', 'required|numeric');
            if ($this->form_validation->run() == TRUE) {
                $data_update = array(
                    'nama' => $this->input->post('nama'),
                    'harga' => $this->input->post('harga')
                );
                if ($this->Barang_model->update_barang($id, $data_update)) {
                    $this->session->set_flashdata('success', 'Data barang berhasil diupdate!');
                    redirect('barang');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupdate data barang!');
                }
            }
        }
        $this->load->view('barang/form', $data);
    }

    // Hapus barang
    public function delete($id = null) {
        if (!$id) redirect('barang');
        if ($this->Barang_model->delete_barang($id)) {
            $this->session->set_flashdata('success', 'Data barang berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data barang!');
        }
        redirect('barang');
    }

    // Detail barang
    public function view($id = null) {
        if (!$id) redirect('barang');
        $data['title'] = 'Detail Barang';
        $data['barang'] = $this->Barang_model->get_barang_by_id($id);
        if (!$data['barang']) {
            $this->session->set_flashdata('error', 'Data barang tidak ditemukan!');
            redirect('barang');
        }
        $this->load->view('barang/view', $data);
    }
} 