<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perpustakaan_model extends CI_Model
{
    public function filterDataBuku($id_kategori)
    {
        $this->db->select('*');
        
        $this->db->from('data_buku');
        
        $this->db->join('kategori_buku', 'kategori_buku.id = data_buku.id_kelas', 'left');
        
        $this->db->where('data_buku.id_kelas', $id_kategori);
        $query = $this->db->get();
        return $query->result_array();
        
        
    }

    public function get_data($limit,$start)
    {
        $query = $this->db->get('data_buku' ,$limit, $start);
        return $query;
    }
}