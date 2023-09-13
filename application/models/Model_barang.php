<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_barang extends CI_Model
{
    public function barang_edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('barang_master', $data);
    }


    public function getmenu()
    {
        $query = "SELECT `barang_master`.*, `kategori_menu`. `kategori`
            FROM `barang_master` JOIN `kategori_menu`
            ON `barang_master`.`menu_id` = `kategori_menu`.`id`
            ";
        return $this->db->query($query)->result_array();

        // $this->db->select("*");
        // $this->db->from("barang_master as bm");
        // $this->db->join("kategori_menu as km", 'km.id = bm.menu_id');
        // $query = $this->db->get();
    }

    public function getbarang()
    {
        $query = "SELECT k.id as id, b.nama_barang as nama, b.harga as harga, k.jumlah as jumlah FROM keranjang as k JOIN barang_master as b ON b.id = k.id_barang";
        return $this->db->query($query)->result_array();
    }

    public function getbarangwhere($id)
    {
        $query = "SELECT k.id as id, b.id as id_barang, b.nama_barang as nama, b.stok as stok, b.harga as harga, k.jumlah as jumlah FROM keranjang as k JOIN barang_master as b ON b.id = k.id_barang WHERE k.id=$id";
        return $this->db->query($query)->result_array();
    }

    public function menu_hapus($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('barang_master');
    }

    public function kategori_hapus($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('kategori_menu');
    }

    public function kategori_edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('kategori_menu', $data);
    }
}
