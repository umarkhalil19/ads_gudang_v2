<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
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
        $data['sales'] = $this->m_vic->get_data('tbl_salless');
        $this->mylib->aview('v_sales', $data);
    }

    public function sales_add()
    {
        $this->mylib->aview('v_sales_add');
    }

    public function sales_add_act()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No. Hp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        if ($this->form_validation->run() != true) {
            $this->sales_add();
        } else {
            $data = [
                'salless_nama' => $this->input->post('nama'),
                'salless_alamat' => $this->input->post('alamat'),
                'salles_no_hp' => $this->input->post('no_hp'),
                'h_pengguna' => $this->session->userdata('username'),
                'h_tanggal' => date('Y-m-d'),
                'h_waktu' => date('H:i:s'),
                'h_ip' => _getIpaddress()
            ];
            $this->m_vic->insert_data($data, 'tbl_salless');
            $this->session->set_flashdata('suces', 'data sales berhasil ditambah');
            redirect('sales?notif=suces');
        }
    }

    public function sales_edit($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data sales tidak ditemukan');
        } else {
            $data['sales'] = $this->m_vic->edit_data(['salless_id' => $id], 'tbl_salless')->row();
            $this->mylib->aview('v_sales_edit', $data);
        }
    }

    public function sales_update()
    {
        $data = [
            'salless_nama' => $this->input->post('nama'),
            'salless_alamat' => $this->input->post('alamat'),
            'salles_no_hp' => $this->input->post('no_hp'),
            'h_pengguna' => $this->session->userdata('username'),
            'h_tanggal' => date('Y-m-d'),
            'h_waktu' => date('H:i:s'),
            'h_ip' => _getIpaddress()
        ];
        $this->m_vic->update_data(['salless_id' => $this->input->post('id')], $data, 'tbl_salless');
        $this->session->set_flashdata('suces', 'Data sales berhasil diubah');
        redirect('sales?notif=suces');
    }

    public function sales_hapus($id = 0)
    {
        if ($id == 0) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('sales?notif=error');
        } else {
            $this->m_vic->delete_data(['salless_id' => $id], 'tbl_salless');
            $this->session->set_flashdata('suces', 'Data berhasil di hapus');
            redirect('sales?notif=suces');
        }
    }
}
