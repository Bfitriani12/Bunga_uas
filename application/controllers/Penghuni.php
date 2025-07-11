<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Penghuni_model');
        $this->load->library('form_validation');
    }

    // Index - Show all penghuni
    public function index() {
        $data['title'] = 'Data Penghuni';
        $data['penghuni'] = $this->Penghuni_model->get_all_penghuni();
        $data['stats'] = $this->Penghuni_model->get_penghuni_stats();
        
        $this->load->view('penghuni/index', $data);
    }

    // Add new penghuni
    public function add() {
        $data['title'] = 'Tambah Penghuni Baru';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
            $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|is_unique[tb_penghuni.no_ktp]');
            $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim');
            $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
            
            if ($this->form_validation->run() == TRUE) {
                $data_penghuni = array(
                    'nama' => $this->input->post('nama'),
                    'no_ktp' => $this->input->post('no_ktp'),
                    'no_hp' => $this->input->post('no_hp'),
                    'tgl_masuk' => $this->input->post('tgl_masuk')
                );
                
                if ($this->Penghuni_model->insert_penghuni($data_penghuni)) {
                    $this->session->set_flashdata('success', 'Data penghuni berhasil ditambahkan!');
                    redirect('penghuni');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan data penghuni!');
                }
            }
        }
        
        $this->load->view('penghuni/form', $data);
    }

    // Edit penghuni
    public function edit($id = null) {
        if (!$id) {
            redirect('penghuni');
        }
        
        $data['title'] = 'Edit Data Penghuni';
        $data['penghuni'] = $this->Penghuni_model->get_penghuni_by_id($id);
        
        if (!$data['penghuni']) {
            $this->session->set_flashdata('error', 'Data penghuni tidak ditemukan!');
            redirect('penghuni');
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
            $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim');
            $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim');
            $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
            
            // Check if no_ktp exists (excluding current record)
            if ($this->input->post('no_ktp') != $data['penghuni']->no_ktp) {
                if ($this->Penghuni_model->check_no_ktp_exists($this->input->post('no_ktp'), $id)) {
                    $this->form_validation->set_message('no_ktp', 'No KTP sudah terdaftar!');
                    $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim|is_unique[tb_penghuni.no_ktp]');
                }
            }
            
            if ($this->form_validation->run() == TRUE) {
                $data_update = array(
                    'nama' => $this->input->post('nama'),
                    'no_ktp' => $this->input->post('no_ktp'),
                    'no_hp' => $this->input->post('no_hp'),
                    'tgl_masuk' => $this->input->post('tgl_masuk'),
                    'tgl_keluar' => $this->input->post('tgl_keluar') ? $this->input->post('tgl_keluar') : null
                );
                
                if ($this->Penghuni_model->update_penghuni($id, $data_update)) {
                    $this->session->set_flashdata('success', 'Data penghuni berhasil diupdate!');
                    redirect('penghuni');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupdate data penghuni!');
                }
            }
        }
        
        $this->load->view('penghuni/form', $data);
    }

    // Delete penghuni
    public function delete($id = null) {
        if (!$id) {
            redirect('penghuni');
        }
        
        if ($this->Penghuni_model->delete_penghuni($id)) {
            $this->session->set_flashdata('success', 'Data penghuni berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data penghuni!');
        }
        
        redirect('penghuni');
    }

    // View penghuni detail
    public function view($id = null) {
        if (!$id) {
            redirect('penghuni');
        }
        
        $data['title'] = 'Detail Penghuni';
        $data['penghuni'] = $this->Penghuni_model->get_penghuni_by_id($id);
        
        if (!$data['penghuni']) {
            $this->session->set_flashdata('error', 'Data penghuni tidak ditemukan!');
            redirect('penghuni');
        }
        
        $this->load->view('penghuni/view', $data);
    }

    // Get active penghuni (for AJAX)
    public function get_active() {
        $penghuni = $this->Penghuni_model->get_active_penghuni();
        echo json_encode($penghuni);
    }

    // Search penghuni
    public function search() {
        $keyword = $this->input->get('keyword');
        
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('no_ktp', $keyword);
            $this->db->or_like('no_hp', $keyword);
            $data['penghuni'] = $this->db->get('tb_penghuni')->result();
        } else {
            $data['penghuni'] = $this->Penghuni_model->get_all_penghuni();
        }
        
        $data['title'] = 'Hasil Pencarian Penghuni';
        $data['keyword'] = $keyword;
        
        $this->load->view('penghuni/index', $data);
    }
} 