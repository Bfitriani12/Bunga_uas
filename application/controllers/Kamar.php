<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kamar_model');
        $this->load->model('Barang_model');
        $this->load->model('KamarBarang_model');
        $this->load->library('form_validation');
    }

    // Daftar semua kamar
    public function index() {
        $data['title'] = 'Data Kamar';
        $data['kamar'] = $this->Kamar_model->get_all_kamar();
        $data['stats'] = $this->Kamar_model->get_kamar_stats();
        $this->load->view('kamar/index', $data);
    }

    // Tambah kamar
    public function add() {
        $data['title'] = 'Tambah Kamar Baru';
        $data['all_barang'] = $this->Barang_model->get_all_barang();
        if ($this->input->post()) {
            $this->form_validation->set_rules('nomor', 'Nomor Kamar', 'required|trim|is_unique[tb_kamar.nomor]');
            $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
            if ($this->form_validation->run() == TRUE) {
                $data_kamar = array(
                    'nomor' => $this->input->post('nomor'),
                    'harga' => $this->input->post('harga'),
                    'status' => $this->input->post('status')
                );
                if ($this->Kamar_model->insert_kamar($data_kamar)) {
                    $id_kamar = $this->db->insert_id();
                    $barang_ids = $this->input->post('barang') ?? array();
                    $this->KamarBarang_model->set_barang_for_kamar($id_kamar, $barang_ids);
                    $this->session->set_flashdata('success', 'Kamar berhasil ditambahkan!');
                    redirect('kamar');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan kamar!');
                }
            }
        }
        $this->load->view('kamar/form', $data);
    }

    // Edit kamar
    public function edit($id = null) {
        if (!$id) redirect('kamar');
        $data['title'] = 'Edit Data Kamar';
        $data['kamar'] = $this->Kamar_model->get_kamar_by_id($id);
        $data['all_barang'] = $this->Barang_model->get_all_barang();
        $data['barang_kamar'] = array_map(function($b){return $b->id;}, $this->KamarBarang_model->get_barang_by_kamar($id));
        if (!$data['kamar']) {
            $this->session->set_flashdata('error', 'Data kamar tidak ditemukan!');
            redirect('kamar');
        }
        if ($this->input->post()) {
            $this->form_validation->set_rules('nomor', 'Nomor Kamar', 'required|trim');
            $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
            if ($this->form_validation->run() == TRUE) {
                $data_update = array(
                    'nomor' => $this->input->post('nomor'),
                    'harga' => $this->input->post('harga'),
                    'status' => $this->input->post('status')
                );
                if ($this->Kamar_model->update_kamar($id, $data_update)) {
                    $barang_ids = $this->input->post('barang') ?? array();
                    $this->KamarBarang_model->set_barang_for_kamar($id, $barang_ids);
                    $this->session->set_flashdata('success', 'Data kamar berhasil diupdate!');
                    redirect('kamar');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupdate data kamar!');
                }
            }
        }
        $this->load->view('kamar/form', $data);
    }

    // Hapus kamar
    public function delete($id = null) {
        if (!$id) redirect('kamar');
        if ($this->Kamar_model->delete_kamar($id)) {
            $this->session->set_flashdata('success', 'Data kamar berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data kamar!');
        }
        redirect('kamar');
    }

    // Detail kamar
    public function view($id = null) {
        if (!$id) redirect('kamar');
        $data['title'] = 'Detail Kamar';
        $data['kamar'] = $this->Kamar_model->get_kamar_by_id($id);
        $data['barang_kamar'] = $this->KamarBarang_model->get_barang_by_kamar($id);
        if (!$data['kamar']) {
            $this->session->set_flashdata('error', 'Data kamar tidak ditemukan!');
            redirect('kamar');
        }
        $this->load->view('kamar/view', $data);
    }
} 