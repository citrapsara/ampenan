<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarObh extends CI_Controller {

   public function index()
	{
		$data['judul_web'] = "Daftar OBH";

		$this->db->join('tbl_user','tbl_user.id_user=tbl_data_obh.id_user');
		$this->db->order_by('id_data_notaris', 'DESC');
		$data['query'] = $this->db->get("tbl_data_obh");

		$this->load->view('web/header', $data);
		$this->load->view('web/daftar_obh', $data);
		$this->load->view('web/footer', $data);
	}
}