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
        $data['invoice'] = $this->m_vic->get_data('tbl_invoice');
        $this->mylib->aview('v_bon', $data);
    }

    public function bon_detail($id = 0)
    {
        if ($id === 0) {
            $this->session->set_flashdata('error', 'Detail data tidak ditemukan');
            redirect('bon?notif=error');
        } else {
            $data['bon'] = $this->m_vic->edit_data(['kode_invoice' => $id], 'tbl_bon_kredit');
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
        $this->form_validation->set_rules('bayar', 'Dibayar', 'required');
        if ($this->form_validation->run() != true) {
            $this->bon_detail($invoice);
        } elseif ($bayar > $total) {
            $this->session->set_flashdata('error', 'Nilai yang anda masukkan lebih besar dari pada nilai total');
            redirect('bon/bon_detail/' . $invoice . '/?notif=error');
        } elseif ($bayar == $total) {
            $this->m_vic->update_data(['bon_id' => $id], ['bon_dibayar' => $bayar], 'tbl_bon_kredit');
            $this->m_vic->update_data(['invoice_kode' => $invoice], ['invoice_status' => 1], 'tbl_invoice');
            $this->session->set_flashdata('suces', 'Proses pembayar berhasil dilakukan');
            redirect('bon/bon_detail/' . $invoice . '/?notif=suces');
        } elseif ($bayar < $total) {
            $this->m_vic->update_data(['bon_id' => $id], ['bon_dibayar' => $bayar], 'tbl_bon_kredit');
            $data = [
                'kode_invoice' => $invoice,
                'bon_urut' => $urut + 1,
                'bon_total' => $total - $bayar,
                'bon_dibayar' => 0,
                'bon_tgl' => date('Y-m-d'),
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
            $data['barang'] = $this->m_vic->edit_data(['keluar_invoice' => $id], 'tbl_barang_keluar');
            $data['invoice'] = $this->m_vic->edit_data(['invoice_kode' => $id], 'tbl_invoice')->row();
            $this->load->view('page/v_invoice_template', $data);
        }
    }
}
