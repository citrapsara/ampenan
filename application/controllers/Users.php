<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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

	public function v($aksi='', $id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level == 'user') {
					redirect('404_content');
			}

			$this->db->join('tbl_user','tbl_user.id_user=tbl_data_user.id_user');
			$this->db->order_by('id_data_user', 'DESC');
			$data['query'] = $this->db->get("tbl_data_user");

				if ($aksi == 'd') {
					$p = "detail";
					$data['judul_web'] 	  = "Detail User";
					$this->db->join('tbl_user','tbl_user.id_user=tbl_data_user.id_user');
					$data['query'] = $this->db->get_where("tbl_data_user", array('tbl_user.id_user' => "$id"))->row();
					if ($data['query']->id_user=='') {redirect('404');}
				}
				elseif ($aksi == 'h') {
					if ($level == 'petugas') {
							redirect('404_content');
					}
					$cek_data = $this->db->get_where("tbl_data_user", array('id_user' => "$id"));
					if ($cek_data->num_rows() != 0) {
							$cek_foto = $cek_data->row()->foto;
							if ($cek_foto!='') {
								unlink($cek_foto);
							}
							$this->db->delete('tbl_pengaduan', array('user' => $id));
							$this->db->delete('tbl_data_user', array('id_user' => $id));
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
							redirect("users/v");
					}else {
						redirect('404');
					}
				}else{
					$p = "index";
					$data['judul_web'] 	  = "User";
				}

				if ($aksi=='cetak') {
					$this->load->view("users/user/cetak", $data);
				}else {
					$this->load->view('users/header', $data);
					$this->load->view("users/user/$p", $data);
					$this->load->view('users/footer');
				}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			if ($level=='user') {
				$this->db->join('tbl_data_user','tbl_data_user.id_user=tbl_user.id_user');
			}
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Profile";

					$this->load->view('users/header', $data);
					$this->load->view('users/profile', $data);
					$this->load->view('users/footer');

					$lokasi = 'img/user';
					$file_size = 1024 * 3; // 3 MB
					$this->upload->initialize(array(
						"file_type"     => "image/jpeg",
						"upload_path"   => "./$lokasi",
						"allowed_types" => "jpg|jpeg|png",
						"max_size" => "$file_size"
					));

					if (isset($_POST['btnupdate'])) {
						$username	 		= htmlentities(strip_tags($this->input->post('username')));
						$nama_lengkap	= htmlentities(strip_tags($this->input->post('nama_lengkap')));

						$update = 'yes';
						$pesan = '';
						if ($ceks == $username) {
							$update = 'yes';
						}else{
							$cek_un = $this->Mcrud->get_users_by_un($username)->num_rows();
							if ($cek_un == 0) {
									$update = 'yes';
							}else{
									$update = 'no';
									$pesan  = 'Username "<b>'.$username.'</b>" sudah ada';
							}
						}

						if ($update=='yes' AND $level=='user') {
							$no_ktp	= htmlentities(strip_tags($this->input->post('no_ktp')));
							$alamat	= htmlentities(strip_tags($this->input->post('alamat')));
							$tgl_lahir = date('Y-m-d',strtotime(htmlentities(strip_tags($this->input->post('tgl_lahir')))));
							$jk			= htmlentities(strip_tags($this->input->post('jk')));
							$kontak	= htmlentities(strip_tags($this->input->post('kontak')));
							$email	= htmlentities(strip_tags($this->input->post('email')));

							$cek_foto = $this->db->get_where('tbl_data_user',"id_user='$id_user'")->row()->foto;
							if ($_FILES['foto']['error'] <> 4) {
								if ( ! $this->upload->do_upload('foto'))
								{
										$update = 'no';
										$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
								}
								 else
								{
									if ($cek_foto!='') {
										unlink($cek_foto);
									}
											$gbr = $this->upload->data();
											$filename = "$lokasi/".$gbr['file_name'];
											$foto = preg_replace('/ /', '_', $filename);
											$update = 'yes';
								}
							}else {
								$foto = $cek_foto;
								$update = 'yes';
							}

						}

						if ($update == 'yes') {
									$data = array(
										'username'			=> $username,
										'nama_lengkap'	=> $nama_lengkap
									);
									$this->Mcrud->update_user(array('id_user' => $id_user), $data);

								if ($level=='user') {
									$data2 = array(
										'no_ktp' => $no_ktp,
										'nama'   => $nama_lengkap,
										'alamat' => $alamat,
										'tgl_lahir' => $tgl_lahir,
										'jk' 		 => $jk,
										'kontak' => $kontak,
										'email'	 => $email,
										'foto'	 => $foto,
									);
									$this->db->update('tbl_data_user', $data2, array('id_user' => $id_user));
								}

									$this->session->has_userdata('username');
									$this->session->set_userdata('username', "$username");

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;</span>
											 </button>
											 <strong>Sukses!</strong> Profile berhasil disimpan.
										</div>
	 								 <br>'
									);
									redirect('profile');
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
							redirect('profile');
						}
					}
		}
	}

	public function ubah_pass()
	{
		$ceks = $this->session->userdata('username');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Ubah Password";

					$this->load->view('users/header', $data);
					$this->load->view('users/ubah_pass', $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnupdate2'])) {
						$password0 	= htmlentities(strip_tags($this->input->post('password0')));
						$password 	= htmlentities(strip_tags($this->input->post('password')));
						$password2 	= htmlentities(strip_tags($this->input->post('password2')));

						if ($password0 != $data['user']->row()->password) {
								$this->session->set_flashdata('msg2',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;</span>
										 </button>
										 <strong>Gagal!</strong> Password lama salah.
									</div>
 								 <br>'
								);
								redirect('ubah_pass');
						}

						if ($password != $password2) {
								$this->session->set_flashdata('msg2',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;</span>
										 </button>
										 <strong>Gagal!</strong> Password tidak cocok.
									</div>
 								 <br>'
								);
						} else {
									$data = array(
										'password'	=> $password
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);

									$this->session->set_flashdata('msg2',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;</span>
											 </button>
											 <strong>Sukses!</strong> Password berhasil disimpan.
										</div>
	 								 <br>'
									);
						}
									redirect('ubah_pass');
					}
		}
	}

}
