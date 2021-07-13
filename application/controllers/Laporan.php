<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('url');
        $this->load->helper('vic_helper');
        $this->load->helper('vic_convert_helper');
        $this->load->library(array('session', 'form_validation'));
        $this->load->model('m_vic');
        // if ($this->session->userdata('level') != 99) {
        //     redirect(base_url());
        // }
    }

    function index()
    {
        $this->mylib->aview('v_laporan');
    }

    function barang_masuk()
    {
        //$this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
        $dari_tgl = _tgl($this->input->post('dari_tgl'));
        $hingga_tgl =  _tgl($this->input->post('hingga_tgl'));
        $data['barang_masuk'] = $this->db->query("SELECT * FROM tbl_barang_masuk WHERE masuk_tgl between '$dari_tgl' and '$hingga_tgl' GROUP BY masuk_invoice");
        $data['dari_tgl'] = $this->input->post('dari_tgl');
        $data['hingga_tgl'] = $this->input->post('hingga_tgl');
        $this->mylib->aview('v_lap_barang_masuk', $data);
    }

    function barang_keluar()
    {
        $dari_tgl = _tgl($this->input->post('dari_tgl'));
        $hingga_tgl =  _tgl($this->input->post('hingga_tgl'));
        $data['barang_keluar'] = $this->db->query("SELECT * FROM tbl_invoice WHERE invoice_tgl between '$dari_tgl' and '$hingga_tgl'");
        $data['dari_tgl'] = $this->input->post('dari_tgl');
        $data['hingga_tgl'] = $this->input->post('hingga_tgl');
        $this->mylib->aview('v_lap_barang_keluar', $data);
    }

    function barang_masuk_cetak()
    {
        $dari_tgl = _tgl($this->input->post('dari_tgl'));
        $hingga_tgl =  _tgl($this->input->post('hingga_tgl'));
        $data['barang_masuk'] = $this->db->query("SELECT * FROM tbl_barang_masuk WHERE masuk_tgl between '$dari_tgl' and '$hingga_tgl' GROUP BY masuk_invoice");
        $data['dari_tgl'] = $this->input->post('dari_tgl');
        $data['hingga_tgl'] = $this->input->post('hingga_tgl');
        $this->load->view('page/v_lap_barang_masuk_cetak', $data);
    }

    function barang_keluar_cetak()
    {
        $dari_tgl = _tgl($this->input->post('dari_tgl'));
        $hingga_tgl =  _tgl($this->input->post('hingga_tgl'));
        $data['barang_keluar'] = $this->db->query("SELECT * FROM tbl_invoice WHERE invoice_tgl between '$dari_tgl' and '$hingga_tgl'");
        $data['dari_tgl'] = $this->input->post('dari_tgl');
        $data['hingga_tgl'] = $this->input->post('hingga_tgl');
        $this->load->view('page/v_lap_barang_keluar_cetak', $data);
    }
    
}
