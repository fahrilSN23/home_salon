<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Konfirmasi extends CI_Controller {
	function index(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
				$data = array('id_pemesanan'=>$this->input->post('id'),
			        		  'total_transfer'=>$this->input->post('b'),
			        		  'no_rek'=>$this->input->post('c'),
			        		  'nama_pengirim'=>$this->input->post('d'),
			        		  'tanggal_transfer'=>$this->input->post('e'));
				$this->model_app->insert('konfirmasi',$data);
			}else{
				$data = array('id_pemesanan'=>$this->input->post('id'),
			        		  'total_transfer'=>$this->input->post('b'),
			        		  'no_rek'=>$this->input->post('c'),
			        		  'nama_pengirim'=>$this->input->post('d'),
			        		  'tanggal_transfer'=>$this->input->post('e'),
			        		  'bukti_transfer'=>$hasil['file_name']);
				$this->model_app->insert('konfirmasi',$data);
			}
			$data1 = array('status'=>'1');
			$where = array('id_pemesanan' => $this->input->post('id'));
			$this->model_app->update('pemesanan', $data1, $where);
			redirect('members/detail_pemesanan/'.$this->input->post('id'));
		}else{
			cek_session_members();
            $data['title'] = 'Konfirmasi Pembayaran';
            $data['iden'] = iden();
			if (isset($_POST['submit1']) OR $_GET['kode']){
				if ($_GET['kode']!=''){
					$kode_transaksi = filter($this->input->get('kode'));
				}else{
					$kode_transaksi = filter($this->input->post('a'));
				}
				$row = $this->db->query("SELECT id_pemesanan FROM `pemesanan` where no_transaksi='$kode_transaksi'")->row_array();
				$data['total'] = $this->db->query("SELECT sum(harga_pesan) as total, id_pemesanan FROM `detil_pemesanan` where id_pemesanan='".$row['id_pemesanan']."'")->row_array();
				$data['rows'] = $this->model_app->view_where('pemesanan',array('id_pemesanan'=>$row['id_pemesanan']))->row_array();
				$this->template->load('main/template_sub','main/konfirmasi/view_konfirmasi_pembayaran',$data);
			}else{
				$this->template->load('main/template_sub','main/konfirmasi/view_konfirmasi_pembayaran',$data);
			}
		}
	}
}