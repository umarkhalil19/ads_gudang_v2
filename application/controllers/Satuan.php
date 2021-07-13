<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
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
        $data['satuan'] = $this->m_vic->get_data('tbl_satuan');
        $this->mylib->aview('v_satuan', $data);
    }

    public function satuan_add()
    {
        $this->mylib->aview('v_satuan_add');
    }

    public function satuan_add_act()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->form_validation->run() != true) {
            $this->satuan_add();
        } else {
            $data = [
                'satuan_nama' => $this->input->post('nama'),
                'h_pengguna' => $this->session->userdata('username'),
                'h_tanggal' => date('Y-m-d'),
                'h_waktu' => date('H:i:s'),
                'h_ip' => _getIpaddress()
            ];
            $this->m_vic->insert_data($data, 'tbl_satuan');
            $this->session->set_flashdata('suces', 'data satuan berhasil ditambah');
            redirect('satuan?notif=suces');
        }
    }

    public function satuan_edit($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('satuan?notif=error');
        } else {
            $data['satuan'] = $this->m_vic->edit_data(['satuan_id' => $id], 'tbl_satuan')->row();
            $this->mylib->aview('v_satuan_edit', $data);
        }
    }

    public function satuan_update()
    {
        $data = [
            'satuan_nama' => $this->input->post('nama'),
            'h_pengguna' => $this->session->userdata('username'),
            'h_tanggal' => date('Y-m-d'),
            'h_waktu' => date('H:i:s'),
            'h_ip' => _getIpaddress()
        ];
        $this->m_vic->update_data(['satuan_id' => $this->input->post('id')], $data, 'tbl_satuan');
        $this->session->set_flashdata('suces', 'Data berhasil diubah');
        redirect('satuan?notif=error');
    }

    public function satuan_delete($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('satuan?notif=error');
        } else {
            $this->m_vic->delete_data(['satuan_id' => $id], 'tbl_satuan');
            $this->session->set_flashdata('suces', 'Data berhasil dihapus');
            redirect('satuan?notif=suces');
        }
    }
}
