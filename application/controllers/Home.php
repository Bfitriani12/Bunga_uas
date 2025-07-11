<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Penghuni_model');
    }

    public function index() {
        $data['title'] = 'Dashboard - Sistem Kos';
        $data['stats'] = $this->Penghuni_model->get_penghuni_stats();
        
        // Get recent penghuni
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(5);
        $data['recent_penghuni'] = $this->db->get('tb_penghuni')->result();
        
        $this->load->view('home/dashboard', $data);
    }
} 