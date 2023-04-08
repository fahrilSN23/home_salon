<?php
/*
-- ---------------------------------------------------------------
-- MARKETPLACE MULTI BUYER MULTI SELLER + SUPPORT RESELLER SYSTEM
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-03-27
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
            $username = $this->input->post('a');
            $password = hash("sha512", md5($this->input->post('b')));
            $cek = $this->model_app->cek_login($username,$password,'users');
            $row = $cek->row_array();
            $total = $cek->num_rows();
            if ($total > 0){
                $this->session->set_userdata('upload_image_file_manager',true);
                $this->session->set_userdata(array('id_user'=>$row['id_user'],
                                    'username'=>$row['username'],
                                    'tipe'=>$row['tipe']));
                redirect($this->uri->segment(1).'/home');
            }else{
                echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username dan Password Salah!!</center></div>');
                redirect($this->uri->segment(1).'/index');
            }
		}else{
          if ($this->session->tipe!=''){
            redirect($this->uri->segment(1).'/home');
          }else{
    			$data['title'] = 'Administrator &rsaquo; Log In';
    			$this->load->view('administrator/view_login',$data);
            }
		}
	}

  function home(){
      if ($this->session->tipe=='Kasir'){
        $data['title'] = "KASIR";
        $this->template->load('administrator/template','administrator/view_home_kasir', $data);
      }else if ($this->session->tipe=='Pimpinan'){
        $data['title'] = "PIMPINAN";
        $this->template->load('administrator/template','administrator/view_home_pimpinan', $data);
      }else{
        redirect('main');
      }
  }

  // Controller Modul terapis

  function terapis(){
    cek_session_admin();
    $data['record'] = $this->model_app->view_ordering('terapis','id_terapis','ASC');
    $this->template->load('administrator/template','administrator/mod_terapis/view_terapis',$data);
  }

  function tambah_terapis(){
    cek_session_admin();
    if (isset($_POST['submit'])){
        $data = array('nama_terapis'=>$this->input->post('a'),
                    'telp_terapis'=>$this->input->post('b'),
                    'alamat_terapis'=>$this->input->post('c'));
        $this->model_app->insert('terapis',$data);
        redirect('administrator/terapis');
    }else{
        $this->template->load('administrator/template','administrator/mod_terapis/view_terapis_tambah');
    }
  }

  function edit_terapis(){
    cek_session_admin();
    $id = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('nama_terapis'=>$this->input->post('a'),
                      'telp_terapis'=>$this->input->post('b'),
                      'alamat_terapis'=>$this->input->post('c'));
        $where = array('id_terapis' => $this->input->post('id'));
        $this->model_app->update('terapis', $data, $where);
        redirect('administrator/terapis');
    }else{
        $data['rows'] = $this->model_app->view_where('terapis',array('id_terapis'=>$id))->row_array();
        $this->template->load('administrator/template','administrator/mod_terapis/view_terapis_edit',$data);
    }
  }

  function delete_terapis(){
    cek_session_admin();
    $id = array('id_terapis' => $this->uri->segment(3));
        $this->model_app->delete('terapis',$id);
        redirect($this->uri->segment(1).'/terapis');
  }

  // Controller Modul Pelanggan

  function pelanggan(){
    cek_session_admin();
    $data['record'] = $this->model_app->view_ordering('pelanggan','id_pelanggan','ASC');
    $this->template->load('administrator/template','administrator/mod_pelanggan/view_pelanggan',$data);
  }

  function tambah_pelanggan(){
		cek_session_admin();
		$id = $this->session->username;
		if (isset($_POST['submit'])){
      $data = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                      'email'=>$this->db->escape_str($this->input->post('email')),
                      'password'=>hash("sha512", md5($this->input->post('password'))),
                      'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                      'no_telp'=>$this->db->escape_str($this->input->post('no_telp')),
                      'no_rek'=>$this->db->escape_str($this->input->post('no_rek')),
                      'bank'=>$this->db->escape_str($this->input->post('bank')),
                      'atas_nama'=>$this->db->escape_str($this->input->post('atas_nama')));
      $this->model_app->insert('pelanggan',$data);

			redirect($this->uri->segment(1).'/pelanggan');
		}else{
        $this->template->load('administrator/template','administrator/mod_pelanggan/view_pelanggan_tambah');
		}
	}

  function edit_pelanggan(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
      if ($this->input->post('password') ==''){
              $data = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                              'email'=>$this->db->escape_str($this->input->post('email')),
                              'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                              'no_telp'=>$this->db->escape_str($this->input->post('no_telp')),
                              'no_rek'=>$this->db->escape_str($this->input->post('no_rek')),
                              'bank'=>$this->db->escape_str($this->input->post('bank')),
                              'atas_nama'=>$this->db->escape_str($this->input->post('atas_nama')));
      }elseif ($this->input->post('password') !=''){
              $data = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                              'email'=>$this->db->escape_str($this->input->post('email')),
                              'password'=>hash("sha512", md5($this->input->post('password'))),
                              'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                              'no_telp'=>$this->db->escape_str($this->input->post('no_telp')),
                              'no_rek'=>$this->db->escape_str($this->input->post('no_rek')),
                              'bank'=>$this->db->escape_str($this->input->post('bank')),
                              'atas_nama'=>$this->db->escape_str($this->input->post('atas_nama')));
      }

      $where = array('id_pelanggan' => $this->input->post('id'));
      $this->model_app->update('pelanggan', $data, $where);

			redirect($this->uri->segment(1).'/pelanggan');
		}else{
      $proses = $this->model_app->edit('pelanggan', array('id_pelanggan' => $id))->row_array();
      $data = array('rows' => $proses);
      $this->template->load('administrator/template','administrator/mod_pelanggan/view_pelanggan_edit',$data);
		}
	}

  function delete_pelanggan(){
    cek_session_admin();
    $id = array('id_pelanggan' => $this->uri->segment(3));
        $this->model_app->delete('pelanggan',$id);
        redirect($this->uri->segment(1).'/pelanggan');
  }

  // Controller Modul Jenis Perawatan

  function jenisperawatan(){
		cek_session_admin();
		$data['record'] = $this->model_app->view_ordering('jenis','id_jenis','ASC');
		$this->template->load('administrator/template','administrator/mod_jenis/view_jenis',$data);
	}

  function tambah_jenis(){
    cek_session_admin();
    if (isset($_POST['submit'])){
        $data = array('jenis_perawatan'=>$this->input->post('a'),
                    'deskripsi'=>$this->input->post('c'));
        $this->model_app->insert('jenis',$data);
        $id_jenis = $this->db->insert_id();

        $mod=count($this->input->post('produk'));
        $produk=$this->input->post('produk');
        for($i=0;$i<$mod;$i++){
          $datam = array('id_jenis'=>$id_jenis,
                        'id_produk'=>$produk[$i]);
          $this->model_app->insert('jenis_to_produk',$datam);
        }
        redirect('administrator/jenisperawatan');
    }else{
        $proses = $this->db->query("SELECT * FROM produk WHERE aktif = 1 ORDER BY nama ASC")->result_array();
        $data = array('record' => $proses);
        $this->template->load('administrator/template','administrator/mod_jenis/view_jenis_tambah', $data);
    }
  }

  function edit_jenis(){
    cek_session_admin();
    $id = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('jenis_perawatan'=>$this->input->post('a'),
                    'deskripsi'=>$this->input->post('c'));
        $where = array('id_jenis' => $this->input->post('id'));
        $this->model_app->update('jenis', $data, $where);

        $mod=count($this->input->post('produk'));
        $produk=$this->input->post('produk');
        for($i=0;$i<$mod;$i++){
          $datam = array('id_jenis'=>$this->input->post('id'),
                        'id_produk'=>$produk[$i]);
          $this->model_app->insert('jenis_to_produk',$datam);
        }

        redirect('administrator/jenisperawatan');
    }else{
        $proses = $this->model_app->edit('jenis', array('id_jenis' => $id))->row_array();
        $akses = $this->model_app->view_join_where('jenis_to_produk','produk','id_produk', array('id_jenis' => $proses['id_jenis']),'nama','ASC');
        $produk = $this->db->query("SELECT * FROM produk WHERE aktif = 1 ORDER BY nama ASC")->result_array();
        $data = array('rows' => $proses, 'record' => $produk, 'akses' => $akses);
        $this->template->load('administrator/template','administrator/mod_jenis/view_jenis_edit',$data);
    }
  }

  function delete_pjperawatan(){
    cek_session_admin();
    $id = array('id_jenistoproduk' => $this->uri->segment(3));
    $this->model_app->delete('jenis_to_produk',$id);
    redirect($this->uri->segment(1).'/edit_jenis/'.$this->uri->segment(4));
  }

  function delete_jenis(){
    cek_session_admin();
    $id = array('id_jenis' => $this->uri->segment(3));
    $this->model_app->delete('jenis',$id);
    $this->model_app->delete('jenis_to_produk',$id);
    redirect($this->uri->segment(1).'/jenisperawatan');
  }

  // Controller Modul Produk Perawatan

  function produkperawatan(){
    cek_session_admin();
    $data['record'] = $this->model_app->view_ordering('produk','id_produk','ASC');
    $this->template->load('administrator/template','administrator/mod_produk/view_produk',$data);
  }

  function tambah_produk(){
    cek_session_admin();
    if (isset($_POST['submit'])){
        $data = array('nama'=>$this->input->post('a'),
                    'harga'=>$this->input->post('b'),
                    'deskripsi'=>$this->input->post('c'),
                    'jam'=>$this->input->post('d'),
                    'menit'=>$this->input->post('e'),
                    'aktif'=>$this->input->post('f')
                  );
        $this->model_app->insert('produk',$data);
        redirect('administrator/produkperawatan');
    }else{
        $this->template->load('administrator/template','administrator/mod_produk/view_produk_tambah');
    }
  }

  function edit_produk(){
    cek_session_admin();
    $id = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('nama'=>$this->input->post('a'),
                    'harga'=>$this->input->post('b'),
                    'deskripsi'=>$this->input->post('c'),
                    'jam'=>$this->input->post('d'),
                    'menit'=>$this->input->post('e'),
                    'aktif'=>$this->input->post('f'));
        $where = array('id_produk' => $this->input->post('id'));
        $this->model_app->update('produk', $data, $where);
        redirect('administrator/produkperawatan');
    }else{
        $data['rows'] = $this->model_app->view_where('produk',array('id_produk'=>$id))->row_array();
        $this->template->load('administrator/template','administrator/mod_produk/view_produk_edit',$data);
    }
  }

  function delete_produk(){
    cek_session_admin();
    $id = array('id_produk' => $this->uri->segment(3));
        $this->model_app->delete('produk',$id);
        redirect($this->uri->segment(1).'/produkperawatan');
  }

  // Controller Modul Identitas Website

  function identitas(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/images/';
            $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size'] = '500'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('j');
            $hasil=$this->upload->data();

            if ($hasil['file_name']==''){
            	$data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                'email'=>$this->db->escape_str($this->input->post('b')),
                                'url'=>$this->db->escape_str($this->input->post('c')),
                                'facebook'=>$this->input->post('d'),
                                'rekening'=>$this->db->escape_str($this->input->post('e')),
                                'no_telp'=>$this->db->escape_str($this->input->post('f')),
                                'meta_deskripsi'=>$this->input->post('g'),
                                'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                'maps'=>$this->input->post('i'));
            }else{
            	$data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                'email'=>$this->db->escape_str($this->input->post('b')),
                                'url'=>$this->db->escape_str($this->input->post('c')),
                                'facebook'=>$this->input->post('d'),
                                'rekening'=>$this->db->escape_str($this->input->post('e')),
                                'no_telp'=>$this->db->escape_str($this->input->post('f')),
                                'meta_deskripsi'=>$this->input->post('g'),
                                'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                'favicon'=>$hasil['file_name'],
                                'maps'=>$this->input->post('i'));
            }
      $where = array('id_identitas' => $this->input->post('id'));
			$this->model_app->update('identitas', $data, $where);

			redirect($this->uri->segment(1).'/identitas');
		}else{
			$proses = $this->model_app->edit('identitas', array('id_identitas' => 1))->row_array();
			$data = array('record' => $proses);
			$this->template->load('administrator/template','administrator/mod_identitas/view_identitas',$data);
		}
	}

  // Controller Modul Jam Operasional

  function jamoperasional(){
    cek_session_admin();
    $data['record'] = $this->model_app->view_ordering('jam','id_jam','ASC');
    $this->template->load('administrator/template','administrator/mod_jam/view_jam',$data);
  }

  // Controller Modul Tentang Kami

  function tentangkami() {
		cek_session_admin();
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_statis/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'judul_seo'=>seo_title($this->input->post('a')),
                                    'isi'=>$this->input->post('b'));
            }else{
            		$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'judul_seo'=>seo_title($this->input->post('a')),
                                    'isi'=>$this->input->post('b'),
                                    'gambar'=>$hasil['file_name']);
            }
            $where = array('id' => 1);
			$this->model_app->update('tentangkami', $data, $where);
			redirect($this->uri->segment(1).'/tentangkami');
		}else{
      $proses = $this->model_app->edit('tentangkami', array('id' => 1))->row_array();
			$data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman',$data);
		}
	}

  function tambah_jam(){
    cek_session_admin();
    if (isset($_POST['submit'])){
        $data = array('hari'=>$this->input->post('a'),
                    'buka'=>$this->input->post('b'),
                    'tutup'=>$this->input->post('c'));
        $this->model_app->insert('jam',$data);
        redirect('administrator/jamoperasional');
    }else{
        $this->template->load('administrator/template','administrator/mod_jam/view_jam_tambah');
    }
  }

  function edit_jam(){
    cek_session_admin();
    $id = $this->uri->segment(3);
    if (isset($_POST['submit'])){
       $data = array('hari'=>$this->input->post('a'),
                    'buka'=>$this->input->post('b'),
                    'tutup'=>$this->input->post('c'));
        $where = array('id_jam' => $this->input->post('id'));
        $this->model_app->update('jam', $data, $where);
        redirect('administrator/jamoperasional');
    }else{
        $data['rows'] = $this->model_app->view_where('jam',array('id_jam'=>$id))->row_array();
        $this->template->load('administrator/template','administrator/mod_jam/view_jam_edit',$data);
    }
  }

  function delete_jam(){
    cek_session_admin();
    $id = array('id_jam' => $this->uri->segment(3));
        $this->model_app->delete('jam',$id);
        redirect($this->uri->segment(1).'/jamoperasional');
  }

  // Controller Modul Pemesanan

  function pemesanan(){
    cek_session_admin();
    $data['record'] = $this->model_app->view_join_one('pemesanan','pelanggan','id_pelanggan','id_pemesanan','DESC');
    $this->template->load('administrator/template','administrator/mod_pemesanan/view_pemesanan',$data);
  }

  function kirimnotif() {
    $phone = $this->uri->segment(3);
    $days = $this->uri->segment(5);
    $msg = "Hallo, Waktu kedatangan anda *" . $days . " menit lagi.*";
    
    $this->model_hs->kirimPesanWA($phone,$msg);
    redirect('administrator/pemesanan');
  }

  function detail_pemesanan(){
    cek_session_admin();
    $data['rows'] = $this->model_hs->penjualan_detail($this->uri->segment(3))->row_array();
    $data['bf'] = $this->model_app->view_where('konfirmasi',array('id_pemesanan' => $this->uri->segment(3)))->row_array();
    $data['terapis'] = $this->model_app->view_ordering('terapis','nama_terapis','ASC');
    $data['record'] = $this->model_app->view_join_where('detil_pemesanan','produk','id_produk',array('id_pemesanan'=>$this->uri->segment(3)),'id_detil_pemesanan','DESC');
    if ($this->uri->segment(4) == "accept") {
      $this->template->load('administrator/template','administrator/mod_pemesanan/view_pemesanan_detail_accept',$data);
    }else if ($this->uri->segment(4) == "reject") {
      $this->template->load('administrator/template','administrator/mod_pemesanan/view_pemesanan_detail_reject',$data);
    }
  }

  function add_terapis() {
    cek_session_admin();
    $id = $this->uri->segment(3);
    if (isset($_POST['submit'])){
        $order = $this->model_app->view_where('pemesanan',array('id_pemesanan'=>$id))->row_array();
        if ($order['no_antrian'] == null) {
          $jadwal = penentuan_jadwal($this->input->post('tanggal_treatment'));
          $no_antrian = $jadwal['no_antrian'];
          $data = array(
            'no_antrian' => $no_antrian,
            'tanggal_treatment' => $this->input->post('tanggal_treatment'),
            'id_terapis'=>$this->input->post('id_terapis'));
        }else{
          $data = array(
            'tanggal_treatment' => $this->input->post('tanggal_treatment'),
            'id_terapis'=>$this->input->post('id_terapis'));
        }
        
        $where = array('id_pemesanan' => $id);
        $this->model_app->update('pemesanan', $data, $where);
        redirect('administrator/pemesanan/');
    }
  }

  function refund() {
    cek_session_admin();
    $id = $this->uri->segment(3);
    if (isset($_POST['submit'])){
        $config['upload_path'] = 'asset/files/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '10000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('bukti_refund');
        $hasil=$this->upload->data();
        $data = array(
          'bukti_refund' => $hasil['file_name'],
          'tanggal_refund' => $this->input->post('tanggal_refund'),
          'c_order' => 3
        );
          
        $where = array('id_pemesanan' => $id);
        $this->model_app->update('pemesanan', $data, $where);
        redirect('administrator/pemesanan/');
    }
  }

  function proses_pemesanan(){
    cek_session_admin();
    $data = array('status'=>$this->uri->segment(4));
    $where = array('id_pemesanan' => $this->uri->segment(3));
    $this->model_app->update('pemesanan', $data, $where);

    redirect('administrator/pemesanan');
  }

  function cek_pemesanan(){
    cek_session_admin();
    $c_order = $this->uri->segment(4);
    $id_pemesanan = $this->uri->segment(3);
    if ($c_order == 1 ) {
      $data = array('c_order'=>$c_order);
      $where = array('id_pemesanan' => $id_pemesanan);
    } else {
      $total = $this->db->query("SELECT sum(a.harga_pesan) as total FROM `detil_pemesanan` a where a.id_pemesanan='$id_pemesanan'")->row_array();
      $kembali = $total['total'] - ($total['total'] * 0.2);
      $data = array('kembali'=>$kembali,'c_order'=>$c_order);
      $where = array('id_pemesanan' => $id_pemesanan);
    }
    $this->model_app->update('pemesanan', $data, $where);
    
    redirect('administrator/pemesanan');
  }

  function delete_pemesanan(){
    cek_session_admin();
    $id = array('id_pemesanan' => $this->uri->segment(3));
    $this->model_app->delete('pemesanan',$id);
    $this->model_app->delete('detil_pemesanan',$id);
    redirect('administrator/pemesanan');
  }

  // Controller Modul Laporan Produk Perawatan
  function lap_produkperawatan() {
    cek_session_akses();
    $data['record'] = $this->model_app->view_ordering('jenis', 'id_jenis', 'ASC');
    $this->template->load('administrator/template','administrator/mod_laporan/view_lap_produk', $data);
  }

  function cetak_produk(){
    cek_session_akses();
    if (isset($_POST['submit'])) {
        if ($this->input->post('a') == '') {
            $data['title'] = "Semua Produk Perawatan";
            $data['record'] = $this->model_app->view_ordering('produk','id_produk','DESC');
        } else {
            $name = $this->model_app->view_where('jenis',array('id_jenis'=>$this->input->post('a')))->row_array();
            $data['title'] = "Produk " . $name['jenis_perawatan'];
            $data['record'] = $this->model_app->view_join_where('jenis_to_produk','produk','id_produk',array('id_jenis'=>$this->input->post('a')),'id_jenistoproduk','DESC');
        }
    }
    $this->load->view('administrator/mod_laporan/cetak_lap_stok', $data);
  }

  // Controller Modul Laporan Pemesanan
  function lap_pemesanan(){
    cek_session_akses();
    $this->template->load('administrator/template','administrator/mod_laporan/view_lap_penjualan');
  }

  function cetak_pemesanan(){
    cek_session_akses();
    if (isset($_POST['submit'])) {
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_selesai = $this->input->post('tgl_selesai');
        $pemesanan = $this->model_app->lap_pemesanan('pemesanan',$tgl_mulai,$tgl_selesai);
        $detil_pemesanan = $this->model_app->lap_pemesanan_detil('pemesanan',$tgl_mulai,$tgl_selesai);
        $data = array(
            'tgl_mulai'     => $tgl_mulai,
            'tgl_selesai'   => $tgl_selesai,
            'jml_transaksi' => $pemesanan->num_rows(),
            'record'        => $pemesanan->result_array(),
            'drecord'       => $detil_pemesanan->result_array()
        );
    }
    $this->load->view('administrator/mod_laporan/cetak_lap_pemesanan', $data);
  }

  // Controller Modul User

	function manajemenuser(){
		cek_session_admin();
		$data['record'] = $this->model_app->view_ordering('users','username','ASC');
		$this->template->load('administrator/template','administrator/mod_users/view_users',$data);
	}

  function tambah_manajemenuser(){
		cek_session_admin();
		$id = $this->session->username;
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('username')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap')),
                                    'password'=>hash("sha512", md5($this->input->post('password'))),
                                    'tipe'=>$this->db->escape_str($this->input->post('tipe')),
                                    'alamat_user'=>$this->db->escape_str($this->input->post('alamat_user')),
                                    'telp_user'=>$this->db->escape_str($this->input->post('telp_user')),
                                    'email_user'=>$this->db->escape_str($this->input->post('email_user')));
            }else{
                    $data = array('username'=>$this->db->escape_str($this->input->post('username')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap')),
                                    'password'=>hash("sha512", md5($this->input->post('password'))),
                                    'tipe'=>$this->db->escape_str($this->input->post('tipe')),
                                    'alamat_user'=>$this->db->escape_str($this->input->post('alamat_user')),
                                    'telp_user'=>$this->db->escape_str($this->input->post('telp_user')),
                                    'email_user'=>$this->db->escape_str($this->input->post('email_user')),
                                    'foto'=>$hasil['file_name']);
            }
            $this->model_app->insert('users',$data);

			redirect($this->uri->segment(1).'/manajemenuser');
		}else{
        $this->template->load('administrator/template','administrator/mod_users/view_users_tambah');
		}
	}

  function edit_manajemenuser(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '2000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');
            $hasil=$this->upload->data();
            if ($hasil['file_name']=='' AND $this->input->post('password') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('username')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap')),
                                    'tipe'=>$this->db->escape_str($this->input->post('tipe')),
                                    'alamat_user'=>$this->db->escape_str($this->input->post('alamat_user')),
                                    'telp_user'=>$this->db->escape_str($this->input->post('telp_user')),
                                    'email_user'=>$this->db->escape_str($this->input->post('email_user')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('password') ==''){
              $cek_foto = $this->model_app->view_where('users',array('id_user' => $this->input->post('id')))->row_array();
              if ($cek_foto['foto'] != null) {
                unlink('asset/foto_user/' . $cek_foto['foto']);
              }
                    $data = array('username'=>$this->db->escape_str($this->input->post('username')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap')),
                                    'tipe'=>$this->db->escape_str($this->input->post('tipe')),
                                    'alamat_user'=>$this->db->escape_str($this->input->post('alamat_user')),
                                    'telp_user'=>$this->db->escape_str($this->input->post('telp_user')),
                                    'email_user'=>$this->db->escape_str($this->input->post('email_user')),
                                    'foto'=>$hasil['file_name']);
            }elseif ($hasil['file_name']=='' AND $this->input->post('password') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('username')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap')),
                                    'password'=>hash("sha512", md5($this->input->post('password'))),
                                    'tipe'=>$this->db->escape_str($this->input->post('tipe')),
                                    'alamat_user'=>$this->db->escape_str($this->input->post('alamat_user')),
                                    'telp_user'=>$this->db->escape_str($this->input->post('telp_user')),
                                    'email_user'=>$this->db->escape_str($this->input->post('email_user')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('password') !=''){
              $cek_foto = $this->model_app->view_where('users',array('id_user' => $this->input->post('id')))->row_array();
              if ($cek_foto['foto'] != '') {
                unlink('asset/foto_user/' . $cek_foto['foto']);
              }
                    $data = array('username'=>$this->db->escape_str($this->input->post('username')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap')),
                                    'password'=>hash("sha512", md5($this->input->post('password'))),
                                    'tipe'=>$this->db->escape_str($this->input->post('tipe')),
                                    'alamat_user'=>$this->db->escape_str($this->input->post('alamat_user')),
                                    'telp_user'=>$this->db->escape_str($this->input->post('telp_user')),
                                    'email_user'=>$this->db->escape_str($this->input->post('email_user')),
                                    'foto'=>$hasil['file_name']);
            }
            $where = array('id_user' => $this->input->post('id'));
            $this->model_app->update('users', $data, $where);

			redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->input->post('id'));
		}else{
        if ($this->session->id_user==$this->uri->segment(3) OR $this->session->tipe=='Kasir'){
            $proses = $this->model_app->edit('users', array('id_user' => $id))->row_array();
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_users/view_users_edit',$data);
        }else{
            redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->session->id_user);
        }
		}
	}

  function delete_manajemenuser(){
    cek_session_admin();
    $id = array('id_user' => $this->uri->segment(3));
    $cek_foto = $this->model_app->view_where('users',$id)->row_array();
    if ($cek_foto['foto'] != null) {
      unlink('asset/foto_user/' . $cek_foto['foto']);
    }
    $this->model_app->delete('users',$id);
    redirect($this->uri->segment(1).'/manajemenuser');
  }

  function logout(){
		$this->session->sess_destroy();
		redirect('main');
	}
}