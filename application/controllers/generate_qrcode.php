<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Generate QRCODE";
        $data['barang_master'] = $this->db->get('barang_master')->result(); // ambil data dari tabel siswa
        $this->load->view('generate_qrcode', $data); // passing data ke view
    }
}
