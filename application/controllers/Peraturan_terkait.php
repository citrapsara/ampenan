<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peraturan_terkait extends CI_Controller {

   public function index()
	{
		$data['judul_web'] = "Daftar OBH";

		// $this->db->join('tbl_user','tbl_user.id_user=tbl_data_obh.id_user');
		// $this->db->order_by('id_data_notaris', 'DESC');
		// $data['obh'] = $this->db->get("tbl_data_obh");
		// $this->db->order_by('nama_kota','DESC');
		// $data['query'] = $this->db->get("tbl_file_manager");
		$data['query'] = $this->db->get_where("tbl_file_manager", array('page' => "Peraturan Terkait"));

		// foreach ($data['kota']->result() as $key => $kota) {
		// 	foreach ($data['obh']->result() as $key => $obh) {
		// 		if($obh->kota == $kota->nama_kota) {
		// 			$kota->obh[] = $obh;
		// 		}
		// 	}
		// }

		$this->load->view('web/header', $data);
		$this->load->view('web/peraturan_terkait', $data);
		$this->load->view('web/footer', $data);
	}

	public function d($id='')
	{
		$id = hashids_decrypt($id);
		$this->db->join('tbl_user','tbl_user.id_user=tbl_data_obh.id_user');
		$data['query'] = $this->db->get_where("tbl_data_obh", array('tbl_user.id_user' => "$id"))->row();
		if ($data['query']->id_user=='') {redirect('404');}

		$this->load->view('web/header', $data);
		$this->load->view('web/detail_obh', $data);
		$this->load->view('web/footer', $data);
	}

	public function coba() {
		$this->db->join('tbl_user','tbl_user.id_user=tbl_data_obh.id_user');
		$this->db->order_by('id_data_notaris', 'DESC');
		$data['obh'] = $this->db->get("tbl_data_obh");
		$this->db->order_by('nama_kota','ASC');
		$data['kota'] = $this->db->get("tbl_kota_ntb");

		foreach ($data['kota']->result() as $key => $kota) {
			foreach ($data['obh']->result() as $key => $obh) {
				if($obh->kota == $kota->nama_kota) {
					$kota->obh[] = $obh;

				}
			}
		}

		

		echo '<pre>'; print_r($data);
	}

}