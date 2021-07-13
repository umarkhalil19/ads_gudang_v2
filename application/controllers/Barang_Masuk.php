<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('url');
        $this->load->helper('vic_helper');
        $this->load->helper('vic_convert_helper');
        $this->load->helper('my_helper');
        $this->load->library(array('session', 'form_validation'));
        $this->load->model('m_vic');
        // if ($this->session->userdata('level') != 99) {
        //     redirect(base_url());
        // }
    }

    function index()
    {
        // $this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
        $data['barang_masuk'] = $this->db->query("SELECT * FROM tbl_barang_masuk GROUP BY masuk_invoice");
        $this->mylib->aview('v_barang_masuk', $data);
    }

    function barang_masuk_add()
    {
        $data['distributor'] = $this->m_vic->get_data('tbl_distributor');
        $data['barang_masuk_temp'] = $this->m_vic->edit_data(['temp_status' => 1, 'h_pengguna' => $this->session->userdata('username')], 'tbl_temp_barang');
        $this->mylib->aview('v_barang_masuk_add', $data);
    }

    function barang_masuk_temp_add_act()
    {
        $cek_barang = $this->m_vic->edit_data(['temp_kode' => $this->input->post('kode'), 'temp_status' => 1, 'h_pengguna' => $this->session->userdata('username')], 'tbl_temp_barang');
        if ($cek_barang->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Data barang sudah ada di keranjang');
            redirect('Barang_Masuk/barang_masuk_add?notif=error');
        } else {
            $this->form_validation->set_rules('kode', 'Kode Barang', 'required');
            $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'required');
            if ($this->form_validation->run() != true) {
                $this->barang_masuk_add();
            } else {
                $data = [
                    'temp_kode' => $this->input->post('kode'),
                    'temp_jumlah' => $this->input->post('jumlah'),
                    'temp_status' => 1,
                    'h_pengguna' => $this->session->userdata('username'),
                    'h_tanggal' => date('Y-m-d'),
                    'h_waktu' => date('H:i:s'),
                    'h_ip' => _getIpaddress()
                ];
                $this->m_vic->insert_data($data, 'tbl_temp_barang');
                $this->session->set_flashdata('suces', 'Data barang berhasil ditambah');
                redirect('Barang_Masuk/barang_masuk_add?notif=suces');
            }
        }
    }

    function barang_masuk_temp_del($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data barang tidak ditemukan');
            redirect('Barang_Masuk/barang_masuk_add?notif=error');
        } else {
            $this->m_vic->delete_data(['temp_id' => $id, 'temp_status' => 1], 'tbl_temp_barang');
            $this->session->set_flashdata('suces', 'Data barang berhasil dihapus');
            redirect('Barang_Masuk/barang_masuk_add?notif=suces');
        }
    }

    function barang_masuk_add_act()
    {
        $cek_invoice = $this->m_vic->edit_data(['masuk_invoice' => $this->input->post('invoice')], 'tbl_barang_masuk');
        if ($cek_invoice->num_rows() > 0) {
            $this->session->set_flashdata('suces', 'Nomor invoice sudah ada, gunakan nomor yang lain');
            redirect('Barang_Masuk/barang_masuk_add?notif=suces');
        } else {
            $this->form_validation->set_rules('invoice', 'Kode Invoice', 'required');
            $this->form_validation->set_rules('tgl', 'Tanggal Masuk', 'required');
            $this->form_validation->set_rules('kurir', 'Kurir', 'required');
            $this->form_validation->set_rules('distributor', 'Distributor', 'required');
            if ($this->form_validation->run() != true) {
                $this->barang_masuk_add();
            } else {
                $temp_barang = $this->m_vic->edit_data(['temp_status' => 1, 'h_pengguna' => $this->session->userdata('username')], 'tbl_temp_barang');
                foreach ($temp_barang->result() as $tb) {
                    $data = [
                        'masuk_invoice' => $this->input->post('invoice'),
                        'masuk_tgl' => $this->input->post('tgl'),
                        'barang_kode' => $tb->temp_kode,
                        'masuk_jumlah' => $tb->temp_jumlah,
                        'masuk_kurir' => $this->input->post('kurir'),
                        'masuk_distributor' => $this->input->post('distributor'),
                        'h_pengguna' => $this->session->userdata('username'),
                        'h_tanggal' => date('Y-m-d'),
                        'h_waktu' => date('H:i:s'),
                        'h_ip' => _getIpaddress()
                    ];
                    $this->m_vic->insert_data($data, 'tbl_barang_masuk');
                    $jml_brg = $this->db->query("SELECT barang_jumlah FROM tbl_barang WHERE barang_kode = '$tb->temp_kode'")->row();
                    $data_barang = [
                        'barang_jumlah' => ($jml_brg->barang_jumlah + $tb->temp_jumlah)
                    ];
                    $this->m_vic->update_data(['barang_kode' => $tb->temp_kode], $data_barang, 'tbl_barang');
                }
                $this->m_vic->delete_data(['temp_status' => 1, 'h_pengguna' => $this->session->userdata('username')], 'tbl_temp_barang');
                $this->session->set_flashdata('suces', 'Data barang masuk berhasil ditambah');
                redirect('Barang_Masuk/barang_masuk_add?notif=suces');
            }
        }
    }

    function barang_masuk_detail($invoice_kode = '')
    {
        if ($invoice_kode == '') {
            $this->session->set_flashdata('error', 'Data transaksi tidak ditemukan');
            redirect('Barang_Masuk?notif=error');
        } else {
            $data['invoice'] = $this->m_vic->edit_data(['masuk_invoice' => $invoice_kode], 'tbl_barang_masuk')->row();
            $data['masuk'] = $this->m_vic->edit_data(['masuk_invoice' => $invoice_kode], 'tbl_barang_masuk');
            $this->mylib->aview('v_barang_masuk_detail', $data);
        }
    }

    function barang_masuk_delete($invoice_kode = 0)
    {
        if ($invoice_kode == 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('Barang_Masuk?notif=error');
        } else {
            // kembalikan stok barang pada tabel barang
            $brg_masuk = $this->m_vic->edit_data(['masuk_invoice' => $invoice_kode], 'tbl_barang_masuk');
            foreach ($brg_masuk->result() as $b) {
                // ambil data stok dari tabel barang
                $stok = $this->db->query("SELECT barang_jumlah FROM tbl_barang WHERE barang_kode = '$b->barang_kode'")->row();
                $stok_sekarang = $stok->barang_jumlah;
                $total_stok = ($stok_sekarang - $b->masuk_jumlah);
                // update data stok tiap barang pada tabel barang
                $this->m_vic->update_data(['barang_kode' => $b->barang_kode], ['barang_jumlah' => $total_stok], 'tbl_barang');
            }
            //hapus data invoice dari tabel barang masuk
            $this->m_vic->delete_data(['masuk_invoice' => $invoice_kode], 'tbl_barang_masuk');
            $this->session->set_flashdata('suces', 'Data barang masuk berhasil dihapus');
            redirect('Barang_Masuk?notif=suces');
        }
    }

    function invoice_template()
    {
        $this->mylib->aview('v_invoice_template');
    }

    // function get_barang_by_distributor()
    // {
    //     $kode_distributor = $this->input->post('kode_distributor');
    //     // $kode_distributor = 2;
    //     $brg = $this->m_vic->edit_data(['barang_distributor' => $kode_distributor], 'tbl_barang');
    //     if ($brg->num_rows() > 0) {
    //         echo '<div class="form-group">
    //               <label class="form-label" for="kode">Kode Barang</label>
    //               <div class="form-control-wrap">
    //               <select name="kode" class="form-control form-select" data-search="on" autofocus>
    //               <option value="">Pilih Barang</option>';
    //         foreach ($brg->result() as $b) {
    //             echo '<option value="' . $b->barang_kode . '">' . $b->barang_nama . '</option>';
    //         }
    //         echo '</select>';
    //         echo form_error('kode', '<small><span class="text-danger">', '</span></small>') . '
    //         </div></div>';
    //     } else {
    //         echo 'false';
    //     }
    // }

    function get_barang_by_distributor()
    {
        $kode_distributor = $this->input->post('kode_distributor');
        // $kode_distributor = 2;
        $brg = $this->m_vic->edit_data(['barang_distributor' => $kode_distributor], 'tbl_barang');
        if ($brg->num_rows() > 0) {
            foreach ($brg->result() as $b) {
                echo '<option value="' . $b->barang_kode . '">' . $b->barang_nama . '</option>';
            }
        } else {
            echo 'false';
        }
    }
}
