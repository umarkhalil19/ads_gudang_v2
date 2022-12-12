<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
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
        $data['toko'] = $this->m_vic->get_data('tbl_toko');
        $this->mylib->aview('v_toko', $data);
    }

    public function toko_add()
    {
        $this->mylib->aview('v_toko_add');
    }

    public function toko_add_act()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No. Hp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        if ($this->form_validation->run() != true) {
            $this->toko_add();
        } else {
            $data = [
                'toko_nama' => $this->input->post('nama'),
                'toko_alamat' => $this->input->post('alamat'),
                'toko_no_hp' => $this->input->post('no_hp'),
                'h_pengguna' => $this->session->userdata('username'),
                'h_tanggal' => date('Y-m-d'),
                'h_waktu' => date('H:i:s'),
                'h_ip' => _getIpaddress()
            ];
            $this->m_vic->insert_data($data, 'tbl_toko');
            $this->session->set_flashdata('suces', 'data toko berhasil ditambah');
            redirect('toko?notif=suces');
        }
    }

    public function toko_edit($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('toko?notif=error');
        } else {
            $data['toko'] = $this->m_vic->edit_data(['toko_id' => $id], 'tbl_toko')->row();
            $this->mylib->aview('v_toko_edit', $data);
        }
    }

    public function toko_update()
    {
        $data = [
            'toko_nama' => $this->input->post('nama'),
            'toko_alamat' => $this->input->post('alamat'),
            'toko_no_hp' => $this->input->post('no_hp'),
            'h_pengguna' => $this->session->userdata('username'),
            'h_tanggal' => date('Y-m-d'),
            'h_waktu' => date('H:i:s'),
            'h_ip' => _getIpaddress()
        ];
        $this->m_vic->update_data(['toko_id' => $this->input->post('id')], $data, 'tbl_toko');
        $this->session->set_flashdata('suces', 'Data berhasil dirubah');
        redirect('toko?notif=suces');
    }

    public function toko_delete($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('toko?notif=error');
        } else {
            $this->m_vic->delete_data(['toko_id' => $id], 'tbl_toko');
            $this->session->set_flashdata('suces', 'Data berhasil dihapus');
            redirect('toko?notif=suces');
        }
    }
}
