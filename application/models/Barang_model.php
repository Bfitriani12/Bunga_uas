<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'tb_barang';
    }

    // Ambil semua barang
    public function get_all_barang() {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Ambil barang berdasarkan ID
    public function get_barang_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Tambah barang
    public function insert_barang($data) {
        return $this->db->insert($this->table, $data);
    }

    // Update barang
    public function update_barang($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Hapus barang
    public function delete_barang($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
} 