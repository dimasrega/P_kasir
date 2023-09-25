<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model');
    }

    public function index($date = '')
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();


        $data['laporan'] = $this->db->like('tanggal', $date)->get('penjualan')->result_array();
        $data['total'] = 0;
        foreach ($data['laporan'] as $report) {
            $data['total'] += $report['total'];
        };

        $data['jmlmenu'] = $this->db->get('barang_master')->num_rows();
        $data['penjualan'] = 0;

        $penjualan = $this->db->select('total')->get('penjualan')->result_array();
        foreach ($penjualan as $report) {
            $data['penjualan'] += $report['total'];
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('Admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role' => $this->input->post('role'),
            ];
            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New role added !</div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access changed!</div>');
    }

    public function hapusrole($id)
    {
        $this->load->model('menu_model');
        $this->menu_model->rolehapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            role berhasil di hapus</div>');
        redirect('admin/role');
    }

    public function role_edit($id = NULL)
    {
        $data = [
            'id' => $id,
            'role' => $this->input->post('role')
        ];
        $this->menu_model->role_edit($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            edit berhasil.</div>');
        redirect('admin/role');
    }


    public function akun()
    {
        $data['title'] = 'Akun';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $data['akun'] = $this->db->get('user')->result_array();


        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'is_unique' => 'Email ini sudah di registrasikan'
            ]
        );
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password Minimal 8 Karakter '
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/akun', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_BCRYPT),
                'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
                'role_id' => 2,
            ];

            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Akun telah terbuat</div>');
            redirect('admin/akun');
        }
    }


    public function akunhapus($id)
    {
        $this->load->model('Admin_model');

        $this->Admin_model->akun_hapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun berhasil di hapus</div>');
        redirect('admin/akun');
    }
}
