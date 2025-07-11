<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function index() {
        echo "<h1>Test Database Connection</h1>";
        
        // Test koneksi database
        if ($this->db->simple_query('SELECT 1')) {
            echo "<p style='color: green;'>✅ Database connection successful!</p>";
        } else {
            echo "<p style='color: red;'>❌ Database connection failed!</p>";
            return;
        }
        
        // Test query tabel penghuni
        $query = $this->db->get('tb_penghuni');
        if ($query) {
            echo "<p style='color: green;'>✅ Table tb_penghuni exists and accessible!</p>";
            echo "<h3>Data Penghuni:</h3>";
            echo "<table border='1' style='border-collapse: collapse;'>";
            echo "<tr><th>ID</th><th>Nama</th><th>No KTP</th><th>No HP</th><th>Tgl Masuk</th></tr>";
            
            foreach ($query->result() as $row) {
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->nama . "</td>";
                echo "<td>" . $row->no_ktp . "</td>";
                echo "<td>" . $row->no_hp . "</td>";
                echo "<td>" . $row->tgl_masuk . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color: red;'>❌ Table tb_penghuni not found!</p>";
        }
        
        // Test query tabel kamar
        $query2 = $this->db->get('tb_kamar');
        if ($query2) {
            echo "<h3>Data Kamar:</h3>";
            echo "<table border='1' style='border-collapse: collapse;'>";
            echo "<tr><th>ID</th><th>Nomor</th><th>Harga</th><th>Status</th></tr>";
            
            foreach ($query2->result() as $row) {
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->nomor . "</td>";
                echo "<td>Rp " . number_format($row->harga, 0, ',', '.') . "</td>";
                echo "<td>" . $row->status . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
        echo "<br><p><strong>Database Configuration:</strong></p>";
        echo "<ul>";
        echo "<li>Hostname: " . $this->db->hostname . "</li>";
        echo "<li>Database: " . $this->db->database . "</li>";
        echo "<li>Username: " . $this->db->username . "</li>";
        echo "</ul>";
    }
} 