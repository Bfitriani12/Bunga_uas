<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KamarBarang_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'tb_kamar_barang';
    }

    // Ambil semua barang untuk kamar tertentu
    public function get_barang_by_kamar($id_kamar) {
        $this->db->select('b.*');
        $this->db->from($this->table . ' kb');
        $this->db->join('tb_barang b', 'kb.id_barang = b.id');
        $this->db->where('kb.id_kamar', $id_kamar);
        return $this->db->get()->result();
    }

    // Set barang untuk kamar (replace all)
    public function set_barang_for_kamar($id_kamar, $barang_ids) {
        $this->db->where('id_kamar', $id_kamar);
        $this->db->delete($this->table);
        if (!empty($barang_ids)) {
            $data = array();
            foreach ($barang_ids as $id_barang) {
                $data[] = array('id_kamar' => $id_kamar, 'id_barang' => $id_barang);
            }
            $this->db->insert_batch($this->table, $data);
        }
    }
} 