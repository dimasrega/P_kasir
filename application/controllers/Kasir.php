<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Model_barang');
        $this->load->library('form_validation');
    }

    public function simpanbarang()
    {
        $data['title'] = 'Barang Master';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $this->load->model('Model_barang', 'getmenu');

        $data['barang_master'] = $this->getmenu->getmenu();
        $data['kategori'] = $this->db->get('kategori_menu')->result_array();

        $this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');
        $this->form_validation->set_rules('menu_id', 'kategori', 'required');
        $this->form_validation->set_rules('stok', 'stok', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kasir/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_barang' => $this->input->post('nama_barang'),
                'harga' => $this->input->post('harga'),
                "menu_id" => $this->input->post('menu_id'),
                'stok' => $this->input->post('stok')
            ];
            $this->db->insert('barang_master', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <i class="fa-solid fa-check-double" style="color: #ffffff;"></i>Barang baru tertambah!</div>');
            redirect('kasir/simpanbarang');
        }
    }
    public function tempatkasir()
    {
        $data['title'] = 'Kasir';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();
        $data['barang'] = $this->Model_barang->getbarang();

        $this->load->model('Model_barang', 'getmenu');
        $this->load->model('Model_barang', 'getbarang');

        $data['barang_master'] = $this->db->get("barang_master")->result();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kasir/kasir', $data);
            $this->load->view('templates/footer');
        };
    }

    public function delete($id)
    {
        $barang = $this->Model_barang->getbarangwhere($id);
        $stoktambah = $barang[0]['stok'] + $barang[0]['jumlah'];

        $this->db->where('id', $barang[0]['id_barang'])->update('barang_master', [
            'stok' => $stoktambah
        ]);

        $this->db->where('id', $id)->delete('keranjang');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <i class="fa-solid fa-check-double" style="color: #ffffff;"></i>Keranjang Dibuang</div>');
        redirect('kasir/tempatkasir');
    }

    public function keranjang()
    {
        $this->form_validation->set_rules('id_barang', 'id_barang', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');

        if ($this->form_validation->run() == true) {
            $data = array(
                'id_barang' => $this->input->post('id_barang'),
                'jumlah' => $this->input->post('jumlah')
            );

            $get_barang = $this->db->where('id', $this->input->post('id_barang'))->get('barang_master')->result();
            $new_stock = $get_barang[0]->stok - $data['jumlah'];

            if ($new_stock < 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <i class="fa-solid fa-check-double" style="color: #ffffff;"></i>Stok Habis</div>');
                redirect('kasir/tempatkasir');
            } else {
                $check_in_keranjang = $this->Model_barang->getbarangwherebarang($data['id_barang']);

                if ($check_in_keranjang[0] != null) {
                    $this->db->where('id', $check_in_keranjang[0]['id'])->update('keranjang', [
                        'jumlah' => $check_in_keranjang[0]['jumlah'] + $data['jumlah']
                    ]);
                } else {
                    $this->db->insert('keranjang', $data);
                };
                $this->db->where('id', $get_barang[0]->id)->update('barang_master', [
                    'stok' => $new_stock
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <i class="fa-solid fa-check-double" style="color: #ffffff;"></i>Keranjang Ditambahkan</div>');
                redirect('kasir/tempatkasir');
            };
        } else {
            redirect('kasir/tempatkasir');
        }
    }

    public function edit_barang($id)
    {
        $data = [
            'id' => $id,
            "nama_barang" => $this->input->post('nama_barang'),
            "harga" => $this->input->post('harga'),
            "menu_id" => $this->input->post('menu_id'),
            "stok" => $this->input->post('stok'),
        ];

        $this->Model_barang->barang_edit($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            edit berhasil.</div>');
        redirect('kasir/simpanbarang');
    }

    public function kategori()
    {
        $data['title'] = 'Kategori';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $data['kategori'] = $this->db->get('kategori_menu')->result_array();

        $this->form_validation->set_rules('kategori', 'kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kasir/kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('kategori_menu', ['kategori' => $this->input->post('kategori')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Kategori added!</div>');
            redirect('kasir/kategori');
        }
    }

    public function laporan($date = '')
    {
        $data['title'] = 'Laporan Pembelian';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        if ($date == '') {
            $date = date('Y-m');
        };

        $data['date'] = $date;

        $data['laporan'] = $this->db->like('tanggal', $date)->get('penjualan')->result_array();
        $data['total'] = 0;
        foreach ($data['laporan'] as $report) {
            $data['total'] += $report['total'];
        };

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kasir/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function filter()
    {
        redirect('kasir/laporan/' . $this->input->post('bulan'));
    }

    public function kategorihapus($id)
    {
        $this->Model_barang->kategori_hapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            kategori berhasil di hapus</div>');
        redirect('kasir/kategori');
    }

    public function baranghapus($id)
    {
        $this->Model_barang->menu_hapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu berhasil di hapus</div>');
        redirect('kasir/simpanbarang');
    }

    public function kategori_edit($id)
    {
        $data = [
            'id' => $id,
            "kategori" => $this->input->post('kategori')
        ];

        $this->Model_barang->kategori_edit($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            edit berhasil.</div>');
        redirect('kasir/kategori');
    }

    public function checkout()
    {
        $this->form_validation->set_rules('bayar', 'bayar', 'required');

        if ($this->form_validation->run() == true) {
            $total_harga = 0;
            $daftar_pembelian = '';
            $keranjang = $this->Model_barang->getbarang();
            foreach ($keranjang as $item) {
                $total_harga += ($item['harga'] * $item['jumlah']);
                $daftar_pembelian .= $item['nama'] . ':' . $item['jumlah'] . '|';
            };

            if ($this->input->post('bayar') < $total_harga) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Mohon Maaf Pembayaran Kurang</div>');
                redirect('kasir/tempatkasir');
            } else {
                $this->db->insert('penjualan', [
                    'daftar_pembelian' => $daftar_pembelian,
                    'total' => $total_harga,
                    'bayar' => $this->input->post('bayar'),
                    'tanggal' => date('Y-m-d H:i:s')
                ]);

                $this->db->where('id !=', null)->delete('keranjang');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Transaksi Berhasil</div>');
                redirect('kasir/laporan');
            };
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wajib Mengisi Jumlah Pembayaran</div>');
            redirect('kasir/tempatkasir');
        };
    }
    public function laporan_pdf($id)
    {
        $data = [
            'id' => $id,
            "daftar_pembelian" => $this->input->post('daftar_pembelian'),
            "total" => $this->input->post('total'),
            "bayar" => $this->input->post('bayar'),
            "tanggal" => $this->input->post('tanggal'),
        ];



        $this->db->where('id', $id);
        $tes = $this->db->get('penjualan');
        $data['penjualan'] = $tes->result_array();

        $data['user'] = $this->db->get('user')->row_array();


        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-petanikode.pdf";
        $this->pdf->load_view('kasir/laporan_pdf', $data);
    }
}
