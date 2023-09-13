<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function role_edit($data)
    {

        $this->db->where('id', $data['id']);
        $this->db->update('user_role', $data);
    }
    public function akun_hapus($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}
