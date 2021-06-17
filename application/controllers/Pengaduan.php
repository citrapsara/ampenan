<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

	public function index()
	{
		$data['judul_web'] = "Pengaduan";
		
		$this->load->view('web/header', $data);
		$this->load->view('web/pengaduan', $data);
		$this->load->view('web/footer', $data);

		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d H:i:s');

		$lokasi = 'file';
		$file_size = 1024 * 3; // 3 MB
		$this->upload->initialize(array(
			"upload_path"   => "./$lokasi",
			"allowed_types" => "*",
			"max_size" => "$file_size"
		));

		if (isset($_POST['btnsimpan'])) {
			$nama_pelapor 		 = htmlentities(strip_tags($this->input->post('nama_pelapor')));
			$nik_pelapor = htmlentities(strip_tags($this->input->post('nik_pelapor')));
			$alamat_pelapor = htmlentities(strip_tags($this->input->post('alamat_pelapor')));
			$kontak_pelapor = htmlentities(strip_tags($this->input->post('kontak_pelapor')));
			$isi_pengaduan 	 = htmlentities(strip_tags($this->input->post('isi_pengaduan')));

			if ( ! $this->upload->do_upload('bukti'))
			{
				$simpan = 'n';
				$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
			}
			else
			{
				$gbr = $this->upload->data();
				$filename = "$lokasi/".$gbr['file_name'];
				$bukti = preg_replace('/ /', '_', $filename);
				$simpan = 'y';
			}

			if ($simpan=='y') {
				$data = array(
					'nama_pelapor'		=> $nama_pelapor,
					'nik_pelapor'		=> $nik_pelapor,
					'alamat_pelapor'	=> $alamat_pelapor,
					'kontak_pelapor'	=> $kontak_pelapor,
					'isi_pengaduan'   => $isi_pengaduan,
					'bukti'				=> $bukti,
					'status'				=> 'proses',
					'tgl_pengaduan'   => $tgl
				);

				$this->db->insert('tbl_pengaduan',$data);

				$id_pengaduan = $this->db->insert_id();
				$this->Mcrud->kirim_notif($nama_pelapor,'superadmin',$id_pengaduan,'user_kirim_pengaduan');

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
					redirect("pengaduan");
			 }
			 redirect("pengaduan");
		}
		
		
	}

	public function s() {
		$data['judul_web'] = "Pengaduan Berhasil Disimpan";
		
		$this->load->view('web/header', $data);
		$this->load->view('web/pengaduan_sukses', $data);
		$this->load->view('web/footer', $data);
	}

	public function cek($nik_pelapor='')
	{
		$data['judul_web'] = "Pengaduan";
		if ($nik_pelapor!='') {
			$this->db->order_by('id_pengaduan', 'DESC');
			$data['query'] = $this->db->get_where("tbl_pengaduan", array('nik_pelapor'=>"$nik_pelapor"));
		}
		$data['nik_pelapor'] = $nik_pelapor;
		$this->load->view('web/header', $data);
		$this->load->view('web/cek', $data);
		$this->load->view('web/footer', $data);
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
			// }/
			// if ($level=='user') {
			// 	$this->db->where('user',$id_user);
			// }
			if ($aksi=='proses' or $aksi=='konfirmasi' or $aksi=='selesai') {
				$this->db->where('status',$aksi);
			}
			$this->db->order_by('id_pengaduan', 'DESC');
			$data['query'] = $this->db->get("tbl_pengaduan");

			$cek_notif = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user"));
			foreach ($cek_notif->result() as $key => $value) {
				$b_notif = $value->baca_notif;
				if(!preg_match("/$id_user/i", $b_notif)) {
					$data_notif = array('baca_notif'=>"$id_user, $b_notif");
					$this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user));
				}
			}

			if ($aksi == 'd') {
				$p = "detail";
				$data['judul_web'] 	  = "Detail Pengaduan";
				$data['query'] = $this->db->get_where("tbl_pengaduan", array('id_pengaduan' => "$id"))->row();
				if ($data['query']->id_pengaduan=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$cek_data = $this->db->get_where("tbl_pengaduan", array('id_pengaduan' => "$id"));
				if ($cek_data->num_rows() != 0) {
						if ($cek_data->row()->status!='proses') {
							redirect('404');
						}
						if ($cek_data->row()->bukti != '') {
							unlink($cek_data->row()->bukti);
						}
						$this->db->delete('tbl_notif', array('pengirim'=>$id_user,'id_pengaduan'=>$id));
						$this->db->delete('tbl_pengaduan', array('id_pengaduan' => $id));
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
						redirect("pengaduan/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Pengaduan";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/pengaduan/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

				$lokasi = 'file';
				$file_size = 1024 * 3; // 3 MB
				$this->upload->initialize(array(
					"upload_path"   => "./$lokasi",
					"allowed_types" => "*",
					"max_size" => "$file_size"
				));

				if (isset($_POST['btnkirim'])) {
					$id_pengaduan = htmlentities(strip_tags($this->input->post('id_pengaduan')));
					$data_lama = $this->db->get_where('tbl_pengaduan',array('id_pengaduan'=>$id_pengaduan))->row();
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
						// $this->Mcrud->kirim_notif($data_lama->petugas,$data_lama->user,$id_pengaduan,'petugas_ke_user');
					

					if ($simpan=='y') {
						$this->db->update('tbl_pengaduan',$data, array('id_pengaduan'=>$id_pengaduan));
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
					redirect('pengaduan/v');
				}

	}


	public function ajax()
	{
		if (isset($_POST['btnkirim'])) {
			$id = $this->input->post('id');
			$data = $this->db->get_where('tbl_pengaduan',array('id_pengaduan'=>$id))->row();
			$pesan_petugas = $data->pesan_petugas;
			$status = $data->status;
			echo json_encode(array('pesan_petugas'=>$pesan_petugas,'status'=>$status));
		}else {
			redirect('404');
		}
	}

}
