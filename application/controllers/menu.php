<?php
defined('BASEPATH') or exit('No direct script access allowed');


class menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('menu_model');
    }

    public function index()
    {
        $data['title'] = 'Menu management';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New menu added!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu management';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $this->load->model('menu_model', 'getsubmenu');

        $data['submenu'] = $this->getsubmenu->getsubmenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('menu_id', 'menu', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New sub menu added!</div>');
            redirect('menu/submenu');
        }
    }


    public function menuhapus($id)
    {
        $this->menu_model->submenuhapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            sub menu berhasil di hapus</div>');
        redirect('menu/submenu');
    }
    public function hapusmenumanagement($id)
    {
        $this->load->model('menu_model');
        $this->menu_model->managmenthapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            sub menu berhasil di hapus</div>');
        redirect('menu');
    }

    public function menu_edit($id)
    {
        $data = [
            'id' => $id,
            "title" => $this->input->post('title'),
            "menu_id" => $this->input->post('menu_id'),
            "url" => $this->input->post('url'),
            "icon" => $this->input->post('icon'),
            "is_active" => $this->input->post('is_active')
        ];

        $this->menu_model->menu_edit($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            edit berhasil.</div>');
        redirect('menu/submenu');
    }


    public function management_edit($id)
    {
        $data = [
            'id' => $id,
            'menu' => $this->input->post('menu')
        ];
        $this->menu_model->management_edit($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            edit berhasil.</div>');
        redirect('menu');
    }
}
