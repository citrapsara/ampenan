<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_anggaran extends CI_Controller {

	public function index()
	{
		redirect('realisasi_anggaran/v');
	}

	public function v($aksi='', $id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level == 'obh') {
					redirect('404_content');
			}

			$this->db->order_by('id_anggaran', 'DESC');
			$data['query'] = $this->db->get("tbl_realisasi_anggaran")->row();

				// if ($aksi == 't') {
				// 	$p = "tambah";
				// 	$data['judul_web'] 	  = "+ Kategori";
				// }else
				if ($aksi == 'e') {
					$p = "edit";
					$data['judul_web'] 	  = "Edit Anggaran";
					$data['query'] = $this->db->get_where("tbl_realisasi_anggaran", array('id_anggaran' => "$id"))->row();
					if ($data['query']->id_anggaran=='') {redirect('404');}
				}
				// elseif ($aksi == 'h') {
				// 	$cek_data = $this->db->get_where("tbl_kategori", array('id_kategori' => "$id"));
				// 	if ($cek_data->num_rows() != 0) {
				// 			$this->db->delete('tbl_kategori', array('id_kategori' => $id));
				// 			$this->session->set_flashdata('msg',
				// 				'
				// 				<div class="alert alert-success alert-dismissible" role="alert">
				// 					 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				// 						 <span aria-hidden="true">&times;</span>
				// 					 </button>
				// 					 <strong>Sukses!</strong> Berhasil dihapus.
				// 				</div>
				// 				<br>'
				// 			);
				// 			redirect("kategori/v");
				// 	}
				// 	else {
				// 		redirect('404');
				// 	}
				// }
				else{
					$p = "index";
					$data['judul_web'] 	  = "Realisasi Anggaran";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/realisasi_anggaran/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d H:i:s');

					// if (isset($_POST['btnsimpan'])) {
					// 	$nama_kategori = htmlentities(strip_tags($this->input->post('nama_kategori')));

					// 					$data = array(
					// 						'nama_kategori' => $nama_kategori
					// 					);
					// 					$this->db->insert('tbl_kategori',$data);

					// 					$this->session->set_flashdata('msg',
					// 						'
					// 						<div class="alert alert-success alert-dismissible" role="alert">
					// 							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 								 <span aria-hidden="true">&times;</span>
					// 							 </button>
					// 							 <strong>Sukses!</strong> Berhasil disimpan.
					// 						</div>
		 			// 					 <br>'
					// 					);

					// 	 redirect("kategori/v");
					// }


					if (isset($_POST['btnupdate'])) {
						$total_anggaran = htmlentities(strip_tags($this->input->post('total_anggaran')));
						$penyerapan_anggaran = htmlentities(strip_tags($this->input->post('penyerapan_anggaran')));

										$data = array(
											'total_anggaran' => $total_anggaran,
											'penyerapan_anggaran' => $penyerapan_anggaran
										);
										$this->db->update('tbl_realisasi_anggaran',$data, array('id_anggaran' => $id));

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Sukses!</strong> Berhasil disimpan.
											</div>
		 								 <br>'
										);

						 redirect("realisasi_anggaran/v");
					}
		}
	}


	// public function sub($aksi='', $id='')
	// {
	// 	$id = hashids_decrypt($id);
	// 	$ceks 	 = $this->session->userdata('username');
	// 	$id_user = $this->session->userdata('id_user');
	// 	$level 	 = $this->session->userdata('level');
	// 	if(!isset($ceks)) {
	// 		redirect('web/login');
	// 	}else{
	// 		$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

	// 		if ($level != 'superadmin') {
	// 				redirect('404_content');
	// 		}

	// 		$this->db->order_by('nama_kategori', 'ASC');
	// 		$data['v_kat'] = $this->db->get("tbl_kategori");

	// 		$this->db->join('tbl_kategori','tbl_kategori.id_kategori=tbl_sub_kategori.id_kategori');
	// 		$this->db->order_by('id_sub_kategori', 'DESC');
	// 		$data['query'] = $this->db->get("tbl_sub_kategori");

	// 			if ($aksi == 't') {
	// 				$p = "tambah";
	// 				$data['judul_web'] 	  = "+ Sub Kategori";
	// 			}elseif ($aksi == 'e') {
	// 				$p = "edit";
	// 				$data['judul_web'] 	  = "Edit Sub Kategori";
	// 				$data['query'] = $this->db->get_where("tbl_sub_kategori", array('id_sub_kategori' => "$id"))->row();
	// 				if ($data['query']->id_sub_kategori=='') {redirect('404');}
	// 			}
	// 			elseif ($aksi == 'h') {
	// 				$cek_data = $this->db->get_where("tbl_sub_kategori", array('id_sub_kategori' => "$id"));
	// 				if ($cek_data->num_rows() != 0) {
	// 						$this->db->delete('tbl_sub_kategori', array('id_sub_kategori' => $id));
	// 						$this->session->set_flashdata('msg',
	// 							'
	// 							<div class="alert alert-success alert-dismissible" role="alert">
	// 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	// 									 <span aria-hidden="true">&times;</span>
	// 								 </button>
	// 								 <strong>Sukses!</strong> Berhasil dihapus.
	// 							</div>
	// 							<br>'
	// 						);
	// 						redirect("kategori/sub");
	// 				}else {
	// 					redirect('404');
	// 				}
	// 			}else{
	// 				$p = "index";
	// 				$data['judul_web'] 	  = "Sub Kategori";
	// 			}

	// 				$this->load->view('users/header', $data);
	// 				$this->load->view("users/kategori/sub/$p", $data);
	// 				$this->load->view('users/footer');

	// 				date_default_timezone_set('Asia/Jakarta');
	// 				$tgl = date('Y-m-d H:i:s');

	// 				if (isset($_POST['btnsimpan'])) {
	// 					$id_kategori 			 = htmlentities(strip_tags($this->input->post('id_kategori')));
	// 					$nama_sub_kategori = htmlentities(strip_tags($this->input->post('nama_sub_kategori')));

	// 									$data = array(
	// 										'id_kategori' 			=> $id_kategori,
	// 										'nama_sub_kategori' => $nama_sub_kategori
	// 									);
	// 									$this->db->insert('tbl_sub_kategori',$data);

	// 									$this->session->set_flashdata('msg',
	// 										'
	// 										<div class="alert alert-success alert-dismissible" role="alert">
	// 											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	// 												 <span aria-hidden="true">&times;</span>
	// 											 </button>
	// 											 <strong>Sukses!</strong> Berhasil disimpan.
	// 										</div>
	// 									 <br>'
	// 									);

	// 					 redirect("kategori/sub");
	// 				}


	// 				if (isset($_POST['btnupdate'])) {
	// 					$id_kategori 			 = htmlentities(strip_tags($this->input->post('id_kategori')));
	// 					$nama_sub_kategori = htmlentities(strip_tags($this->input->post('nama_sub_kategori')));

	// 									$data = array(
	// 										'id_kategori' 			=> $id_kategori,
	// 										'nama_sub_kategori' => $nama_sub_kategori
	// 									);
	// 									$this->db->update('tbl_sub_kategori',$data, array('id_sub_kategori' => $id));

	// 									$this->session->set_flashdata('msg',
	// 										'
	// 										<div class="alert alert-success alert-dismissible" role="alert">
	// 											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	// 												 <span aria-hidden="true">&times;</span>
	// 											 </button>
	// 											 <strong>Sukses!</strong> Berhasil disimpan.
	// 										</div>
	// 									 <br>'
	// 									);

	// 					 redirect("kategori/sub");
	// 				}
	// 	}
	// }

}
