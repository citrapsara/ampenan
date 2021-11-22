<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revisi_dipa extends CI_Controller {
	public function index()
	{
		redirect('revisi_dipa/v');
	}

	public function v($aksi='',$id='')
	{
		$id_dipa = $this->session->userdata('id_dipa');
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');

		if(!isset($ceks)) {
			redirect('web/login');
		}

		if ($id_dipa=='00') {
			$data['dipa_list'] = $this->Guzzle_model->getDipaList();
		} else {
			$data['revisi_dipa'] = $this->Guzzle_model->getRevisiDipaByDipaId($id_dipa);
		}

		if ($aksi == 't') {
			if ($level!='perencana' AND $level!='pelaksana') {redirect('404');}
			$p = "tambah";
			$data['judul_web'] 	  = "Input Usulan Revisi DIPA";
		} elseif ($aksi == 'd') {
			$p = "detail";
			$data['judul_web'] 	  = "Detail Usulan Revisi DIPA";
			$data['revisi_dipa'] = $this->Guzzle_model->getRevisiDipaById($id);
			$data['verifikasi_usulan'] = $this->Guzzle_model->getVerifikasiByUsulanRevisiId($id);
		} elseif ($aksi == 'e') {
			if ($level!='perencana' AND $level!='pelaksana') {redirect('404');}
			$p = "edit";
			$data['judul_web'] 	  = "Edit Usulan Revisi DIPA";
			$data['revisi_dipa'] = $this->Guzzle_model->getRevisiDipaById($id);
			if ($data['revisi_dipa']['id']=='') {redirect('404');}
		} elseif ($aksi == 'h') {
			if ($level!='perencana' AND $level!='pelaksana') {redirect('404');}
			$this->Guzzle_model->deleteRevisiDipa($id);
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
			redirect("revisi_dipa/v");
		}else{
			$p = "index";
			$data['judul_web'] 	  = "USULAN REVISI DIPA";
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/revisi_dipa/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		$lokasi = 'file/revisi_dipa';
		$file_size = 1024 * 3; // 3 MB
		$this->upload->initialize(array(
			"upload_path"   => "./$lokasi",
			"allowed_types" => "*",
			"max_size" => "$file_size"
		));

		if (isset($_POST['btnsimpan'])) {
			$jenis_revisi 		 = htmlentities(strip_tags($this->input->post('jenis_revisi')));
			$keterangan 		 = htmlentities(strip_tags($this->input->post('keterangan')));
			$id_dipa  = htmlentities(strip_tags($this->input->post('id_dipa')));
			$id_verifikator  = htmlentities(strip_tags($this->input->post('id_verifikator')));

			if ( ! $this->upload->do_upload('url_file'))
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
					'id_dipa'						=> $id_dipa,
					'keterangan' 					=> $keterangan,
					'jenis_revisi'					=> $jenis_revisi,
					'id_user_verifikator_terakhir'	=> $id_verifikator,
					'url_file'						=> $file
				);
				$this->Guzzle_model->createRevisiDipa($data);
				
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
			  redirect("revisi_dipa/v/$aksi");
			}
			redirect("revisi_dipa/v/");
		}

		if (isset($_POST['btnupdate'])) {
			$jenis_revisi = htmlentities(strip_tags($this->input->post('jenis_revisi')));
			$keterangan = htmlentities(strip_tags($this->input->post('keterangan')));
			$id_verifikator = htmlentities(strip_tags($this->input->post('id_verifikator')));
			$id_dipa = htmlentities(strip_tags($this->input->post('id_dipa')));
			$cek_file = $data['revisi_dipa']['url_file'];
			if ($_FILES['url_file']['error'] <> 4) {
				if ( ! $this->upload->do_upload('url_file'))
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
					'url_file'						=> $file,
					'id_dipa'						=> $id_dipa,
					'keterangan' 					=> $keterangan,
					'jenis_revisi'					=> $jenis_revisi,
					'id_user_verifikator_terakhir'	=> $id_verifikator
				);
				$this->Guzzle_model->updateRevisiDipa($id, $data);
				
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
				redirect("revisi_dipa/v/");
				
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
					redirect("revisi_dipa/v/$aksi/".hashids_encrypt($id));
			 }

		}
			
	}

}