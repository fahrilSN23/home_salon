<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produk extends CI_Controller {
	public function index(){
		$data['title'] = title();
		$data['description'] = description();
		$data['keywords'] = keywords();
		$data['iden'] = iden();
		$data['record'] = $this->model_app->view_ordering('jenis','id_jenis','ASC');
		$data['record1'] = $this->db->query("SELECT * FROM produk WHERE stok >= 1 ORDER BY id_produk ASC")->result_array();
		$this->template->load('main/template_sub','main/produk',$data);
	}

    public function jenis_perawatan() {
        $id_jenis = $this->uri->segment(3);        
        $data['title'] = title();
		$data['description'] = description();
		$data['keywords'] = keywords();
		$data['iden'] = iden();
        $jp = $this->model_app->view_where('jenis',array('id_jenis' => $id_jenis))->row_array();
        $data['sub_title'] = ' - ' . $jp['jenis_perawatan'];
		$data['record'] = $this->model_app->view_ordering('jenis','id_jenis','ASC');
		$data['record1'] = $this->model_app->view_join_where('jenis_to_produk','produk','id_produk',array('id_jenis' => $id_jenis),'id_jenistoproduk','ASC');
		$this->template->load('main/template_sub','main/produk',$data);
    }

    function keranjang(){
		$id_produk = $this->uri->segment(3);
		$data['title'] = title();
		$data['description'] = description();
		$data['keywords'] = keywords();
		$data['iden'] = iden();
		if ($id_produk!=''){
			$this->session->unset_userdata('produk');
			if ($this->session->idp == ''){
				$idp = 'TRX-'.date('YmdHis');
				$this->session->set_userdata(array('idp'=>$idp));
			}

			$harga = $this->model_app->view_where('produk',array('id_produk'=>$id_produk))->row_array();
			$harga_konsumen = $harga['harga'];
			$data = array('session'=>$this->session->idp,
							'id_produk'=>$id_produk,
							'harga_pesan'=>$harga_konsumen,
							'tanggal'=>date('Y-m-d H:i:s'));
			$this->model_app->insert('pemesanan_temp',$data);

			redirect('produk/keranjang');
		}else{
			if ($this->session->idp != ''){
				$data['record'] = $this->model_app->view_join_where('pemesanan_temp','produk','id_produk',array('session'=>$this->session->idp),'id_detil_pemesanan','ASC');
			}
            $data['title'] = 'Keranjang Pemesanan';
            $this->template->load('main/template_sub','main/keranjang/view_keranjang',$data);

		}
	}

	function keranjang_delete(){
		$id = array('id_detil_pemesanan' => $this->uri->segment(3));
		$this->model_app->delete('pemesanan_temp',$id);
		$isi_keranjang = $this->db->query("SELECT * FROM pemesanan_temp where session='".$this->session->idp."'")->num_rows();
		if ($isi_keranjang <= 0){
			$this->session->unset_userdata('idp');
		}
		redirect('produk/keranjang');
	}

	function checkouts(){
		if (isset($_POST['submit'])){
				if ($this->session->idp!=''){
					$this->load->library('email');
					$data = array('username'=>$this->input->post('b'),
			        			  'password'=>hash("sha512", md5(date('YmdHis'))),
			        			  'nama_lengkap'=>$this->input->post('a'),
			        			  'email'=>$this->input->post('b'),
			        			  'jenis_kelamin'=>'Laki-laki',
			        			  'tanggal_lahir'=>date('Y-m-d'),
								  'tempat_lahir'=>'Belum ada informasi',
								  'alamat_lengkap'=>$this->input->post('c'),
								  'kecamatan'=>$this->input->post('g'),
								  'kota_id'=>$this->input->post('f'),
								  'no_hp'=>$this->input->post('h'),
								  'tanggal_daftar'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_konsumen',$data);
					$id = $this->db->insert_id();
					
					$data = array('kode_transaksi'=>$this->session->idp,
				        		  'id_pembeli'=>$id,
				        		  'id_penjual'=>$this->session->reseller,
				        		  'status_pembeli'=>'konsumen',
				        		  'status_penjual'=>'reseller',
				        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
				        		  'proses'=>'0');
					$this->model_app->insert('rb_penjualan',$data);
					$idp = $this->db->insert_id();

					$keranjang = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp));
					foreach ($keranjang->result_array() as $row) {
						$dataa = array('id_penjualan'=>$idp,
					        		   'id_produk'=>$row['id_produk'],
					        		   'jumlah'=>$row['jumlah'],
					        		   'harga_jual'=>$row['harga_jual'],
					        		   'satuan'=>$row['satuan']);
						$this->model_app->insert('rb_penjualan_detail',$dataa);
					}

					$session = array('session' => $this->session->idp);
					$this->model_app->delete('rb_penjualan_temp',$session);

					$data['title'] = 'Transaksi Success';
					$data['email'] = $this->input->post('b');
					$data['orders'] = $this->session->idp;

					$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
					$res = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
					$alamat = $this->db->query("SELECT a.nama_kota as kota, b.nama_provinsi as propinsi FROM `rb_kota`a JOIN rb_provinsi b ON a.provinsi_id=b.provinsi_id where a.kota_id='".$this->input->post('f')."'")->row_array();
					$data['rekening_reseller'] = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$this->session->reseller));

					$email_tujuan = $this->input->post('b');
					$tglaktif = date("d-m-Y H:i:s");

					$subject      = "$iden[nama_website] - Detail Orderan anda";
					$message      = "<html><body>Halooo! <b>".$this->input->post('a')."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda telah order produk di $iden[nama_website].
						<br><table style='width:100%;'>
			   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Anda : </b></td></tr>
							<tr><td width='140px'><b>Nama Lengkap</b></td>  <td> : ".$this->input->post('a')."</td></tr>
							<tr><td><b>Alamat Email</b></td>			<td> : ".$this->input->post('b')."</td></tr>
							<tr><td><b>No Telpon</b></td>				<td> : ".$this->input->post('h')."</td></tr>
							<tr><td><b>Alamat</b></td>					<td> : ".$this->input->post('c')." </td></tr>
							<tr><td><b>Provinsi</b></td>				<td> : ".$alamat['propinsi']." </td></tr>
							<tr><td><b>Kabupaten/Kota</b></td>			<td> : ".$alamat['kota']." </td></tr>
							<tr><td><b>Kecamatan</b></td>				<td> : ".$this->input->post('g')." </td></tr>
						</table><br>

						<table style='width:100%;'>
			   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Reseller : </b></td></tr>
							<tr><td width='140px'><b>Nama Reseller</b></td>	<td> : ".$res['nama_reseller']."</td></tr>
							<tr><td><b>Alamat</b></td>					<td> : ".$res['alamat_lengkap']."</td></tr>
							<tr><td><b>No Telpon</b></td>				<td> : ".$res['no_telpon']."</td></tr>
							<tr><td><b>Email</b></td>					<td> : ".$res['email']." </td></tr>
							<tr><td><b>Keterangan</b></td>				<td> : ".$res['keterangan']." </td></tr>
						</table><br>

						No Orderan anda : <b>".$this->session->idp."</b><br>
						Berikut Detail Data Orderan Anda :
						<table style='width:100%;' class='table table-striped'>
					          <thead>
					            <tr bgcolor='#337ab7'>
					              <th style='width:40px'>No</th>
					              <th width='47%'>Nama Produk</th>
					              <th>Harga</th>
					              <th>Qty</th>
					              <th>Berat</th>
					              <th>Subtotal</th>
					            </tr>
					          </thead>
					          <tbody>";

					          $no = 1;
					          $belanjaan = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$idp),'id_penjualan_detail','ASC');
					          foreach ($belanjaan as $row){
					          $sub_total = ($row['harga_jual']*$row['jumlah']);
					$message .= "<tr bgcolor='#f5f5f5'><td>$no</td>
					                    <td>$row[nama_produk]</td>
					                    <td>".rupiah($row['harga_jual'])."</td>
					                    <td>$row[jumlah]</td>
					                    <td>".($row['berat']*$row['jumlah'])." Gram</td>
					                    <td>Rp ".rupiah($sub_total)."</td>
					                </tr>";
					            $no++;
					          }
					          $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$idp."'")->row_array();
					$message .= "<tr bgcolor='lightgreen'>
					                  <td colspan='5'><b>Total Harga</b></td>
					                  <td><b>Rp ".rupiah($total['total'])."</b></td>
					                </tr>

					                <tr bgcolor='lightblue'>
					                  <td colspan='5'><b>Total Berat</b></td>
					                  <td><b>$total[total_berat] Gram</b></td>
					                </tr>

					        </tbody>
					      </table><br>

					      Silahkan melakukan pembayaran ke rekening reseller :
					      <table style='width:100%;' class='table table-hover table-condensed'>
							<thead>
							  <tr bgcolor='#337ab7'>
							    <th width='20px'>No</th>
							    <th>Nama Bank</th>
							    <th>No Rekening</th>
							    <th>Atas Nama</th>
							  </tr>
							</thead>
							<tbody>";
							    $noo = 1;
							    $rekening = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$this->session->reseller));
							    foreach ($rekening->result_array() as $row){
					$message .= "<tr bgcolor='#f5f5f5'><td>$noo</td>
							              <td>$row[nama_bank]</td>
							              <td>$row[no_rekening]</td>
							              <td>$row[pemilik_rekening]</td>
							          </tr>";
							      $noo++;
							    }
					$message .= "</tbody>
						  </table><br><br>

					      Jika sudah melakukan transfer, jangan lupa konfirmasi transferan anda <a href='".base_url()."konfirmasi'>disini</a><br>
					      Admin, $iden[nama_website] </body></html> \n";
					
					$this->email->from($iden['email'], $iden['nama_website']);
					$this->email->to($email_tujuan);
					$this->email->cc('');
					$this->email->bcc('');

					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->set_mailtype("html");
					$this->email->send();
					
					$config['protocol'] = 'sendmail';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);

					$this->session->unset_userdata('idp');
					$this->session->unset_userdata('reseller');
					$this->template->load('phpmu-one/template','phpmu-one/view_order_success',$data);
				}else{
					redirect('produk/keranjang');
				}
		}else{
			if ($this->session->id_pelanggan==''){
				redirect('auth/login');
			}else{
				$data['title'] = 'Data Pelanggan';
				$this->template->load('main/template_sub','main/keranjang/view_checkouts',$data);
			}
		}
	}
}
