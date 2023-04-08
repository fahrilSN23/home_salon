<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

	public function register(){
		if (isset($_POST['submit1'])){
			$data = array('nama'=>$this->input->post('a'),
						  'email'=>$this->input->post('b'),
	        			  'password'=>hash("sha512", md5($this->input->post('c'))),
	        			  'alamat'=>$this->input->post('d'),
	        			  'no_telp'=>$this->input->post('e'),
	        			  'no_rek'=>$this->input->post('f'),
						  'bank'=>$this->input->post('g'),
						  'atas_nama'=>$this->input->post('h'));
			$this->model_app->insert('pelanggan',$data);
			$id = $this->db->insert_id();
			$this->session->set_userdata(array('id_pelanggan'=>$id, 'level'=>'pelanggan'));

			if ($this->session->idp!=''){
				// $jadwal = penentuan_jadwal();
				$data = array('no_transaksi'=>$this->session->idp,
			        		  'id_pelanggan'=>$id);
				$this->model_app->insert('pemesanan',$data);
				$idp = $this->db->insert_id();

				$keranjang = $this->model_app->view_where('pemesanan_temp',array('session'=>$this->session->idp));
				foreach ($keranjang->result_array() as $row) {
					$dataa = array('id_pemesanan'=>$idp,
				        		   'id_produk'=>$row['id_produk'],
				        		   'jumlah'=>$row['jumlah'],
				        		   'harga_pesan'=>$row['harga_pesan']);
					$this->model_app->insert('detil_pemesanan',$dataa);
				}

				$this->db->query("DELETE FROM pemesanan_temp where session='".$this->session->idp."'");
				$this->session->unset_userdata('idp');
				$this->session->set_userdata(array('idp'=>$idp));
			}
			redirect('members/profile');

		}else{
			$data['title'] = 'Formulir Pendaftaran';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['iden'] = iden();
			$this->template->load('main/template','main/view_register',$data);
		}
	}

	public function login(){
        $data['title'] = title();
		$data['description'] = description();
		$data['keywords'] = keywords();
		$data['iden'] = iden();
		if (isset($_POST['login'])){
				$email = strip_tags($this->input->post('a'));
				$password = hash("sha512", md5(strip_tags($this->input->post('b'))));
				$cek = $this->db->query("SELECT * FROM pelanggan where email='".$this->db->escape_str($email)."' AND password='".$this->db->escape_str($password)."'");
			    $row = $cek->row_array();
			    $total = $cek->num_rows();
				if ($total > 0){
					$this->session->set_userdata(array('id_pelanggan'=>$row['id_pelanggan'], 'level'=>'pelanggan'));
					if ($this->session->idp!=''){
                        // Pengaturan Jadwal & No antrian
                        // $jadwal = penentuan_jadwal();

						$data = array('no_transaksi'=>$this->session->idp,
			        			  'id_pelanggan'=>$row['id_pelanggan']);
						$this->model_app->insert('pemesanan',$data);
						$id = $this->db->insert_id();

						$query_temp = $this->db->query("SELECT * FROM pemesanan_temp where session='".$this->session->idp."'");
						foreach ($query_temp->result_array() as $r) {
							$data = array('id_pemesanan'=>$id,
			        			  'id_produk'=>$r['id_produk'],
			        			  'harga_pesan'=>$r['harga_pesan']);
							$this->model_app->insert('detil_pemesanan',$data);
						}
						$this->db->query("DELETE FROM pemesanan_temp where session='".$this->session->idp."'");

						$this->session->unset_userdata('idp');
						$this->session->set_userdata(array('idp'=>$id));
					}
					redirect('members/profile');
				}else{
					$data['title'] = 'Gagal Login';
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Email atau password salah!</center></div>');
					redirect('auth/login');
				}
		}else{
			$data['title'] = 'Login';
			$this->template->load('main/template','main/view_login',$data);
		}
	}

    function logout(){
		cek_session_members();
		$this->session->sess_destroy();
		redirect('main');
	}

}