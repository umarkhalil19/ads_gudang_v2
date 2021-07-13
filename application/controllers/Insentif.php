<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Insentif extends CI_Controller
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
    }

    public function index()
    {
        $data['sales'] = $this->m_vic->get_data('tbl_salless');
        $this->mylib->aview('v_insentif', $data);
    }

    public function tampil_insentif()
    {
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        if ($this->form_validation->run() != true) {
            $this->session->set_flashdata('error', 'Pilih bulan terlebih dahulu');
            redirect('insentif?notif=error');
        } else {
            $sales_id = $this->input->post('sales_id');
            $tanggal = $this->input->post('bulan');
            $tanggal = explode('-', $tanggal);
            $tahun = $tanggal[0];
            $bulan = $tanggal[1];
            $data['invoice'] = $this->db->query("SELECT * FROM tbl_invoice WHERE invoice_salless = '$sales_id' AND invoice_status = 1 AND MONTH(invoice_tgl) = '$bulan' AND YEAR(invoice_tgl) = '$tahun'");
            $data['sales'] = $this->m_vic->edit_data(['salless_id' => $sales_id], 'tbl_salless')->row();
            if ($data['invoice']->num_rows() > 0) {
                $data['sales_id'] = $sales_id;
                $data['tahun'] = $tahun;
                $data['bulan'] = $bulan;
                $this->mylib->aview('v_insentif_detail', $data);
            } else {
                $this->session->set_flashdata('error', 'Data untuk bulan tersebut tidak ditemukan');
                redirect('insentif?notif=error');
            }
        }
    }

    function insentif_cetak()
    {
        $sales_id = $this->input->post('sales_id');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $data['invoice'] = $this->db->query("SELECT * FROM tbl_invoice WHERE invoice_salless = '$sales_id' AND invoice_status = 1 AND MONTH(invoice_tgl) = '$bulan' AND YEAR(invoice_tgl) = '$tahun'");
        $data['sales'] = $this->m_vic->edit_data(['salless_id' => $sales_id], 'tbl_salless')->row();
        if ($data['invoice']->num_rows() > 0) {
            $this->load->view('page/v_insentif_cetak', $data);
        } else {
            $this->session->set_flashdata('error', 'Data untuk bulan tersebut tidak ditemukan');
            redirect('insentif?notif=error');
        }
    }
}
