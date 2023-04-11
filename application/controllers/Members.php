<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Members extends CI_Controller {

    function profile(){
		cek_session_members();
		$data['title'] = 'Profile Anda';
		$data['iden'] = iden();
		$data['row'] = $this->model_hs->profile_pelanggan($this->session->id_pelanggan)->row_array();
		$this->template->load('main/template','main/member/view_profile',$data);
	}

	function edit_profile(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$this->model_hs->profile_update($this->session->id_pelanggan);
			redirect('members/profile');
		}
		$data['title'] = 'Edit Profile Anda';
		$data['row'] = $this->model_hs->profile_pelanggan($this->session->id_pelanggan)->row_array();
		$this->template->load('main/template','main/member/view_profile_edit',$data);
	}

    function keranjang(){
		cek_session_members();
        $data['iden'] = iden();
		$id_produk   = $this->uri->segment(3);

		if ($id_produk!=''){
            if ($this->session->idp == ''){
                // Pengaturan Jadwal & No antrian
                // $jadwal = penentuan_jadwal();
                $kode_transaksi = 'TRX-'.date('YmdHis');
                $data = array('no_transaksi'=>$kode_transaksi,
                            'id_pelanggan'=>$this->session->id_pelanggan);
                $this->model_app->insert('pemesanan',$data);
                $idp = $this->db->insert_id();
                $this->session->set_userdata(array('idp'=>$idp));
            }

            $harga = $this->model_app->view_where('produk',array('id_produk'=>$id_produk))->row_array();
            $harga_konsumen = $harga['harga'];
			$stok = $harga['stok'] - 1;
            $data = array('id_pemesanan'=>$this->session->idp,
                        'id_produk'=>$id_produk,
						'qty' => 1,
                        'harga_pesan'=>$harga_konsumen);
			$data1 = array('stok' => $stok);
            $this->model_app->insert('detil_pemesanan',$data);
			$this->model_app->update('produk',$data1,array('id_produk'=>$id_produk));
            redirect('members/keranjang');
		}else{
			if ($this->session->idp != ''){
				$id_pemesanan = $this->session->idp;
				$data['rows'] = $this->model_app->view_where('pemesanan',array('id_pemesanan'=>$this->session->idp))->row_array();
				$data['rowsk'] = $this->model_app->view_where('pelanggan',array('id_pelanggan'=>$this->session->id_pelanggan))->row_array();
				$data['record'] = $this->db->query("SELECT *, SUM(a.qty) as qty, SUM(a.harga_pesan) as harga_pesan FROM detil_pemesanan a JOIN produk b ON a.id_produk = b.id_produk WHERE id_pemesanan = $id_pemesanan GROUP BY a.id_produk")->result_array();
			}
            $data['title'] = 'Keranjang Belanja';
            $this->template->load('main/template_sub','main/member/view_keranjang',$data);

		}
	}

    function keranjang_delete(){
		$id = array('id_detil_pemesanan' => $this->uri->segment(3));
		$id_produk = array('id_produk' => $this->uri->segment(4));
		$this->model_app->delete('detil_pemesanan',$id);
		$produk = $this->model_app->view_where('produk', $id_produk)->row_array();
		$stok = $produk['stok'] + 1;
		$data = array('stok' => $stok);
		$this->model_app->update('produk',$data,$id_produk);
		$isi_keranjang = $this->db->query("SELECT * FROM detil_pemesanan where id_pemesanan = '".$this->session->idp."'")->num_rows();
		if ($isi_keranjang <= 0){
			$idp = array('id_pemesanan' => $this->session->idp);
			$this->model_app->delete('pemesanan',$idp);
			$this->session->unset_userdata('idp');
		}
		redirect('members/keranjang');
	}

    function selesai_belanja(){
        $cekres = $this->model_app->view_where('pemesanan',array('id_pemesanan'=>$this->session->idp))->row_array();
        $kons = $this->model_hs->profile_pelanggan($this->session->id_pelanggan)->row_array();
		$total = $this->db->query("SELECT sum(a.harga_pesan) as total FROM `detil_pemesanan` a where a.id_pemesanan='$cekres[id_pemesanan]'")->row_array();
		$phone = $kons['no_telp'];
		$msg = "*HALLO " . $kons['nama'] . "*
	============================
	
	Pesanan anda dengan *No Transaksi : " . $cekres['no_transaksi'] . "*
	============================
	
	Berikut Informasi Pesanan Anda :
	No Antrian : Menunggu Konfirmasi Admin
	Jumlah Bayar : " . $total['total'] . "
	Tanggal Treatment : Menunggu Konfirmasi Admin
	============================
	
	Selengkapnya Cek Disini : " . base_url('Members/detail_pemesanan/' . $cekres['id_pemesanan']);

        $this->model_hs->kirimPesanWA($phone,$msg);
        $this->session->unset_userdata('idp');

		redirect('members/pesanan');
	}

    function pesanan(){
		cek_session_members();
		$data['title'] = 'Laporan Pesanan Anda';
		$data['iden'] = iden();
		$data['record'] = $this->model_hs->orders_report($this->session->id_pelanggan);
		$this->template->load('main/template_sub','main/member/view_pesanan',$data);
	}

	function detail_pemesanan(){
		cek_session_members();
		$data['title'] = 'Detail Pemesanan';
		$data['rows'] = $this->model_hs->penjualan_detail($this->uri->segment(3))->row_array();
		$data['bf'] =$this->model_app->view_where('konfirmasi',array('id_pemesanan' => $this->uri->segment(3)))->row_array();
		$data['record'] = $this->model_app->view_join_where('detil_pemesanan','produk','id_produk',array('id_pemesanan'=>$this->uri->segment(3)),'id_detil_pemesanan','DESC');
		$this->template->load('main/template_sub','main/member/view_detail_pesanan',$data);
	}

}