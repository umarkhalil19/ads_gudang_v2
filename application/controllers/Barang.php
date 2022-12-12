<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
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
        $data['barang'] = $this->m_vic->get_data('tbl_barang');
        $this->mylib->aview('v_barang', $data);
    }

    public function barang_add()
    {
        $data['satuan'] = $this->m_vic->get_data('tbl_satuan');
        $data['distributor'] = $this->m_vic->get_data('tbl_distributor');
        $this->mylib->aview('v_barang_add', $data);
    }

    public function barang_add_act()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga Satuan', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'required');
        if ($this->form_validation->run() != true) {
            $this->barang_add();
        } else {
            $data = [
                'barang_kode' => $this->input->post('kode'),
                'barang_nama' => $this->input->post('nama'),
                'barang_distributor' => $this->input->post('distributor'),
                'barang_satuan' => $this->input->post('satuan'),
                'barang_harga_satuan' => $this->input->post('harga'),
                'barang_jumlah' => $this->input->post('jumlah'),
                'h_tanggal' => date('Y-m-d'),
                'h_waktu' => date('H:i:s'),
                'h_ip' => _getIpaddress()
            ];
            $this->m_vic->insert_data($data, 'tbl_barang');
            $this->session->set_flashdata('suces', 'data barang berhasil ditambah');
            redirect('barang?notif=suces');
        }
    }


    public function barang_edit($id = 0)
    {
        if ($id === 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('barang?notif=error');
        } else {
            $data['satuan'] = $this->m_vic->get_data('tbl_satuan');
            $data['barang'] =  $this->m_vic->edit_data(['barang_kode' => $id], 'tbl_barang')->row();
            $data['distributor'] = $this->m_vic->get_data('tbl_distributor');
            $this->mylib->aview('v_barang_edit', $data);
        }
    }

    public function barang_update()
    {
        $data = [
            'barang_kode' => $this->input->post('kode'),
            'barang_nama' => $this->input->post('nama'),
            'barang_distributor' => $this->input->post('distributor'),
            'barang_satuan' => $this->input->post('satuan'),
            'barang_harga_satuan' => $this->input->post('harga'),
            'barang_jumlah' => $this->input->post('jumlah'),
            'h_tanggal' => date('Y-m-d'),
            'h_waktu' => date('H:i:s'),
            'h_ip' => _getIpaddress()
        ];
        $this->m_vic->update_data(['barang_kode' => $this->input->post('kode')], $data, 'tbl_barang');
        $this->session->set_flashdata('suces', 'Data berhasil diubah');
        redirect('barang?notif=suces');
    }

    public function barang_delete($id = 0)
    {
        if ($id === 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('barang?notif=error');
        } else {
            $this->m_vic->delete_data(['barang_kode' => $id], 'tbl_barang');
            $this->session->set_flashdata('suces', 'Data berhasil dihapus');
            redirect('barang?notif=suces');
        }
    }
}
