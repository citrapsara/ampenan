<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Client;

class Web extends CI_Controller {

	public function index()
	{
		$data['judul_web'] = $this->Mcrud->judul_web();

		$this->load->view('web/header', $data);
		$this->load->view('web/beranda', $data);
		$this->load->view('web/footer', $data);
	}

	public function login()
	{
		$ceks = $this->session->userdata('username');
		if(isset($ceks)) {
			// $this->load->view('404_content');
			redirect('dashboard');
		}else{
			$data['judul_web'] = "Halaman Login - ".$this->Mcrud->judul_web();
			$this->load->view('web/log/header', $data);
			$this->load->view('web/log/login', $data);
			$this->load->view('web/log/footer', $data);

			if (isset($_POST['btnlogin'])){
				$username = htmlentities(strip_tags($_POST['username']));
				$pass	   = htmlentities(strip_tags($_POST['password']));

				$data = array(
					'username' 	=> $username,
					'password'	=> $pass
				);

				try {
					$client = new Client([
						'base_uri' => 'http://localhost/api/index.php/',
						'headers' => [
							'Client-Service' => 'frontend-client',
							'Auth-Key' => 'simplerestapi',
							'Content-Type' => 'application/json'
						]
					]);
					
					$response = $client->request('POST', 'auth/login', [
						'json' => $data
					]);

					if (200 == $response->getStatusCode()) {
						$login_result = json_decode($response->getBody()->getContents(), true);
					}
				} catch (GuzzleHttp\Exception\ClientException $e) {
					$response = $e->getResponse();
    				$responseBody = json_decode($response->getBody()->getContents());
				}

				if($login_result["status"] != 200) {
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
							  </button>
							  <strong>"'.$responseBody->message.'"</strong>
						</div>'
					);
					redirect('web/login');
					} else {
						$userID = $login_result['id'];
						$user_role = $login_result['role'];
						$user_token = $login_result['token'];
						$user_dipa = $login_result['id_dipa'];
						$this->session->set_userdata('username', "$username");
						$this->session->set_userdata('id_user', "$userID");
						$this->session->set_userdata('level', "$user_role");
						$this->session->set_userdata('token', "$user_token");
						$this->session->set_userdata('id_dipa', "$user_dipa");
						// $this->session->set_userdata('jml_notif_bell', "0");

						redirect('dashboard');
					}
				}
			}
		}
	


	public function logout() {
     if ($this->session->has_userdata('username') and $this->session->has_userdata('id_user')) {
         $this->session->sess_destroy();
		}

		redirect('web/login');
	}

	function error_not_found(){
		$this->load->view('404_content');
	}


	public function notif_bell($aksi='')
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_user = $this->session->userdata('id_user');
		$level	 = $this->session->userdata('level');

		$this->db->order_by('id_notif','DESC');
		$data['query'] = $this->db->get_where('tbl_notif', array('penerima'=>$id_user));
		$jml_notif_baru = 0;
 		foreach ($data['query']->result() as $key => $value) {
			if(!preg_match("/$id_user/i", $value->hapus_notif)) {
				$jml_notif_baru++;
			}
		}
		
		foreach ($data['query']->result() as $key => $value) {
			if((preg_match("/$id_user/i", $value->baca_notif)) && (!preg_match("/$id_user/i", $value->hapus_notif))) {
				$jml_notif_baru--;
			}
		}
		
		$data['jml_notif'] = $jml_notif_baru;
		if ($aksi=='pesan_baru') {
			$jml_notif_bell = $this->session->userdata('jml_notif_bell');
			if ($jml_notif_bell >= $jml_notif_baru) {
				$stt='0';
			} else {
				$stt='1';
			}
			$this->session->set_userdata('jml_notif_bell', "$jml_notif_baru");
			if ($id_user=='') {
				echo '11';
			} else {
				echo $stt;
			}
		} elseif ($aksi=='jml') {
			echo number_format($jml_notif_baru,0,",",".");
		} else {
			$this->load->view('users/notif/bell', $data);
		}	
	}

	public function notif($aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		} else {
			// $data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			// $data['users']  	 = $this->Mcrud->get_users();
			$data['judul_web'] = "Notifikasi";

			$this->db->order_by('id_notif','DESC');
			$data['query'] = $this->db->get_where('tbl_notif', array('penerima'=>$id_user));

			if ($aksi=='h' or $aksi=='h_all') {
				if ($aksi=='h') {
					$cek_data = $this->db->get_where("tbl_notif", array('id_notif'=>"$id"));
				} else {
					$cek_data = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user"));
				}
				if ($cek_data->num_rows() != 0) {
					if ($aksi=='h') {
						$h_notif = $cek_data->row()->hapus_notif;
						if(!preg_match("/$id_user/i", $h_notif)) {
							$data = array('hapus_notif'=>"$id_user, $h_notif");
							$this->db->update('tbl_notif', $data, array('id_notif'=>$id));
						}
					} else {
						foreach ($cek_data->result() as $key => $value) {
							$h_notif = $value->hapus_notif;
							if(!preg_match("/$id_user/i", $h_notif)) {
								$data = array('hapus_notif'=>"$id_user, $h_notif");
								$this->db->update('tbl_notif', $data, array('penerima'=>$id_user));
							}
						}
					}
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
					redirect("web/notif");
				} else {
					if ($aksi=='h') {
						redirect('404_content');
					} else {
						redirect("web/notif");
					}
				}
			}

			$this->load->view('users/header', $data);
			$this->load->view('users/notif/index', $data);
			$this->load->view('users/footer');
		}
	}

}
