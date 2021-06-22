<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function index()
	{
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$data['users']  	 = $this->Mcrud->get_users();
			$data['judul_web'] = "Dashboard";

			$this->load->view('users/header', $data);
			$this->load->view('users/dashboard', $data);
			$this->load->view('users/footer');
		}
	}

	public function v($aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}

			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			// if ($level=='petugas') {
			// 	$this->db->where('petugas',$id_user);
			// }
			if ($level=='obh') {
				$this->db->where('notaris',$id_user);
			}
			if ($aksi=='proses' or $aksi=='konfirmasi' or $aksi=='selesai') {
				$this->db->where('status',$aksi);
			}
			$this->db->order_by('id_laporan', 'DESC');
			$data['query'] = $this->db->get("tbl_laporan");

			$cek_notif = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user"));
			foreach ($cek_notif->result() as $key => $value) {
				$b_notif = $value->baca_notif;
				if(!preg_match("/$id_user/i", $b_notif)) {
					$data_notif = array('baca_notif'=>"$id_user, $b_notif");
					$this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user));
				}
			}

			if ($aksi == 't') {
				if ($level!='obh') {
					redirect('404');
				}
				$p = "tambah";
				$data['judul_web'] 	  = "BUAT LAPORAN";
			}elseif ($aksi == 'd') {
				$p = "detail";
				$data['judul_web'] 	  = "RINCIAN LAPORAN";
				$data['query'] = $this->db->get_where("tbl_laporan", array('id_laporan' => "$id"))->row();
				if ($data['query']->id_laporan=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$cek_data = $this->db->get_where("tbl_laporan", array('id_laporan' => "$id"));
				if ($cek_data->num_rows() != 0) {
						if ($cek_data->row()->status!='proses') {
							redirect('404');
						}
						if ($cek_data->row()->lampiran != '') {
							unlink($cek_data->row()->lampiran);
						}
						$this->db->delete('tbl_notif', array('pengirim'=>$id_user,'id_laporan'=>$id));
						$this->db->delete('tbl_laporan', array('id_laporan' => $id));
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil dihapus.
							</div>
							<br>'
						);
						redirect("laporan/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Laporan OBH";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/laporan/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

				$lokasi = 'file/laporan';
				$file_size = 1024 * 3; // 3 MB
				$this->upload->initialize(array(
					"upload_path"   => "./$lokasi",
					"allowed_types" => "*",
					"max_size" => "$file_size"
				));

				if (isset($_POST['btnsimpan'])) {
					$id_kategori_lap 		 = htmlentities(strip_tags($this->input->post('id_kategori_lap')));
					$id_sub_kategori_lap = htmlentities(strip_tags($this->input->post('id_sub_kategori_lap')));
					$isi_laporan 	 = htmlentities(strip_tags($this->input->post('isi_laporan')));
					$ket_laporan 	 = htmlentities(strip_tags($this->input->post('ket_laporan')));
					$no_permohonan 	 = htmlentities(strip_tags($this->input->post('no_permohonan')));
					$jenis_perkara 	 = htmlentities(strip_tags($this->input->post('jenis_perkara')));
					$alamat_client 	 = htmlentities(strip_tags($this->input->post('alamat_client')));
					$nama_client 	 = htmlentities(strip_tags($this->input->post('nama_client')));
					$nik_client 	 = htmlentities(strip_tags($this->input->post('nik_client')));
					$tgl_kegiatan 	 = htmlentities(strip_tags($this->input->post('tgl_kegiatan')));

					if ( ! $this->upload->do_upload('lampiran'))
					{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
					}
					 else
					{
								$gbr = $this->upload->data();
								$filename = "$lokasi/".$gbr['file_name'];
								$lampiran = preg_replace('/ /', '_', $filename);
								$simpan = 'y';
					}

					if ($simpan=='y') {
									$data = array(
										'id_kategori_lap' 		=> $id_kategori_lap,
										'id_sub_kategori_lap' => $id_sub_kategori_lap,
										'isi_laporan'   => $isi_laporan,
										'ket_laporan'   => $ket_laporan,
										'lampiran'						=> $lampiran,
										'notaris'						=> $id_user,
										'no_permohonan'   => $no_permohonan,
										'jenis_perkara'   => $jenis_perkara,
										'nama_client'   => $nama_client,
										'nik_client'   => $nik_client,
										'alamat_client'   => $alamat_client,
										'tgl_kegiatan'   => $tgl_kegiatan,
										'status'					=> 'proses',
										'tgl_laporan'   => $tgl
									);
									$this->db->insert('tbl_laporan',$data);

									$id_laporan = $this->db->insert_id();
									$this->Mcrud->kirim_notif($id_user,'superadmin',$id_laporan,'notaris_kirim_laporan');

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
					 }else {
							 $this->session->set_flashdata('msg',
	 							'
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
	 						);
							redirect("laporan/v/$aksi/".hashids_decrypt($id));
					 }
					 redirect("laporan/v");
				}


				if (isset($_POST['btnkirim'])) {
					$id_laporan = htmlentities(strip_tags($this->input->post('id_laporan')));
					$data_lama = $this->db->get_where('tbl_laporan',array('id_laporan'=>$id_laporan))->row();
					$simpan = 'y';
					$pesan = '';
					
						$pesan_petugas = htmlentities(strip_tags($this->input->post('pesan_petugas')));
						$status = htmlentities(strip_tags($this->input->post('status')));
						$file = $data_lama->file_petugas;
						$pesan = 'Berhasil disimpan';
						if ($_FILES['file']['error'] <> 4) {
							if ( ! $this->upload->do_upload('file'))
							{
									$simpan = 'n';
									$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
							}
							 else
							{
								if ($file!='') {
									unlink("$file");
								}
										$gbr = $this->upload->data();
										$filename = "$lokasi/".$gbr['file_name'];
										$file = preg_replace('/ /', '_', $filename);
							}
						}

						$data = array(
							'pesan_petugas' => $pesan_petugas,
							'status'				=> $status,
							'file_petugas'  => $file,
							'tgl_selesai'   => $tgl
						);
						// $this->Mcrud->kirim_notif($data_lama->petugas,$data_lama->notaris,$id_laporan,'petugas_ke_notaris');
					

					if ($simpan=='y') {
						$this->db->update('tbl_laporan',$data, array('id_laporan'=>$id_laporan));
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> '.$pesan.'.
							</div>
						 <br>'
						);
					}else {
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Gagal!</strong> '.$pesan.'.
							</div>
						 <br>'
						);
					}
					redirect('laporan/v');
				}

	}


	public function ajax()
	{
		if (isset($_POST['btnkirim'])) {
			$id = $this->input->post('id');
			$data = $this->db->get_where('tbl_laporan',array('id_laporan'=>$id))->row();
			$pesan_petugas = $data->pesan_petugas;
			$status = $data->status;
			echo json_encode(array('pesan_petugas'=>$pesan_petugas,'status'=>$status));
		}else {
			redirect('404');
		}
	}

}
