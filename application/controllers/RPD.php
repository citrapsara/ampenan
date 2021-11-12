<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpd extends CI_Controller {
	public function index()
	{
		$id_dipa_user = $this->session->userdata('id_dipa');
		redirect("rpd/v/".$id_dipa_user);
	}

	public function v($id_dipa='',$aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		$id_dipa_user = $this->session->userdata('id_dipa');
		if(!isset($ceks)) {
			redirect('web/login');
		}

		$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

		// if ($level!='superadmin') {
		// 	redirect('404');
		// }
		$data['dipa_list'] = $this->Guzzle_model->getDipaList();
		$arraydipa_id_nama = [];
		foreach($data['dipa_list'] as $key => $val){
			$arraydipa_id_nama[$val['id']] = $val['nama'];
		}

		$rpd_bulan = array("januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "november", "desember");
		
		$data['rpd'] = $this->Guzzle_model->getAllFolderDataDukung();
		
		print_r($rpd_bulan); exit;

		if ($id_dipa!='00') {
			$data['rpd'] = $this->Guzzle_model->getFolderDataDukungByDipaId($id_dipa);
			$data['judul_tabel'] = $arraydipa_id_nama[$id_dipa];
		}

		
		if ($aksi == 't') {
			$p = "tambah";
			$data['judul_web'] 	  = "Buat Folder";
		} elseif ($aksi == 'e') {
			$p = "edit";
			$data['judul_web'] 	  = "Edit Folder";
			$data['rpd'] = $this->Guzzle_model->getFolderDataDukungById($id);
			// var_dump($data['rpd']); exit;
			if ($data['rpd']['id']=='') {redirect('404');}
		} elseif ($aksi == 'h') {
			$cek_data = $this->Guzzle_model->getFolderDataDukungById($id);
			if (count($cek_data) != 0) {
				$this->Guzzle_model->deleteFolderDataDukung($id);
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
				redirect("rpd/v/$id_dipa");
			}else {
				redirect('404_content');
			}
		}else{
			$p = "index";
			$data['judul_web'] 	  = "Rencana Penarikan Dana (RPD)";
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/rpd/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		if (isset($_POST['btnsimpan'])) {
			$name_folder = htmlentities(strip_tags($this->input->post('name_folder')));
			$simpan = 'y';

			if ($simpan=='y') {
				$data = array(
					'uraian'	=> $name_folder,
					'id_dipa'	=> $id_dipa
				);
				$this->Guzzle_model->createFolderDataDukung($data);

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
						 <strong>Gagal!</strong>
					</div>
				 <br>'
				);
			}
			redirect("rpd/v/$id_dipa");
		}

		if (isset($_POST['btnupdate'])) {
			// $id_rpd = htmlentities(strip_tags($this->input->post('id_rpd')));
			$name_folder = htmlentities(strip_tags($this->input->post('name_folder')));
			$simpan = 'y';

			if ($simpan=='y') {
				$data = array(
					'uraian' => $name_folder
				);
				// var_dump($id); exit;
				$this->Guzzle_model->updateFolderDataDukung($id, $data);

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
				
				redirect("rpd/v/$id_dipa");
			 }else {
				$this->session->set_flashdata('msg',
					 '
					 <div class="alert alert-warning alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
						  </button>
						  <strong>Gagal!</strong>
					 </div>
				  <br>'
				 );
				 redirect("rpd/v/$id_dipa/e/".hashids_encrypt($id));
			}
		}
	}
}