<?php
defined('BASEPATH') or exit('No direct script access allowed');

class menu_model extends CI_Model
{
    public function getsubmenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`. `menu`
            FROM `user_sub_menu` JOIN `user_menu`
            ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
            ";
        return $this->db->query($query)->result_array();
    }

    //hapus

    public function submenuhapus($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }


    public function rolehapus($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }
    public function managmenthapus($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }


    //end hapus

    //edit

    public function menu_edit($data)
    {

        $this->db->where('id', $data['id']);
        $this->db->update('user_sub_menu', $data);
    }


    public function management_edit($data)
    {

        $this->db->where('id', $data['id']);
        $this->db->update('user_menu', $data);
    }
}
