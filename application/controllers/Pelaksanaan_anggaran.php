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

		if ($id_dipa_user!='00') {
			if ($id_dipa!=$id_dipa_user) {
				redirect('404');
			}
		}

		// function rupiah($angka) {
		// 	$hasil_rupiah = "Rp " . number_format($angka,0,"",".");
		// 	return $hasil_rupiah;
 		// }

		// $data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

		$data['dipa_list'] = $this->Guzzle_model->getDipaList();
		$arraydipa_id_nama = [];
		foreach($data['dipa_list'] as $key => $val){
			$arraydipa_id_nama[$val['id']] = $val['nama'];
		}
		
		$data['pelaksanaan_anggaran'] = $this->Guzzle_model->getAllPelaksanaanAnggaran();
		$data['total_realisasi'] = $this->Guzzle_model->getTotalPelaksanaanAnggaran();
		
		if ($id_dipa!='00') {
			$data['pelaksanaan_anggaran'] = $this->Guzzle_model->getPelaksanaanAnggaranByDipaId($id_dipa);
			$data['total_realisasi'] = $this->Guzzle_model->getTotalPelaksanaanAnggaranByDipa($id_dipa);
			$data['judul_tabel'] = $arraydipa_id_nama[$id_dipa];
		}

		foreach ($data['pelaksanaan_anggaran'] as $key => $value) {
			foreach ($data['total_realisasi'] as $subkey => $subvalue) {
				if($subvalue['id_pelaksanaan_anggaran'] == $value['id']) {
					$data['pelaksanaan_anggaran'][$key]['total_realisasi'] = $this->Mcrud->rupiah($subvalue['total_realisasi']);
				}
			}
		}
		// echo '<pre>'; print_r($data['pelaksanaan_anggaran']); echo '</pre>'; exit;
		
		if ($aksi == 't') {
			if ($level!='pelaksana') {redirect('404');}
			$p = "tambah";
			$data['judul_web'] 	  = "Input Pelaksanaan Anggaran";
		} elseif ($aksi == 'd') {
			$p = "detail";
			$data['judul_web'] 	  = "Detil Pelaksanaan Anggaran";

			$data['pelaksanaan_anggaran'] = $this->Guzzle_model->getPelaksanaanAnggaranById($id);

			$data['pelaksanaan_anggaran_akun_detil'] = $this->Guzzle_model->getPelaksanaanAnggaranAkunDetilByPelaksanaanAnggaran($id);

			foreach ($data['pelaksanaan_anggaran_akun_detil'] as $key => $value) {
				$jumlah[] = $value['jumlah_realisasi'];
				$data['pelaksanaan_anggaran_akun_detil'][$key]['jumlah_realisasi_rupiah'] = $this->Mcrud->rupiah($value['jumlah_realisasi']);
			}
			$data['total_realisasi'] = $this->Mcrud->rupiah(array_sum($jumlah));

			if ($data['pelaksanaan_anggaran']['id']=='') {redirect('404');} 
		} elseif ($aksi == 'e') {
			$p = "edit";
			$data['judul_web'] 	  = "Edit Pelaksanaan Anggaran";
			$data['pelaksanaan_anggaran'] = $this->Guzzle_model->getPelaksanaanAnggaranById($id);
			$data['pelaksanaan_anggaran_akun_detil'] = $this->Guzzle_model->getPelaksanaanAnggaranAkunDetilByPelaksanaanAnggaran($id);
			if ($data['pelaksanaan_anggaran']['id']=='' OR $data['pelaksanaan_anggaran']['status_verifikasi']=='sudah') {redirect('404');}
		} elseif ($aksi == 'c') {
			$p = "verifikasi";
			$data['judul_web'] 	  = "Verifikasi Pelaksanaan Anggaran";

			$data['pelaksanaan_anggaran'] = $this->Guzzle_model->getPelaksanaanAnggaranById($id);

			$data['pelaksanaan_anggaran_akun_detil'] = $this->Guzzle_model->getPelaksanaanAnggaranAkunDetilByPelaksanaanAnggaran($id);

			foreach ($data['pelaksanaan_anggaran_akun_detil'] as $key => $value) {
				$jumlah[] = $value['jumlah_realisasi'];
			}
			$data['total_realisasi'] = $this->Mcrud->rupiah(array_sum($jumlah));

			if ($data['pelaksanaan_anggaran']['id']=='') {redirect('404');}
		} elseif ($aksi == 'h') {
			$cek_data = $this->Guzzle_model->getPelaksanaanAnggaranById($id);
			if (count($cek_data) != 0 AND $cek_data['status_verifikasi'] != 'sudah') {
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
				$data_pelaksanaan_result = $this->Guzzle_model->createPelaksanaanAnggaran($data_pelaksanaan);

				$id_pelaksanaan_anggaran = $data_pelaksanaan_result['id'];				
				
				$kode_akun = $_POST['kode_akun'];
				$uraian_detil = $_POST['uraian_detil'];
				$jumlah_realisasi = $_POST['jumlah_realisasi'];
				
				for ($i=0; $i < count($kode_akun); $i++) { 
					$data_detil_akun = array(
						'kode_akun'				=> $kode_akun[$i],
						'uraian_detil'			=> $uraian_detil[$i],
						'jumlah_realisasi'		=> $jumlah_realisasi[$i],
						'id_pelaksanaan_anggaran'	=> $id_pelaksanaan_anggaran
					);

					$this->Guzzle_model->createPelaksanaanAnggaranAkunDetil($data_detil_akun);
				}

				

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
			$nama_pelaksanaan_anggaran = htmlentities(strip_tags($this->input->post('nama_pelaksanaan_anggaran')));
			$tanggal_pelaksanaan = htmlentities(strip_tags($this->input->post('tanggal_pelaksanaan')));
			$cek_file = $data['pelaksanaan_anggaran']['url_file'];
			if ($_FILES['file_pertanggungjawaban']['error'] <> 4) {
				if ( ! $this->upload->do_upload('file_pertanggungjawaban'))
				{
					$simpan = 'n';
					$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				} else {
					if ($cek_file!='') {
						unlink($cek_file);
					}
					$gbr = $this->upload->data();
					$filename = "$lokasi/".$gbr['file_name'];
					$file_pertanggungjawaban = preg_replace('/ /', '_', $filename);
					$simpan = 'y';
				}
			} else {
				$file_pertanggungjawaban = $cek_file;
				$simpan = 'y';
			}
				
			if ($simpan=='y') {
				$data_pelaksanaan = array(
					'uraian' => $nama_pelaksanaan_anggaran,
					'url_file' => $file_pertanggungjawaban,
					'tanggal_pelaksanaan' => $tanggal_pelaksanaan,
					'id_dipa' => $id_dipa
				);
				$this->Guzzle_model->updatePelaksanaanAnggaran($id, $data_pelaksanaan);

				$kode_akun = $_POST['kode_akun'];
				$uraian_detil = $_POST['uraian_detil'];
				$jumlah_realisasi = $_POST['jumlah_realisasi'];
				$id_pelaksanaan_anggaran_akun_detil = $_POST['id_pelaksanaan_anggaran_akun_detil'];
				
				for ($i=0; $i < count($kode_akun); $i++) { 
					$data_detil_akun = array(
						'kode_akun'				=> $kode_akun[$i],
						'uraian_detil'			=> $uraian_detil[$i],
						'jumlah_realisasi'		=> $jumlah_realisasi[$i],
						'id_pelaksanaan_anggaran'	=> $id
					);

					$this->Guzzle_model->updatePelaksanaanAnggaranAkunDetil($id_pelaksanaan_anggaran_akun_detil[$i], $data_detil_akun);
				}

				$kode_akun_new = $_POST['kode_akun_new'];
				$uraian_detil_new = $_POST['uraian_detil_new'];
				$jumlah_realisasi_new = $_POST['jumlah_realisasi_new'];
				
				for ($i=0; $i < count($kode_akun_new); $i++) { 
					$data_detil_akun_new = array(
						'kode_akun'				=> $kode_akun_new[$i],
						'uraian_detil'			=> $uraian_detil_new[$i],
						'jumlah_realisasi'		=> $jumlah_realisasi_new[$i],
						'id_pelaksanaan_anggaran'	=> $id
					);

					// echo '<pre>'; print_r($data_detil_akun_new); echo '</pre>'; exit;

					$this->Guzzle_model->createPelaksanaanAnggaranAkunDetil($data_detil_akun_new);
				}

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
			} else {
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
			redirect("pelaksanaan_anggaran/v/$id_dipa/e".hashids_encrypt($id));
			}

		}


		if (isset($_POST['btnkonfirm'])) {
			$data_lama = $data['pelaksanaan_anggaran'];
			$simpan = 'y';
			$pesan = '';

			$catatan_verifikator = htmlentities(strip_tags($this->input->post('catatan')));
			$status_verifikasi = htmlentities(strip_tags($this->input->post('status_verifikasi')));
			$skor_warna = htmlentities(strip_tags($this->input->post('skor_warna')));

			$data = array(
				'uraian' => $data_lama['uraian'],
				'url_file' => $data_lama['url_file'],
				'tanggal_pelaksanaan' => $data_lama['tanggal_pelaksanaan'],
				'id_dipa' => $data_lama['id_dipa'],
				'catatan_verifikator' => $catatan_verifikator,
				'status_verifikasi'				=> $status_verifikasi,
				'skor_warna'  => $skor_warna
			);

			if ($simpan=='y') {
				$this->Guzzle_model->updatePelaksanaanAnggaran($id, $data);
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
			redirect("pelaksanaan_anggaran/v/$id_dipa");
		}

	}

	public function hapus_akun_detil($id_dipa='', $id_pelaksanaan_anggaran='', $id_akun_detil='') {
		$id_akun_detil = hashids_decrypt($id_akun_detil);
		$cek_data = $this->Guzzle_model->getPelaksanaanAnggaranAkunDetilById($id_akun_detil);
			if (count($cek_data) != 0 AND $cek_data['status_verifikasi'] != 'sudah') {
				$this->Guzzle_model->deletePelaksanaanAnggaranAkunDetil($id_akun_detil);
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Sukses!</strong> Data berhasil dihapus.
					</div>
					<br>'
				);
				redirect("pelaksanaan_anggaran/v/$id_dipa/e/$id_pelaksanaan_anggaran");
			}else {
				redirect('404_content');
			}
	}
}