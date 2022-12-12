<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_keluar extends CI_Controller
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
        $data['barang_keluar'] = $this->m_vic->get_data('tbl_invoice');
        $this->mylib->aview('v_barang_keluar', $data);
    }

    function barang_keluar_add()
    {
        $data['distributor'] = $this->m_vic->get_data('tbl_distributor');
        $data['barang_keluar_temp'] = $this->m_vic->edit_data(['temp_status' => 2, 'h_pengguna' => $this->session->userdata('username')], 'tbl_temp_barang');
        $data['sales'] = $this->m_vic->get_data('tbl_salless');
        $data['toko'] = $this->m_vic->get_data('tbl_toko');
        $data['barang'] = $this->db->query("SELECT barang_kode,barang_nama FROM tbl_barang");
        $this->mylib->aview('v_barang_keluar_add', $data);
    }

    function barang_keluar_temp_add_act()
    {
        $kode_b = $this->input->post('kode');
        $jumlah_b = $this->input->post('jumlah');
        $cek_barang = $this->m_vic->edit_data(['temp_kode' => $this->input->post('kode'), 'temp_status' => 2, 'h_pengguna' => $this->session->userdata('username')], 'tbl_temp_barang');
        $stok_barang = $this->db->query("SELECT barang_jumlah FROM tbl_barang WHERE barang_kode='$kode_b'")->row();
        if ($cek_barang->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Data barang sudah ada di keranjang');
            redirect('Barang_Keluar/barang_keluar_add?notif=error');
        } elseif ($jumlah_b > $stok_barang->barang_jumlah) {
            $this->session->set_flashdata('error', 'Stok Barang Tidak Cukup');
            redirect('Barang_Keluar/barang_keluar_add?notif=error');
        } else {
            $this->form_validation->set_rules('kode', 'Kode Barang', 'required');
            $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'required');
            if ($this->form_validation->run() != true) {
                $this->barang_keluar_add();
            } else {
                $data = [
                    'temp_kode' => $this->input->post('kode'),
                    'temp_jumlah' => $this->input->post('jumlah'),
                    'temp_diskon' => $this->input->post('diskon'),
                    'temp_status' => 2,
                    'h_pengguna' => $this->session->userdata('username'),
                    'h_tanggal' => date('Y-m-d'),
                    'h_waktu' => date('H:i:s'),
                    'h_ip' => _getIpaddress()
                ];
                $this->m_vic->insert_data($data, 'tbl_temp_barang');
                $this->session->set_flashdata('suces', 'Data barang berhasil ditambah');
                redirect('Barang_Keluar/barang_keluar_add?notif=suces');
            }
        }
    }

    function barang_keluar_add_act()
    {
        // $this->form_validation->set_rules('invoice', 'Kode Invoice', 'required');
        $this->form_validation->set_rules('tgl', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('sales', 'Sales', 'required');
        $this->form_validation->set_rules('toko', 'Toko', 'required');
        if ($this->form_validation->run() != true) {
            $this->barang_keluar_add();
        } else {
            $invoice_kode='SM' . date('Ymd') . date('His');
            $temp_barang = $this->m_vic->edit_data(['temp_status' => 2, 'h_pengguna' => $this->session->userdata('username')], 'tbl_temp_barang');
            foreach ($temp_barang->result() as $tb) {
                $brg = $this->db->query("SELECT barang_harga_satuan FROM tbl_barang WHERE barang_kode='$tb->temp_kode'")->row();
                $data = [
                    'keluar_invoice' => $invoice_kode,
                    'barang_kode' => $tb->temp_kode,
                    'keluar_jumlah' => $tb->temp_jumlah,
                    'keluar_diskon' => $tb->temp_diskon,
                    'keluar_harga' => ($tb->temp_jumlah * $brg->barang_harga_satuan) - $tb->temp_diskon,
                    'keluar_tgl' => $this->input->post('tgl'),
                    'h_pengguna' => $this->session->userdata('username'),
                    'h_tanggal' => date('Y-m-d'),
                    'h_waktu' => date('H:i:s'),
                    'h_ip' => _getIpaddress()
                ];
                $this->m_vic->insert_data($data, 'tbl_barang_keluar');
                $jml_brg = $this->db->query("SELECT barang_jumlah FROM tbl_barang WHERE barang_kode = '$tb->temp_kode'")->row();
                $data_barang = [
                    'barang_jumlah' => ($jml_brg->barang_jumlah - $tb->temp_jumlah)
                ];
                $this->m_vic->update_data(['barang_kode' => $tb->temp_kode], $data_barang, 'tbl_barang');
            }
            $this->m_vic->delete_data(['temp_status' => 2, 'h_pengguna' => $this->session->userdata('username')], 'tbl_temp_barang');
            $data_2 = [
                'invoice_kode' => $invoice_kode,
                'invoice_salless' => $this->input->post('sales'),
                'invoice_toko' => $this->input->post('toko'),
                'invoice_total_harga' => $this->input->post('total_harga'),
                'invoice_tgl' => $this->input->post('tgl'),
                'invoice_status' => 0,
                'h_pengguna' => $this->session->userdata('username'),
                'h_tanggal' => date('Y-m-d'),
                'h_waktu' => date('H:i:s'),
                'h_ip' => _getIpaddress()
            ];
            $this->m_vic->insert_data($data_2, 'tbl_invoice');
            $data_3 = [
                'kode_invoice' => $invoice_kode,
                'bon_urut' => 1,
                'bon_total' => $this->input->post('total_harga'),
                'bon_dibayar' => 0,
                'bon_tgl' => date('Y-m-d'),
                'h_pengguna' => $this->session->userdata('username'),
                'h_tanggal' => date('Y-m-d'),
                'h_waktu' => date('H:i:s'),
                'h_ip' => _getIpaddress()
            ];
            $this->m_vic->insert_data($data_3, 'tbl_bon_kredit');
            $this->session->set_flashdata('suces', 'Data barang berhasil ditambah');
            redirect('Barang_Keluar/barang_keluar_add?notif=suces');
        }
    }

    function barang_keluar_temp_del($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data barang tidak ditemukan');
            redirect('Barang_Keluar/barang_keluar_add?notif=error');
        } else {
            $this->m_vic->delete_data(['temp_id' => $id], 'tbl_temp_barang');
            $this->session->set_flashdata('suces', 'Data barang berhasil dihapus');
            redirect('Barang_Keluar/barang_keluar_add?notif=suces');
        }
    }

    public function barang_keluar_detail($id = 0)
    {
        if ($id === 0) {
            $this->session->set_flashdata('error', 'Data transaksi tidak ditemukan');
            redirect('Barang_Keluar?notif=error');
        } else {
            $data['invoice'] = $this->m_vic->edit_data(['invoice_kode' => $id], 'tbl_invoice')->row();
            $data['keluar'] = $this->m_vic->edit_data(['keluar_invoice' => $id], 'tbl_barang_keluar');
            $this->mylib->aview('v_barang_keluar_detail', $data);
        }
    }

    function barang_keluar_delete($invoice_kode = 0)
    {
        if ($invoice_kode === 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('Barang_Keluar?notif=error');
        } else {
            // kembalikan stok barang pada tabel barang
            $brg_keluar = $this->m_vic->edit_data(['keluar_invoice' => $invoice_kode], 'tbl_barang_keluar');
            foreach ($brg_keluar->result() as $b) {
                // ambil data stok dari tabel barang
                $stok = $this->db->query("SELECT barang_jumlah FROM tbl_barang WHERE barang_kode = '$b->barang_kode'")->row();
                $stok_sekarang = $stok->barang_jumlah;
                $total_stok = ($stok_sekarang + $b->keluar_jumlah);
                // update data stok tiap barang pada tabel barang
                $this->m_vic->update_data(['barang_kode' => $b->barang_kode], ['barang_jumlah' => $total_stok], 'tbl_barang');
            } 
            //hapus data invoice dari tabel barang masuk
            $this->m_vic->delete_data(['keluar_invoice' => $invoice_kode], 'tbl_barang_keluar');
            $this->m_vic->delete_data(['invoice_kode' => $invoice_kode], 'tbl_invoice');
            $this->session->set_flashdata('suces', 'Data barang keluar berhasil dihapus');
            redirect('Barang_Keluar?notif=suces');
        }
    }

    public function get_stok()
    {
        $kode_brg = $this->input->post('kode_brg');
        $brg = $this->m_vic->edit_data(['barang_kode' => $kode_brg], 'tbl_barang')->row();
        echo "<b><small>Stok barang di gudang <b>" . $brg->barang_jumlah . "</small></b>";
    }

    function get_barang_by_distributor()
    {
        $kode_distributor = $this->input->post('kode_distributor');
        // $kode_distributor = 2; 
        $brg = $this->m_vic->edit_data(['barang_distributor' => $kode_distributor], 'tbl_barang');
        if ($brg->num_rows() > 0) {
            echo '<option value="default_option">Pilih Barang</option>';
            foreach ($brg->result() as $b) {
                echo '<option value="' . $b->barang_kode . '">' . $b->barang_nama . '</option>';
            }
        } else {
            echo 'false';
        }
    }
    
    public function get_barang()
    {
        $keluar_id = $this->input->post('keluar_id');
        $data = $this->db->query("SELECT keluar_jumlah FROM tbl_barang_keluar WHERE keluar_id='$keluar_id'")->row();
        echo $data->keluar_jumlah;
    }

    public function retur_barang()
    {
        $keluar_id = $this->input->post('id_keluar');
        $jumlah_retur = $this->input->post('jumlah_barang');
        $barang_keluar = $this->db->query("SELECT keluar_invoice,barang_kode,keluar_harga,keluar_jumlah FROM tbl_barang_keluar WHERE keluar_id='$keluar_id'")->row();
        if ($jumlah_retur > $barang_keluar->keluar_jumlah) {
            $this->session->set_flashdata('error', 'Jumlah Barang Retur Melebihi Pesanan');
            redirect('Barang_Keluar/barang_keluar_detail/' . $barang_keluar->keluar_invoice . '?notif=error');
        } elseif ($jumlah_retur == $barang_keluar->keluar_jumlah) {
            $invoice = $this->db->query("SELECT invoice_total_harga FROM tbl_invoice WHERE invoice_kode='$barang_keluar->keluar_invoice'")->row();
            $total_baru = $invoice->invoice_total_harga - $barang_keluar->keluar_harga;
            $b_kredit = $this->db->query("SELECT bon_id, bon_total FROM tbl_bon_kredit WHERE kode_invoice='$barang_keluar->keluar_invoice'");
            $barang = $this->db->query("SELECT barang_jumlah FROM tbl_barang WHERE barang_kode='$barang_keluar->barang_kode'")->row();
            $stok_baru = $barang->barang_jumlah + $jumlah_retur;
            foreach ($b_kredit->result() as $bk) {
                $bk_baru = $bk->bon_total - $barang_keluar->keluar_harga;
                $this->m_vic->update_data(['bon_id' => $bk->bon_id], ['bon_total' => $bk_baru], 'tbl_bon_kredit');
            }
            $this->m_vic->update_data(['invoice_kode' => $barang_keluar->keluar_invoice], ['invoice_total_harga' => $total_baru], 'tbl_invoice');
            $this->m_vic->update_data(['barang_kode' => $barang_keluar->barang_kode], ['barang_jumlah' => $stok_baru], 'tbl_barang');
            $this->m_vic->delete_data(['keluar_id' => $keluar_id], 'tbl_barang_keluar');
            $this->session->set_flashdata('suces', 'Barang Berhasil Diretur');
            redirect('Barang_Keluar/barang_keluar_detail/' . $barang_keluar->keluar_invoice . '?notif=suces');
        } elseif ($jumlah_retur <= 0) {
            $this->session->set_flashdata('error', 'Jumlah Barang Retur Minimal 1');
            redirect('Barang_Keluar/barang_keluar_detail/' . $barang_keluar->keluar_invoice . '?notif=error');
        } else {
            $harga_satuan = $barang_keluar->keluar_harga / $barang_keluar->keluar_jumlah;
            $harga_retur = $harga_satuan * $jumlah_retur;
            $harga_baru = $barang_keluar->keluar_harga - $harga_retur;
            $jumlah_baru = $barang_keluar->keluar_jumlah - $jumlah_retur;
            $barang = $this->db->query("SELECT barang_jumlah FROM tbl_barang WHERE barang_kode='$barang_keluar->barang_kode'")->row();
            $stok_baru = $barang->barang_jumlah + $jumlah_retur;

            $invoice = $this->db->query("SELECT invoice_total_harga FROM tbl_invoice WHERE invoice_kode='$barang_keluar->keluar_invoice'")->row();
            $total_baru = $invoice->invoice_total_harga - $harga_baru;
            $b_kredit = $this->db->query("SELECT bon_id, bon_total FROM tbl_bon_kredit WHERE kode_invoice='$barang_keluar->keluar_invoice'");
            foreach ($b_kredit->result() as $bk) {
                $bk_baru = $bk->bon_total - $harga_baru;
                $this->m_vic->update_data(['bon_id' => $bk->bon_id], ['bon_total' => $bk_baru], 'tbl_bon_kredit');
            }
            $this->m_vic->update_data(['invoice_kode' => $barang_keluar->keluar_invoice], ['invoice_total_harga' => $total_baru], 'tbl_invoice');
            $this->m_vic->update_data(['keluar_id' => $keluar_id], ['keluar_harga' => $harga_baru, 'keluar_jumlah' => $jumlah_baru], 'tbl_barang_keluar');
            $this->m_vic->update_data(['barang_kode' => $barang_keluar->barang_kode], ['barang_jumlah' => $stok_baru], 'tbl_barang');
            $this->session->set_flashdata('suces', 'Barang Berhasil Diretur');
            redirect('Barang_Keluar/barang_keluar_detail/' . $barang_keluar->keluar_invoice . '?notif=suces');
        }
    }

}
