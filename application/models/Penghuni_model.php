<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'tb_penghuni';
    }

    // Get all penghuni
    public function get_all_penghuni() {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Get penghuni by ID
    public function get_penghuni_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Insert new penghuni
    public function insert_penghuni($data) {
        return $this->db->insert($this->table, $data);
    }

    // Update penghuni
    public function update_penghuni($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete penghuni
    public function delete_penghuni($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Get active penghuni (yang belum keluar)
    public function get_active_penghuni() {
        $this->db->where('tgl_keluar IS NULL');
        $this->db->order_by('nama', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Get penghuni with kamar info
    public function get_penghuni_with_kamar() {
        $this->db->select('p.*, k.nomor as nomor_kamar, k.harga as harga_kamar, kp.tgl_masuk as tgl_masuk_kamar, kp.status as status_kamar');
        $this->db->from($this->table . ' p');
        $this->db->join('tb_kmr_penghuni kp', 'p.id = kp.id_penghuni', 'left');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id', 'left');
        $this->db->where('kp.status', 'aktif');
        $this->db->or_where('kp.status IS NULL');
        $this->db->order_by('p.nama', 'ASC');
        return $this->db->get()->result();
    }

    // Check if no_ktp already exists
    public function check_no_ktp_exists($no_ktp, $exclude_id = null) {
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $this->db->where('no_ktp', $no_ktp);
        return $this->db->get($this->table)->num_rows() > 0;
    }

    // Get penghuni statistics
    public function get_penghuni_stats() {
        $stats = array();
        
        // Total penghuni
        $stats['total'] = $this->db->count_all($this->table);
        
        // Active penghuni
        $this->db->where('tgl_keluar IS NULL');
        $stats['active'] = $this->db->count_all_results($this->table);
        
        // Inactive penghuni
        $this->db->where('tgl_keluar IS NOT NULL');
        $stats['inactive'] = $this->db->count_all_results($this->table);
        
        return $stats;
    }
} 