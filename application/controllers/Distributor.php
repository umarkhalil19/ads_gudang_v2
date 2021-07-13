<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distributor extends CI_Controller
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
        $data['distributor'] = $this->m_vic->get_data('tbl_distributor');
        $this->mylib->aview('v_distributor', $data);
    }

    public function distributor_add()
    {
        $this->mylib->aview('v_distributor_add');
    }

    public function distributor_add_act()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        if ($this->form_validation->run() != true) {
            $this->distributor_add();
        } else {
            $data = [
                'distributor_nama' => $this->input->post('nama'),
                'h_tanggal' => date('Y-m-d'),
                'h_waktu' => date('H:i:s'),
                'h_ip' => _getIpaddress()
            ];
            $this->m_vic->insert_data($data, 'tbl_distributor');
            $this->session->set_flashdata('suces', 'data distributor berhasil ditambah');
            redirect('distributor?notif=suces');
        }
    }

    public function distributor_edit($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data distributor tidak ditemukan');
        } else {
            $data['distributor'] = $this->m_vic->edit_data(['distributor_id' => $id], 'tbl_distributor')->row();
            $this->mylib->aview('v_distributor_edit', $data);
        }
    }

    public function distributor_update()
    {
        $data = [
            'distributor_nama' => $this->input->post('nama'),
            'h_pengguna' => $this->session->userdata('username'),
            'h_tanggal' => date('Y-m-d'),
            'h_waktu' => date('H:i:s'),
            'h_ip' => _getIpaddress()
        ];
        $this->m_vic->update_data(['distributor_id' => $this->input->post('id')], $data, 'tbl_distributor');
        $this->session->set_flashdata('suces', 'Data distributor berhasil diubah');
        redirect('distributor?notif=suces');
    }

    public function distributor_hapus($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('distributor?notif=error');
        } else {
            $this->m_vic->delete_data(['distributor_id' => $id], 'tbl_distributor');
            $this->session->set_flashdata('suces', 'Data berhasil di hapus');
            redirect('distributor?notif=suces');
        }
    }
}
