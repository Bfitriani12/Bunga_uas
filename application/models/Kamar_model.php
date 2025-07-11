<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'tb_kamar';
    }

    // Ambil semua kamar
    public function get_all_kamar() {
        $this->db->order_by('nomor', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Ambil kamar berdasarkan ID
    public function get_kamar_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Tambah kamar
    public function insert_kamar($data) {
        return $this->db->insert($this->table, $data);
    }

    // Update kamar
    public function update_kamar($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Hapus kamar
    public function delete_kamar($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Statistik kamar
    public function get_kamar_stats() {
        $stats = array();
        $stats['total'] = $this->db->count_all($this->table);
        $this->db->where('status', 'tersedia');
        $stats['tersedia'] = $this->db->count_all_results($this->table);
        $this->db->where('status', 'terisi');
        $stats['terisi'] = $this->db->count_all_results($this->table);
        return $stats;
    }
} 