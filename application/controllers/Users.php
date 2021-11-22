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
			
			// $data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			// $data['users']  	 = $this->Mcrud->get_users();
			$data['judul_web'] = "Dashboard";
			
			$id_dipa = $this->session->userdata('id_dipa');

			// echo $id_dipa; exit;

			function persen($realisasi, $total) {
				$persen = ($realisasi / $total) * 100;
				return $persen;
			}
			function rupiah($angka) {
				$hasil_rupiah = "Rp " . number_format($angka,0,"",".");
				return $hasil_rupiah;
 			}

			if ($id_dipa == '00') {
				$data['dipa_list'] = $this->Guzzle_model->getDipaList();
				$counter = 0;
				foreach ($data['dipa_list'] as $key => $value) {
					if($value['id'] == '00') continue;
					$dipa_id[$counter] = $value['id'];
					$counter++;
				}
				$data['dipa_id'] = $dipa_id;

				// Data Pagu dan Realisasi seluruh satker
				$data['pagu_all'] = $this->Guzzle_model->getTotalPagu();
				$data['realisasi_jenis_belanja'] = $this->Guzzle_model->getTotalRealisasiJenisBelanja();
				
				foreach ($data['pagu_all'] as $key => $val) {
					$pagu_satker[$val['kode_satker']] = $val['jumlah'];
					$pagu_satker_rp[$val['kode_satker']] = rupiah($pagu_satker[$val['kode_satker']]);
				}
				$data['pagu_satker'] = $pagu_satker;
				$data['pagu_satker_rp'] = $pagu_satker_rp;

				foreach ($data['realisasi_jenis_belanja'] as $subkey => $subval) {
					if ($subval['jenis_belanja'] == '51') {
						$realisasi_bp[$subval['kode_satker']] = $subval['total_realisasi'];
						$realisasi_bp_rp[$subval['kode_satker']] = rupiah($subval['total_realisasi']);
					}
					if ($subval['jenis_belanja'] == '52') {
						$realisasi_bb[$subval['kode_satker']] = $subval['total_realisasi']; 
						$realisasi_bb_rp[$subval['kode_satker']] = rupiah($subval['total_realisasi']); 
					}
					if ($subval['jenis_belanja'] == '53') {
						$realisasi_bm[$subval['kode_satker']] = $subval['total_realisasi'];
						$realisasi_bm_rp[$subval['kode_satker']] = rupiah($subval['total_realisasi']); 
					}
					$realisasi_total[$subval['kode_satker']] = $realisasi_bp[$subval['kode_satker']] + $realisasi_bb[$subval['kode_satker']] + $realisasi_bm[$subval['kode_satker']];

					$realisasi_total_rp[$subval['kode_satker']] = rupiah($realisasi_total[$subval['kode_satker']]); 

					$realisasi_total_persen[$subval['kode_satker']] = persen($realisasi_total[$subval['kode_satker']], $data['pagu_satker'][$subval['kode_satker']]);

					$sisa_satker[$subval['kode_satker']] = $data['pagu_satker'][$subval['kode_satker']] - $realisasi_total[$subval['kode_satker']];

					$sisa_satker_pie_chart[$subval['kode_satker']] = $sisa_satker[$subval['kode_satker']];

					if ($sisa_satker[$subval['kode_satker']] < 0) {
						$sisa_satker_pie_chart[$subval['kode_satker']] = 0;
					}

					$sisa_satker_rp[$subval['kode_satker']] = rupiah($sisa_satker[$subval['kode_satker']]);

					$sisa_satker_persen[$subval['kode_satker']] = persen($sisa_satker[$subval['kode_satker']], $data['pagu_satker'][$subval['kode_satker']]);
				}
					
				$data['realisasi_satker_bp'] = $realisasi_bp;
				$data['realisasi_satker_bb'] = $realisasi_bb;
				$data['realisasi_satker_bm'] = $realisasi_bm;
				$data['realisasi_satker_total'] = $realisasi_total;
				$data['sisa_satker'] = $sisa_satker;
				$data['sisa_satker_pie_chart'] = $sisa_satker_pie_chart;


				$data['realisasi_satker_bp_rp'] = $realisasi_bp_rp;
				$data['realisasi_satker_bb_rp'] = $realisasi_bb_rp;
				$data['realisasi_satker_bm_rp'] = $realisasi_bm_rp;
				$data['realisasi_satker_total_rp'] = $realisasi_total_rp;
				$data['sisa_satker_rp'] = $sisa_satker_rp;

				$data['realisasi_satker_persen'] = $realisasi_total_persen;
				$data['sisa_satker_persen'] = $sisa_satker_persen;
			} else {
				$dipa = $this->Guzzle_model->getDetailDipa($id_dipa);
				$data['nama_dipa'] = $dipa['nama'];


				// Data Pagu dan Realisasi Anggaran 
				$data['total_pagu'] = $this->Guzzle_model->getTotalPagubyKodeSatker($id_dipa);
				// $data['total_realisasi'] = $this->Guzzle_model->getTotalRealisasibyKodeSatker($id_dipa);

				$total_realisasi_jenis_belanja = $this->Guzzle_model->getTotalRealisasiJenisBelanjabyKodeSatker($id_dipa);

				foreach ($total_realisasi_jenis_belanja as $key => $value) {
					if ($value['jenis_belanja'] == '51') {
						$data['realisasi_bp'] = $value['total_realisasi'];
						var_dump($data['realisasi_bp']); exit;
					}
					if ($value['jenis_belanja'] == '52') {
						$data['realisasi_bb'] = $value['total_realisasi'];
					}
					if ($value['jenis_belanja'] == '53') {
						$data['realisasi_bm'] = $value['total_realisasi'];
					}
				}


				$data['total_realisasi'] = $data['realisasi_bp'] + $data['realisasi_bb'] + $data['realisasi_bm'];				

				$data['sisa_anggaran'] = $data['total_pagu'] - $data['total_realisasi'];

				// Data Pagu dan Realisasi Anggaran dalam Rupiah
				$data['total_pagu_rp'] = rupiah($data['total_pagu']);
				$data['total_realisasi_rp'] = rupiah($data['total_realisasi']);
				$data['sisa_anggaran_rp'] = rupiah($data['sisa_anggaran']);
				$data['realisasi_bp_rp'] = rupiah($data['realisasi_bp']);
				$data['realisasi_bb_rp'] = rupiah($data['realisasi_bb']);
				$data['realisasi_bm_rp'] = rupiah($data['realisasi_bm']);

				// Data Pagu dan Realisasi Anggaran dalam Persen
				

				$data['persen_realisasi'] = persen($data['total_realisasi'], $data['total_pagu']);
				$data['persen_sisa'] = persen($data['sisa_anggaran'], $data['total_pagu']);
			}

			

			$this->load->view('users/header', $data);
			if ($id_dipa == '00') {
				$this->load->view('users/dashboard_all', $data);
			} else {
				$this->load->view('users/dashboard_kode_satker', $data);
			}
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
			$data['user']  			  = $ceks;
			$data['level_users']  = $level;
			$data['judul_web'] 		= "Profile";

			$this->load->view('users/header', $data);
			$this->load->view('users/profile', $data);
			$this->load->view('users/footer');
		}
	}

}
