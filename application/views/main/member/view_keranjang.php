<section class="price_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          <?=$title?>
        </h2>
      </div>
      <div class="price_container">
        <div class="box-cart">
          <div class="name">
            <h6>
              Berikut Pesanan Anda
            </h6>
          </div>
          <div class="detail-box">
            <?php
              if ($this->session->idp == ''){
                echo "<center style='padding:15%'><i class='text-danger'>Maaf, Keranjang pesanan anda saat ini masih kosong,...</i><br>
                        <a class='btn btn-warning btn-sm' href='".base_url()."produk'>Klik Disini Untuk mulai Pemesanan!</a></center>";
              }else{
            ?>
            <table class="table table-striped">
              <th>
                <tr>
                  <td>No</td>
                  <td>Jenis Perawatan</td>
                  <td>Produk Perawatan</td>
                  <td>Qty</td>
                  <td>Harga</td>
                  <td>Opsi</td>
                </tr>
              </th>
              <tbody>
                <?php $no = 1; foreach ($record as $row) {
                $j = $this->db->query("SELECT * FROM jenis_to_produk a JOIN jenis b ON b.id_jenis = a.id_jenis WHERE a.id_produk = $row[id_produk]")->row_array();
                ?>
                <tr>
                  <td><?=$no++?>.</td>
                  <td><?=$j['jenis_perawatan']?></a>
                  <td><b><?=$row['nama']?></b></td>
                  <td><?=$row['qty']?></td>
                  <td>Rp. <?=rupiah($row['harga_pesan'])?></td>
                  <td width='30px'><a id="hover" class='btn btn-danger btn-xs' title='Delete' href='<?=base_url()?>members/keranjang_delete/<?=$row['id_detil_pemesanan']?>/<?=$row['id_produk']?>'><span class='fa fa-trash'></span></a></td>
                </tr>
                <?php }
                $total = $this->db->query("SELECT sum(harga_pesan) as total FROM `detil_pemesanan` where id_pemesanan ='".$this->session->idp."'")->row_array();
                ?>
                <tr>
                  <th colspan="3" class="text-right">Total Harga</th>
                  <th colspan="2">Rp. <?=rupiah($total['total'])?></th>
                </tr>
              </tbody>
            </table>
            <hr>
            <a class='btn btn-success btn-sm' style="margin-left: 20px;" href='<?=base_url()?>produk'>Tambah Produk</a>
            <a class='btn btn-primary btn-sm' href='<?=base_url()?>members/selesai_belanja'>Selesai</a>
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- <div class="d-flex justify-content-center">
        <a href="" class="price_btn">
          See More
        </a>
      </div> -->
    </div>
  </section>