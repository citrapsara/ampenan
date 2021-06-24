<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_manager extends CI_Controller {

	public function index()
	{
		redirect('file_manager/v');
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

			if ($level!='superadmin') {
				redirect('404');
			}

			$this->db->order_by('id_file', 'DESC');
			$data['query'] = $this->db->get("tbl_file_manager");

			if ($aksi == 't') {
				$p = "tambah";
				$data['judul_web'] 	  = "+ File Manager";
			}elseif ($aksi == 'e') {
				$p = "edit";
				$data['judul_web'] 	  = "Edit File Info";
				$data['query'] = $this->db->get_where("tbl_file_manager", array('id_file' => "$id"))->row();
				if ($data['query']->id_file=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$cek_data = $this->db->get_where("tbl_file_manager", array('id_file' => "$id"));
				if ($cek_data->num_rows() != 0) {
						if ($cek_data->row()->dir_file != '') {
							unlink($cek_data->row()->dir_file);
						}
						$this->db->delete('tbl_file_manager', array('id_file' => $id));
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
						redirect("file_manager/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "File Manager";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/file_manager/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

				$lokasi = 'file/public';
				$file_size = 1024 * 3; // 3 MB
				$this->upload->initialize(array(
					"upload_path"   => "./$lokasi",
					"allowed_types" => "jpg|jpeg|png|pdf|doc|docx",
					"max_size" => "$file_size"
				));

				if (isset($_POST['btnsimpan'])) {
					$name_file = htmlentities(strip_tags($this->input->post('name_file')));
					$page = htmlentities(strip_tags($this->input->post('page')));
					if ( ! $this->upload->do_upload('file'))
					{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
					}
					 else
					{
								$gbr = $this->upload->data();
								$filename = "$lokasi/".$gbr['file_name'];
								$file = preg_replace('/ /', '_', $filename);
								$simpan = 'y';
					}

					if ($simpan=='y') {
									$data = array(
										'name_file'	=> $name_file,
										'dir_file'	=> $file,
										'tgl_file'  => $tgl,
										'page'		=> $page
									);
									$this->db->insert('tbl_file_manager',$data);

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
					 }
					 redirect("file_manager/v");
				}

				if (isset($_POST['btnupdate'])) {
					$name_file = htmlentities(strip_tags($this->input->post('name_file')));
					$page = htmlentities(strip_tags($this->input->post('page')));
					$cek_file = $this->db->get_where('tbl_file_manager',"id_file='$id'")->row()->dir_file;
					if ($_FILES['file']['error'] <> 4) {
						if ( ! $this->upload->do_upload('file'))
						{
								$simpan = 'n';
								$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						 else
						{
							if ($cek_file!='') {
								unlink($cek_file);
							}
									$gbr = $this->upload->data();
									$filename = "$lokasi/".$gbr['file_name'];
									$file = preg_replace('/ /', '_', $filename);
									$simpan = 'y';
						}
					}else {
						$file = $cek_file;
						$simpan = 'y';
					}

					if ($simpan=='y') {
									$data = array(
										'name_file' => $name_file,
										'dir_file'	=> $file,
										'page'		=> $page
									);
									$this->db->update('tbl_file_manager',$data, array('id_file' => $id));

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
									redirect("file_manager/v");
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
							redirect("file_manager/v/e/".hashids_encrypt($id));
					 }

				}

	}


}