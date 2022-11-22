<?php
defined('BASEPATH') or exit('No direct script access allowed');
class buku extends CI_Controller
{
 public function __construct()
 {
 parent::__construct();
 //cek_login();
 $this->load->model('ModelUser');
 $this->load->model('ModelBuku');
 }
public function kategori()
 {
 $data['judul'] = 'Kategori Buku';
 $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
 $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
 $this->form_validation->set_rules('kategori', 'Kategori', 
'required', [
 'required' => 'Judul Buku harus diisi'
 ]);
 if ($this->form_validation->run() == false) {
 $this->load->view('templates/header', $data);
 $this->load->view('templates/sidebar', $data);
 $this->load->view('templates/topbar', $data);
 $this->load->view('buku/kategori', $data);
 $this->load->view('templates/footer');
 } else {
 $data = [
'nama_kategori' => $this->input->post('kategori')
 ];
 $this->ModelBuku->simpanKategori($data);
 redirect('buku/kategori');
 }
 }
 public function hapusKategori()
 {
 $where = ['id_kategori' => $this->uri->segment(3)];
 $this->ModelBuku->hapusKategori($where);
 redirect('buku/kategori');
 }
}