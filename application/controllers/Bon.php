<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bon extends CI_Controller
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

    public function index()
    {
        // $data['invoice'] = $this->m_vic->get_data('tbl_invoice');
        $data['invoice'] = $this->db->select('tbl_invoice.*,tbl_toko.toko_nama,tbl_toko.toko_alamat,tbl_salless.salless_nama')->from('tbl_invoice')->join('tbl_toko','tbl_toko.toko_id=tbl_invoice.invoice_toko', 'LEFT')->join('tbl_salless','tbl_salless.salless_id=tbl_invoice.invoice_salless')->where(['invoice_tgl >='=>'2022-08-01','invoice_tgl <='=>'2022-12-31'])->order_by('invoice_tgl','ASC')->get();
        // $data['invoice'] = $this->db->select('tbl_invoice.*,tbl_toko.toko_nama,tbl_toko.toko_alamat,tbl_salless.salless_nama')->from('tbl_invoice')->join('tbl_toko','tbl_toko.toko_id=tbl_invoice.invoice_toko', 'LEFT')->join('tbl_salless','tbl_salless.salless_id=tbl_invoice.invoice_salless')->get();
        $this->mylib->aview('v_bon', $data);
    }

    public function bon_detail($id = 0)
    {
        if ($id === 0) {
            $this->session->set_flashdata('error', 'Detail data tidak ditemukan');
            redirect('bon?notif=error');
        } else {
            $data['bon'] = $this->db->query("SELECT * FROM tbl_bon_kredit WHERE kode_invoice='$id' AND bon_dibayar!=0");
            // $data['bon'] = $this->m_vic->edit_data(['kode_invoice' => $id], 'tbl_bon_kredit');
            $data['invoice'] = $this->m_vic->edit_data(['invoice_kode' => $id], 'tbl_invoice')->row();
            $this->mylib->aview('v_bon_detail', $data);
        }
    }

    public function bon_proses()
    {
        $id = $this->input->post('id');
        $urut = (int)($this->input->post('no_urut'));
        $total = $this->input->post('total');
        $invoice =  $this->input->post('invoice');
        $bayar =  $this->input->post('bayar');
        $tgl = $this->input->post('tgl');
        $this->form_validation->set_rules('bayar', 'Dibayar', 'required');
        $this->form_validation->set_rules('tgl', 'Tanggal Bayar', 'required');
        if ($this->form_validation->run() != true) {
            $this->bon_detail($invoice);
        } elseif ($bayar > $total) {
            $this->session->set_flashdata('error', 'Nilai yang anda masukkan lebih besar dari pada nilai total');
            redirect('bon/bon_detail/' . $invoice . '/?notif=error');
        } elseif ($bayar == $total) {
            $data = [
                'kode_invoice' => $invoice,
                'bon_urut' => $urut + 1,
                'bon_total' => $total - $bayar,
                'bon_dibayar' => $bayar,
                'bon_tgl' => $tgl,
                'h_pengguna' => $this->session->userdata('username'),
                'h_tanggal' => date('Y-m-d'),
                'h_waktu' => date('H:i:s'),
                'h_ip' => _getIpaddress()
            ];
            $this->m_vic->insert_data($data, 'tbl_bon_kredit');
            // $this->m_vic->update_data(['bon_id' => $id], ['bon_dibayar' => $bayar], 'tbl_bon_kredit');
            $this->m_vic->update_data(['invoice_kode' => $invoice], ['invoice_status' => 1], 'tbl_invoice');
            $this->session->set_flashdata('suces', 'Proses pembayar berhasil dilakukan');
            redirect('bon/bon_detail/' . $invoice . '/?notif=suces');
        } elseif ($bayar < $total) {
            //$this->m_vic->update_data(['bon_id' => $id], ['bon_dibayar' => $bayar], 'tbl_bon_kredit');
            $data = [
                'kode_invoice' => $invoice,
                'bon_urut' => $urut + 1,
                'bon_total' => $total - $bayar,
                'bon_dibayar' => $bayar,
                'bon_tgl' => $tgl,
                'h_pengguna' => $this->session->userdata('username'),
                'h_tanggal' => date('Y-m-d'),
                'h_waktu' => date('H:i:s'),
                'h_ip' => _getIpaddress()
            ];
            $this->m_vic->insert_data($data, 'tbl_bon_kredit');
            $this->session->set_flashdata('suces', 'Proses pembayar berhasil dilakukan');
            redirect('bon/bon_detail/' . $invoice . '/?notif=suces');
        }
    }

    public function bon_cetak($id = 0)
    {
        if ($id === 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('Bon?notif=error');
        } else {
            $data['id'] = $id;
            $data['barang'] = $this->m_vic->edit_data(['keluar_invoice' => $id], 'tbl_barang_keluar');
            $data['invoice'] = $this->m_vic->edit_data(['invoice_kode' => $id], 'tbl_invoice')->row();
            $this->load->view('page/v_invoice_template', $data);
        }
    }
}
