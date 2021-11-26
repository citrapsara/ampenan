<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Model {

 public static function tgl_id($date, $bln='')
 {
	 date_default_timezone_set('Asia/Jakarta');
		 $str = explode('-', $date);
		 $bulan = array(
			 '01' => 'Januari',
			 '02' => 'Februari',
			 '03' => 'Maret',
			 '04' => 'April',
			 '05' => 'Mei',
			 '06' => 'Juni',
			 '07' => 'Juli',
			 '08' => 'Agustus',
			 '09' => 'September',
			 '10' => 'Oktober',
			 '11' => 'November',
			 '12' => 'Desember',
		 );
		 if ($bln == '') {
			 $hasil = $str['0'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[2];
		 }elseif ($bln == 'full') {
			 $hasil = $str['0'] . " " . $bulan[$str[1]] . " " .$str[2];
		 }else {
			 $hasil = $bulan[$str[1]];
		 }
		 return $hasil;
 }

	public function hari_id($tanggal)
	{
		$day = date('D', strtotime($tanggal));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => "Jum'at",
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}

	public function get_user_name_by_id($id)
	{
		$user = $this->Guzzle_model->getUserById($id);
		return $user['nama'];
	}

	public function cek_lokasi($id_dipa) {
		$dipa = $this->Guzzle_model->getDetailDipa($id_dipa);
		if ($dipa['lokasi'] == 'kanwil') {
			return true;
		}
	}

	public function waktu($data, $aksi='')
	{
		if ($aksi=='full') {
			$tgl_n = date('d-m-Y H:i:s',strtotime($data));
		}else {
			$tgl_n = date('d-m-Y',strtotime($data));
		}
		$hari = $this->Mcrud->hari_id($tgl_n);
		$tgl  = $this->Mcrud->tgl_id($tgl_n,$aksi);
		return $hari.", ".$tgl;
	}

	function judul_web($id='')
	{
		// $nama_web = $this->db->get_where('tbl_web',"id_web='1'")->row()->nama_web;
		// $ket_web  = $this->db->get_where('tbl_web',"id_web='1'")->row()->ket_web;
		// if ($id==1) {
		// 	$data = "$nama_web";
		// }elseif ($id==2) {
		// 	$data = "$ket_web";
		// }else {
		// 	$data = "$nama_web $ket_web";
		// }
		$data = '';
		return $data;
	}

	// function footer()
	// {
	// 		return "Copyright &copy; 2019 | Developer by <a href='#' target='_blank'>CV. LINK NET</a>";
	// }

	public function cek_filename($file='')
	{
		$data = "assets/favicon.png";
		if ($file != '') {
			if(file_exists("$file")){
				$data = $file;
			}
		}
		return $data;
	}

	function kirim_notif($notif_type, $id_dipa, $id_for_link, $pengirim, $penerima)
	{
		if ($notif_type == 'pelaksanaan_anggaran') {
			$data_notif = array(
				'pesan'				=> "mengirim laporan pelaksaanaan anggaran",
				'link'				=> "pelaksanaan_anggaran/v/$id_dipa/d/".hashids_encrypt($id_for_link),
				'status'				=> "belum dibaca",
				'id_user_pengirim'	=> $pengirim,
				'id_user_penerima'	=> $penerima
			);
		}
		$this->Guzzle_model->createNotifikasi($data_notif);
	}

	public function rupiah($angka) {
		$hasil_rupiah = "Rp " . number_format($angka,0,"",".");
		return $hasil_rupiah;
	}

	public function persen($realisasi, $total) {
		 $persen = ($realisasi / $total) * 100;
		 return $persen;
	}

	public function status_verifikasi($status) {
		if($status == 'sudah') { 
            echo '<label class="label label-success">SUDAH DIVERIFIKASI</label>';
        } elseif($status == 'tolak') {
            echo '<label class="label label-danger">PERLU PERBAIKAN</label>';
        } else {
            echo '<label class="label label-default">BELUM DIVERIFIKASI</label>';
        }
	}

	public function status_verifikasi_revisi_dipa($status) {
		if($status == 'sudah') { 
            echo '<label class="label label-success">SELESAI</label>';
        } elseif($status == 'belum') {
            echo '<label class="label label-warning">DALAM PROSES</label>';
        }
	}

	
}
