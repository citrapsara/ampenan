<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaksanaan_anggaran extends CI_Controller {
	public function index()
	{
		$id_dipa_user = $this->session->userdata('id_dipa');
		redirect("pelaksanaan_anggaran/v/".$id_dipa_user);
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


		// if ($id_dipa_user!='00') {
		// 	redirect("pelaksanaan_anggaran/v/".$id_dipa_user);
		// }
		
		$data['pelaksanaan_anggaran'] = $this->Guzzle_model->getAllPelaksanaanAnggaran();
		
		if ($id_dipa!='00') {
			$data['pelaksanaan_anggaran'] = $this->Guzzle_model->getPelaksanaanAnggaranByDipaId($id_dipa);
			$data['judul_tabel'] = $arraydipa_id_nama[$id_dipa];
		}

		
		if ($aksi == 't') {
			$p = "tambah";
			$data['judul_web'] 	  = "Input Pelaksanaan Anggaran";
		} elseif ($aksi == 'e') {
			$p = "edit";
			$data['judul_web'] 	  = "Edit Pelaksanaan Anggaran";
			$data['pelaksanaan_anggaran'] = $this->Guzzle_model->getPelaksanaanAnggaranById($id);
			// var_dump($data['pelaksanaan_anggaran']); exit;
			if ($data['pelaksanaan_anggaran']['id']=='') {redirect('404');}
		} elseif ($aksi == 'h') {
			$cek_data = $this->Guzzle_model->getPelaksanaanAnggaranById($id);
			if (count($cek_data) != 0) {
				$this->Guzzle_model->deletePelaksanaanAnggaran($id);
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
				redirect("pelaksanaan_anggaran/v/$id_dipa");
			}else {
				redirect('404_content');
			}
		}else{
			$p = "index";
			$data['judul_web'] 	  = "Pelaksanaan Anggaran";
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/pelaksanaan_anggaran/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		$lokasi = 'file/pelaksanaan_anggaran';
		$file_size = 1024 * 10; // 10 MB
		$this->upload->initialize(array(
			"upload_path"   => "./$lokasi",
			"allowed_types" => "*",
			"max_size" => "$file_size"
		));

		if (isset($_POST['btnsimpan'])) {
			$nama_pelaksanaan_anggaran = htmlentities(strip_tags($this->input->post('nama_pelaksanaan_anggaran')));
			$tanggal_pelaksanaan 	 = htmlentities(strip_tags($this->input->post('tanggal_pelaksanaan')));

			if ( ! $this->upload->do_upload('file_pertanggungjawaban'))
			{
				$simpan = 'n';
				$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
			}
			 else
			{
				$gbr = $this->upload->data();
				$filename = "$lokasi/".$gbr['file_name'];
				$file_pertanggungjawaban = preg_replace('/ /', '_', $filename);
				$simpan = 'y';
			}

			if ($simpan=='y') {
				$data_pelaksanaan = array(
					'uraian'				=> $nama_pelaksanaan_anggaran,
					'id_dipa'				=> $id_dipa,
					'url_file'				=> $file_pertanggungjawaban,
					'tanggal_pelaksanaan'	=> $tanggal_pelaksanaan
				);
				// $this->Guzzle_model->createPelaksanaanAnggaran($data_pelaksanaan);

				$kode_akun = $_POST['kode_akun'];
				// $kode_akun = htmlentities(strip_tags($this->input->post('kode_akun[]')));
				// $uraian_detil 	 = htmlentities(strip_tags($this->input->post('uraian_detil')));
				// $jumlah_realisasi 	 = htmlentities(strip_tags($this->input->post('jumlah realisasi')));

				echo '<pre>'; print_r($kode_akun); echo '</pre>'; exit;



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
			redirect("pelaksanaan_anggaran/v/$id_dipa");
		}

		if (isset($_POST['btnupdate'])) {
			// $id_pelaksanaan_anggaran = htmlentities(strip_tags($this->input->post('id_pelaksanaan_anggaran')));
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
				
				redirect("pelaksanaan_anggaran/v/$id_dipa");
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
				 redirect("pelaksanaan_anggaran/v/$id_dipa/e/".hashids_encrypt($id));
			}
		}
	}
}