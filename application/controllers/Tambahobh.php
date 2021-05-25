<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TambahObh extends CI_Controller {

	public function index()
	{
		redirect('tambahobh/v');
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

			if ($level == 'obh' OR $level == 'user') {
					redirect('404_content');
			}

			$this->db->join('tbl_user','tbl_user.id_user=tbl_data_obh.id_user');
			$this->db->order_by('id_data_notaris', 'DESC');
			$data['query'] = $this->db->get("tbl_data_obh");
			// $data['kota'] = $this->db->get("tbl_kota_ntb");

				if ($aksi == 't') {
					$p = "tambah";
					$data['judul_web'] 	  = "Registrasi OBH";
				}elseif ($aksi == 'e') {
					$p = "edit";
					$data['judul_web'] 	  = "Edit Data OBH";
					$this->db->join('tbl_user','tbl_user.id_user=tbl_data_obh.id_user');
					$data['query'] = $this->db->get_where("tbl_data_obh", array('tbl_user.id_user' => "$id"))->row();
					if ($data['query']->id_user=='') {redirect('404');}
				}
				elseif ($aksi == 'h') {
					$cek_data = $this->db->get_where("tbl_data_obh", array('id_user' => "$id"));
					if ($cek_data->num_rows() != 0) {
							$this->db->delete('tbl_data_obh', array('id_user' => $id));
							$this->db->delete('tbl_user', array('id_user' => $id));
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
							redirect("tambahobh/v");
					}else {
						redirect('404');
					}
				}else{
					$p = "index";
					$data['judul_web'] 	  = "OBH";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/tambahobh/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$no_idn 	 = htmlentities(strip_tags($this->input->post('no_idn')));
						$nama 	 = htmlentities(strip_tags($this->input->post('nama')));
						$nama_singkat 	 = htmlentities(strip_tags($this->input->post('nama_singkat')));
						$no_sk 	 = htmlentities(strip_tags($this->input->post('no_sk')));
						$kota  = htmlentities(strip_tags($this->input->post('kota')));
						$alamat_notaris  = htmlentities(strip_tags($this->input->post('alamat_notaris')));
						$latitude  = htmlentities(strip_tags($this->input->post('latitude')));
						$longitude  = htmlentities(strip_tags($this->input->post('longitude')));
						$telpon = htmlentities(strip_tags($this->input->post('telpon')));
						$email_notaris 	 = htmlentities(strip_tags($this->input->post('email_notaris')));
						$username = htmlentities(strip_tags($this->input->post('username')));
						$password  = htmlentities(strip_tags($this->input->post('password')));
						$password2 = htmlentities(strip_tags($this->input->post('password2')));

						$cek_data = $this->db->get_where('tbl_user', array('username'=>$username));
						$simpan = 'y';
						$pesan  = '';
						if ($cek_data->num_rows()!=0) {
							$simpan = 'n';
							$pesan  = "Username '<b>$username</b>' sudah ada";
						}else {
							if ($password!=$password2) {
								$simpan = 'n';
								$pesan  = "Password tidak cocok!";
							}
						}

						if ($simpan=='y') {
										$data = array(
											'nama_lengkap' => $nama,
											'username' 		 => $username,
											'password' 		 => $password,
											'level' 			 => "obh",
											'tgl_daftar' 	 => $tgl,
											'aktif'				 => '1',
											'dihapus' 		 => 'tidak'
										);
										$this->db->insert('tbl_user',$data);

										$data2 = array(
											'no_idn' => $no_idn,
											'nama' => $nama,
											'nama_singkat' => $nama_singkat,
											'no_sk' => $no_sk,
											'kota' => $kota,
											'alamat_notaris' => $alamat_notaris,
											'latitude' => $latitude,
											'longitude' => $longitude,
											'telpon' => $telpon,
											'email_notaris' => $email_notaris,
											'id_user' => $this->db->insert_id()
										);
										$this->db->insert('tbl_data_obh',$data2);

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
							 redirect("tambahobh/v/t");
						}
						 redirect("tambahobh/v");
					}


					if (isset($_POST['btnupdate'])) {
						$no_idn 	 = htmlentities(strip_tags($this->input->post('no_idn')));						
						$nama 	 = htmlentities(strip_tags($this->input->post('nama')));
						$nama_singkat 	 = htmlentities(strip_tags($this->input->post('nama_singkat')));
						$no_sk 	 = htmlentities(strip_tags($this->input->post('no_sk')));
						$kota  = htmlentities(strip_tags($this->input->post('kota')));
						$alamat_notaris  = htmlentities(strip_tags($this->input->post('alamat_notaris')));
						$latitude  = htmlentities(strip_tags($this->input->post('latitude')));
						$longitude  = htmlentities(strip_tags($this->input->post('longitude')));
						$telpon = htmlentities(strip_tags($this->input->post('telpon')));
						$email_notaris 	 = htmlentities(strip_tags($this->input->post('email_notaris')));
						$username = htmlentities(strip_tags($this->input->post('username')));
						$password  = htmlentities(strip_tags($this->input->post('password')));
						$password2 = htmlentities(strip_tags($this->input->post('password2')));
						$data_lama = $this->db->get_where('tbl_user', array('id_user'=>$id))->row();
						$cek_data  = $this->db->get_where('tbl_user', array('username'=>$username,'username!='=>$data_lama->username));
						$simpan = 'y';
						$pesan  = '';
						if ($cek_data->num_rows()!=0) {
							$simpan = 'n';
							$pesan  = "Username '<b>$username</b>' sudah ada";
						}else {
							$pass_lama = $data_lama->password;
							if ($password=='') {
								$password = $pass_lama;
							}else {
								if ($password!=$password2) {
									$simpan = 'n';
									$pesan  = "Password tidak cocok!";
								}
							}
						}

						if ($simpan=='y') {
										$data = array(
											'nama_lengkap' => $nama,
											'username' 		 => $username,
											'password' 		 => $password
										);
										$this->db->update('tbl_user',$data, array('id_user'=>$id));

										$data2 = array(
											'nama' => $nama,
											'nama_singkat' => $nama_singkat,
											'no_sk' => $no_sk,
											'no_idn' => $no_idn,
											'kota' => $kota,
											'alamat_notaris' => $alamat_notaris,
											'latitude' => $latitude,
											'longitude' => $longitude,
											'telpon' => $telpon,
											'email_notaris' => $email_notaris,
										);
										$this->db->update('tbl_data_obh',$data2, array('id_user'=>$id));

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
										 redirect("tambahobh/v/e/".hashids_encrypt($id));
					 	 }
						 redirect("tambahobh/v");
					}
		}
	}

}
